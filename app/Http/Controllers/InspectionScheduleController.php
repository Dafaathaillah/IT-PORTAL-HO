<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class InspectionScheduleController extends Controller
{

    protected function getSiteFromRequest(Request $request): string
    {
        $prefix = $request->route()->getPrefix();
        return str_replace('inspection-scheduler-laptop-', '', $prefix);
    }

    public function index(Request $request)
    {
        $site_link = $this->getSiteFromRequest($request);
        $site = strtoupper($this->getSiteFromRequest($request));

        $user = Auth::user();
        $auth = $user->role;
        $userSite = $user->site;

        if ($auth == 'ict_technician' || $auth == 'ict_group_leader' || $auth == 'ict_admin') {
            if ($site != $userSite) {
                abort(403, 'You dont have permission to access this page.');
            }
        }

        $schedules = DB::table('schedule_laptop')
            ->join('inv_laptops', 'schedule_laptop.id_laptop', '=', 'inv_laptops.id')
            ->select(
                'schedule_laptop.id',
                'schedule_laptop.id_laptop',
                'schedule_laptop.tanggal_inspection',
                'schedule_laptop.bulan',
                'schedule_laptop.tahun',
                'inv_laptops.laptop_code',
                'inv_laptops.dept',
                'inv_laptops.site'
            )
            ->where('schedule_laptop.site', $site)
            ->orderBy('tanggal_inspection')
            ->get();

        $summary = collect($schedules)->groupBy(fn($item) => Carbon::parse($item->tanggal_inspection)->format('F'))
            ->map(function ($group) {
                return [
                    'month' => Carbon::parse($group->first()->tanggal_inspection)->format('F'),
                    'departments' => $group->pluck('dept')->unique()->values(),
                ];
            })->values();

        return Inertia::render('InspectionSchedule/IndexLaptop', [
            'schedules' => $schedules,
            'summary' => $summary,
            'site_link' => $site_link,
        ]);
    }

    public function update(Request $request, $id)
    {

        $site_link = $this->getSiteFromRequest($request);
        $site = strtoupper($this->getSiteFromRequest($request));

        $user = Auth::user();
        $auth = $user->role;
        $userSite = $user->site;

        if ($auth != 'ict_developer' && $site != $userSite) {
            abort(403, 'You dont have permission to access this page.');
        }

        $request->validate([
            'tanggal_inspection' => 'required|date',
        ]);

        $date = Carbon::parse($request->tanggal_inspection);

        DB::table('schedule_laptop')
            ->where('id', $id)
            ->update([
                'tanggal_inspection' => $date->toDateString(),
                'bulan' => $date->format('m'),
                'tahun' => $date->format('Y'),
                'updated_at' => now(),
            ]);

        return redirect()->route("inspection-scheduler-laptop.$site_link.index")->with('success', 'Schedule updated successfully.');
    }

    public function generate(Request $request)
    {

        $path = $request->path();
        $site_link = str_replace('generate-inspection-scheduler-laptop-', '', $path);
        $site = strtoupper($site_link);

        $unscheduledLaptops = DB::table('inv_laptops')
            ->leftJoin('schedule_laptop', 'inv_laptops.id', '=', 'schedule_laptop.id_laptop')
            ->whereNull('schedule_laptop.id_laptop')
            ->where('inv_laptops.site', $site)
            // ->where('inv_laptops.site', 'bib')
            ->select('inv_laptops.id', 'inv_laptops.laptop_code', 'inv_laptops.dept', 'inv_laptops.site')
            ->get();

        if ($unscheduledLaptops->isEmpty()) {
            return response()->json(['message' => 'All laptops are already scheduled.'], 200);
        }

        // Group and sort departments
        $groupedByDept = $unscheduledLaptops->groupBy('dept');
        $sortedDepts = $groupedByDept->sortByDesc(fn($group) => $group->count());

        // Get department names
        $departments = $sortedDepts->keys()->values();
        $deptCount = $departments->count();

        if ($deptCount > 12) {
            return response()->json(['error' => 'Cannot assign more than 12 departments in one year without overlap.'], 400);
        }

        // Evenly assign each department a month
        $deptDateLimits = [];

        if ($deptCount === 1) {
            $assignedMonths = [6]; // Only one dept: assign to June
        } else {
            $assignedMonths = [];
            for ($i = 0; $i < $deptCount; $i++) {
                $month = round(1 + ($i * (11 / ($deptCount - 1)))); // Evenly spread between Jan (1) and Dec (12)
                $assignedMonths[] = (int) $month;
            }
            $assignedMonths = array_unique($assignedMonths);

            if (count($assignedMonths) < $deptCount) {
                return response()->json(['error' => 'Unable to assign unique months for departments.'], 500);
            }
        }

        foreach ($departments as $index => $deptName) {
            $month = $assignedMonths[$index];
            $start = Carbon::create(2025, $month, 1);
            $end = $start->copy()->endOfMonth();

            $deptDateLimits[$deptName] = [
                'start' => $start->toDateString(),
                'end' => $end->toDateString(),
            ];
        }

        // Build the schedule
        $schedule = [];

        foreach ($sortedDepts as $dept => $laptops) {
            $range = $deptDateLimits[$dept];
            $deptStart = Carbon::parse($range['start']);
            $deptEnd = Carbon::parse($range['end']);
            $deptDays = $deptStart->diffInDays($deptEnd) + 1;

            // Generate dates for that department's month
            $dates = collect();
            for ($i = 0; $i < $deptDays; $i++) {
                $dates->push($deptStart->copy()->addDays($i)->toDateString());
            }

            // Take ~70% of the month randomly
            $dates = $dates->shuffle()->take((int) round($deptDays * 0.7))->values();

            // Assign 2–3 laptops per date
            $repeatDates = [];
            $laptopsRemaining = $laptops->count();
            $dateIndex = 0;

            while ($laptopsRemaining > 0 && $dateIndex < count($dates)) {
                $batchSize = rand(2, 3);
                for ($i = 0; $i < $batchSize && $laptopsRemaining > 0; $i++) {
                    $repeatDates[] = $dates[$dateIndex];
                    $laptopsRemaining--;
                }
                $dateIndex++;
            }

            // If still laptops left, reuse available dates
            $dateIndex = 0;
            while ($laptopsRemaining > 0) {
                $repeatDates[] = $dates[$dateIndex % count($dates)];
                $laptopsRemaining--;
                $dateIndex++;
            }

            sort($repeatDates);

            // Assign dates to laptops
            $laptopIndex = 0;
            $sortedLaptops = $laptops->sortBy('laptop_code')->values();

            foreach ($sortedLaptops as $laptop) {
                $inspectionDate = Carbon::parse($repeatDates[$laptopIndex]);

                $schedule[] = [
                    'id_laptop' => $laptop->id,
                    'tanggal_inspection' => $inspectionDate->toDateString(),
                    'bulan' => $inspectionDate->format('m'),
                    'tahun' => $inspectionDate->format('Y'),
                    'laptop_code' => $laptop->laptop_code,
                    'dept' => $laptop->dept,
                    'site' => $laptop->site,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $laptopIndex++;
            }
        }

        DB::table('schedule_laptop')->insert($schedule);

        return response()->json([
            'message' => 'Schedule generated successfully.',
            'total_scheduled' => count($schedule),
        ], 201);
    }
}
