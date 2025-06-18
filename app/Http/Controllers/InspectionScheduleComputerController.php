<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class InspectionScheduleComputerController extends Controller
{

    protected function getSiteFromRequest(Request $request): string
    {
        $prefix = $request->route()->getPrefix();
        return str_replace('inspection-scheduler-computer-', '', $prefix);
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

        $schedules = DB::table('schedule_computer')
            ->join('inv_computers', 'schedule_computer.id_computer', '=', 'inv_computers.id')
            ->select(
                'schedule_computer.id',
                'schedule_computer.id_computer',
                'schedule_computer.tanggal_inspection',
                'schedule_computer.bulan',
                'schedule_computer.tahun',
                'inv_computers.computer_code',
                'inv_computers.dept',
                'inv_computers.site'
            )
            ->where('schedule_computer.site', $site)
            ->orderBy('tanggal_inspection')
            ->get();

        $summary = collect($schedules)->groupBy(fn($item) => Carbon::parse($item->tanggal_inspection)->format('F'))
            ->map(function ($group) {
                return [
                    'month' => Carbon::parse($group->first()->tanggal_inspection)->format('F'),
                    'departments' => $group->pluck('dept')->unique()->values(),
                ];
            })->values();

        $month = Carbon::now()->month;

        $triwulan = match (true) {
            $month >= 1 && $month <= 3 => 'Triwulan 1',
            $month >= 4 && $month <= 6 => 'Triwulan 2',
            $month >= 7 && $month <= 9 => 'Triwulan 3',
            $month >= 10 && $month <= 12 => 'Triwulan 4',
        };

        return Inertia::render('InspectionSchedule/IndexKomputer', [
            'schedules' => $schedules,
            'summary' => $summary,
            'site_link' => $site_link,
            'triwulan' => $triwulan,
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

        DB::table('schedule_computer')
            ->where('id', $id)
            ->update([
                'tanggal_inspection' => $date->toDateString(),
                'bulan' => $date->format('m'),
                'tahun' => $date->format('Y'),
                'updated_at' => now(),
            ]);

        return redirect()->route("inspection-scheduler-computer.$site_link.index")->with('success', 'Schedule updated successfully.');
    }

    public function generate(Request $request)
    {

        $path = $request->path();
        $site_link = str_replace('generate-inspection-scheduler-computer-', '', $path);
        $site = strtoupper($site_link);

        $now = now();
        $year = $now->year;

        // Determine current quarter
        $month = $now->month;
        if ($month >= 1 && $month <= 3) {
            $quarter = 'Q1';
            $start = Carbon::create($year, 1, 1);
            $end = Carbon::create($year, 3, 31);
        } elseif ($month >= 4 && $month <= 6) {
            $quarter = 'Q2';
            $start = Carbon::create($year, 4, 1);
            $end = Carbon::create($year, 6, 30);
        } elseif ($month >= 7 && $month <= 9) {
            $quarter = 'Q3';
            $start = Carbon::create($year, 7, 1);
            $end = Carbon::create($year, 9, 30);
        } else {
            $quarter = 'Q4';
            $start = Carbon::create($year, 10, 1);
            $end = Carbon::create($year, 12, 31);
        }

        // Get computers at site 'bib' that are not yet scheduled for this quarter and year
        $alreadyScheduledIds = DB::table('schedule_computer')
            ->where('tahun', $year)
            ->where('site', $site)
            ->where('quarter', $quarter)
            ->pluck('id_computer')
            ->toArray();

        $unscheduledComputers = DB::table('inv_computers')
            ->where('site', $site)
            ->whereNotIn('id', $alreadyScheduledIds)
            ->select('id', 'computer_code', 'dept', 'site')
            ->get();

        if ($unscheduledComputers->isEmpty()) {
            return response()->json([
                'message' => "All computers are already scheduled for $quarter $year."
            ], 200);
        }

        // Generate ~70% of the days in the quarter
        $daysInQuarter = $start->diffInDays($end) + 1;
        $dates = collect();

        for ($i = 0; $i < $daysInQuarter; $i++) {
            $dates->push($start->copy()->addDays($i)->toDateString());
        }

        $usableDates = $dates->shuffle()->take((int) round($daysInQuarter * 0.7))->values();

        $repeatDates = [];
        $computerRemaining = $unscheduledComputers->count();
        $dateIndex = 0;

        while ($computerRemaining > 0 && $dateIndex < count($usableDates)) {
            $batchSize = rand(2, 3);
            for ($i = 0; $i < $batchSize && $computerRemaining > 0; $i++) {
                $repeatDates[] = $usableDates[$dateIndex];
                $computerRemaining--;
            }
            $dateIndex++;
        }

        $dateIndex = 0;
        while ($computerRemaining > 0) {
            $repeatDates[] = $usableDates[$dateIndex % count($usableDates)];
            $computerRemaining--;
            $dateIndex++;
        }

        sort($repeatDates);

        // Build schedule entries
        $finalSchedule = [];
        $computerIndex = 0;

        $groupedByDept = $unscheduledComputers->groupBy('dept');
        $sortedDepts = $groupedByDept->sortByDesc(function ($group) {
            return $group->count();
        });

        // Flatten the sorted groups into one ordered list
        $sortedComputer = collect();
        foreach ($sortedDepts as $group) {
            $sortedComputer = $sortedComputer->concat($group->sortBy('computer_code'));
        }
        $sortedComputer = $sortedComputer->values();

        foreach ($sortedComputer as $computerxz) {
            $inspectionDate = Carbon::parse($repeatDates[$computerIndex]);

            $finalSchedule[] = [
                'id_computer' => $computerxz->id,
                'tanggal_inspection' => $inspectionDate->toDateString(),
                'quarter' => $quarter,
                'bulan' => $inspectionDate->format('m'),
                'tahun' => $inspectionDate->format('Y'),
                'computer_code' => $computerxz->computer_code,
                'dept' => $computerxz->dept,
                'site' => $computerxz->site,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $computerIndex++;
        }

        DB::table('schedule_computer')->insert($finalSchedule);

        return response()->json([
            'message' => "Schedule generated successfully for $quarter $year.",
            'quarter' => $quarter,
            'total_scheduled' => count($finalSchedule),
        ], 201);
    }


}
