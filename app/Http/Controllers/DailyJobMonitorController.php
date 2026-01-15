<?php

namespace App\Http\Controllers;

use App\Models\DailyJob;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;


class DailyJobMonitorController extends Controller
{
    protected function getSiteFromRequest(Request $request): string
    {
        $prefix = $request->route()->getPrefix();
        return str_replace('monitoring-jobs-', '', $prefix);
    }

    public function index(Request $request)
    {
        $site_link = $this->getSiteFromRequest($request);
        $site = strtoupper($this->getSiteFromRequest($request));

        $today = Carbon::today();
        $user = Auth::user();
        $auth = $user->role;
        $userSite = $user->site;

        if ($auth == 'ict_technician' || $auth == 'ict_group_leader' || $auth == 'ict_admin') {
            if ($site != $userSite) {
                abort(403, 'You dont have permission to access this page.');
            }
        }

        // Optional filters
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $shift = $request->shift;
        $status = $request->status;

        $scheduledJobs = DailyJob::with('creator')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate]);
            }, function ($query) use ($today) {

                $query->where(function ($q) use ($today) {
                    $q->whereDate('date', $today)
                        ->Where('status', '!=', 'closed');
                });
            })
            ->when($shift, function ($query) use ($shift) {
                $query->where('shift', $shift);
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->where('category_job', '!=', 'unschedule')
            ->when($site, function ($query) use ($site) {
                $query->where('site', $site);
            })
            ->orderBy('date', 'desc')
            ->get();

        $unscheduledJobs = DailyJob::with('creator')
            ->where('category_job', 'unschedule')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate]);
            }, function ($query) use ($today) {

                $query->where(function ($q) use ($today) {
                    $q->whereDate('date', $today);
                });
            })
            ->when($shift, function ($query) use ($shift) {
                $query->where('shift', $shift);
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($site, function ($query) use ($site) {
                $query->where('site', $site);
            })
            ->orderBy('date', 'desc')
            ->get();

        $users = User::select('id', 'name')->get();

        $canApprove = in_array(auth()->user()->role, [
            'ict_developer',
            'ict_group_leader',
        ]);
        // dd($canApprove);


        $allApprovedToday = DailyJob::whereDate('date', Carbon::today())
            ->where('site', $site)
            ->whereNull('approval_status')
            ->doesntExist();

        $filters = request()->only(['start_date', 'end_date', 'shift', 'status', 'site']);

        return Inertia::render('DailyJobs/MonitoringJobsDashboard', [
            'scheduledJobs' => $scheduledJobs,
            'unscheduledJobs' => $unscheduledJobs,
            'users' => $users,
            'site_link' => $site_link,
            'filters' => $filters,
            'canApprove' => $canApprove,
            'allApprovedToday' => $allApprovedToday,
        ]);
    }

    public function approveAll(Request $request)
    {
        $user = Auth::user();
        $site = strtoupper($this->getSiteFromRequest($request));

        // 🔐 Role protection
        if (!in_array($user->role, ['ict_group_leader', 'ict_developer'])) {
            abort(403, 'You are not authorized to approve jobs');
        }

        $affected = DailyJob::whereDate('date', Carbon::today())
            ->where('site', $site)
            ->whereNull('approval_status') // hanya yang belum approved
            ->update([
                'approval_status' => 'approved',
                'updated_by'      => $user->id,
                'updated_at'      => now(),
            ]);

        return back()->with(
            'success',
            "Berhasil approve {$affected} job hari ini"
        );
    }


    public function exportReportMonitoring(Request $request)
    {

        $site = strtoupper($this->getSiteFromRequest($request));
        $today = Carbon::today();

        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $shift = $request->shift;
        $status = $request->status;

        $scheduledJobs = DailyJob::with('creator')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate]);
            }, function ($query) use ($today) {

                $query->where(function ($q) use ($today) {
                    $q->whereDate('date', $today)
                        ->Where('status', '!=', 'closed');
                });
            })
            ->when($shift, function ($query) use ($shift) {
                $query->where('shift', $shift);
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->where('category_job', '!=', 'unschedule')
            ->when($site, function ($query) use ($site) {
                $query->where('site', $site);
            })
            ->orderBy('date', 'desc')
            ->get();

        $users = User::all(['id', 'name'])->keyBy('id');

        foreach ($scheduledJobs as $job) {
            $crewIds = $job->crew ?? [];
            $job->crew_names = collect($crewIds)->map(fn ($id) => $users[$id]->name ?? 'Unknown')->toArray();
        }

        // dd($scheduledJobs);

        $unscheduledJobs = DailyJob::with('creator')
            ->where('category_job', 'unschedule')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate]);
            }, function ($query) use ($today) {

                $query->where(function ($q) use ($today) {
                    $q->whereDate('date', $today);
                });
            })
            ->when($shift, function ($query) use ($shift) {
                $query->where('shift', $shift);
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($site, function ($query) use ($site) {
                $query->where('site', $site);
            })
            ->orderBy('date', 'desc')
            ->get();


        foreach ($unscheduledJobs as $job) {
            $crewIds = $job->crew ?? [];
            $job->crew_names = collect($crewIds)->map(fn ($id) => $users[$id]->name ?? 'Unknown')->toArray();
        }

        // dd($request->start_date);

        $job_assignment_count = $scheduledJobs->count();
        $unschedule_count = $unscheduledJobs->count();
        $total_jobs = $job_assignment_count + $unschedule_count;

        // Calculate percentages (handle division by zero)
        $job_assignment_percentage = $total_jobs > 0 ? round(($job_assignment_count / $total_jobs) * 100) : 0;
        $unschedule_percentage = $total_jobs > 0 ? round(($unschedule_count / $total_jobs) * 100) : 0;

        $data = [
            'date' => now()->format('d M Y'),
            'shift' => '3',
            'assignments' => $scheduledJobs,
            'unscheduled' => $unscheduledJobs,
            'job_assignment_count' => $job_assignment_count,
            'unschedule_count' => $unschedule_count,
            'job_assignment_percentage' => $job_assignment_percentage,
            'unschedule_percentage' => $unschedule_percentage,
        ];

        // dd($site);

        $pdf = Pdf::loadView('dailyJobs.report-monitoring', $data)->setPaper('A4', 'portrait');
        return $pdf->download('daily-report-monitoring.pdf');
    }
}
