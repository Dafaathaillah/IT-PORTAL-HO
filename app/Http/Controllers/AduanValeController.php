<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use App\Models\User;
use App\Models\UserAll;
use Carbon\Carbon;
use Dedoc\Scramble\Scramble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use League\Csv\Reader;
use Maatwebsite\Excel\Facades\Excel;

class AduanValeController extends Controller
{
    public function index()
    {

        $aduan = Aduan::where('site', 'VIB')
        ->whereNull('deleted_at')
            ->orderByRaw("
        CASE 
            WHEN urgency = 'URGENT' AND status IN ('OPEN', 'PROGRESS', 'CLOSED') THEN 0
            ELSE 1
        END
    ")
            ->orderBy('date_of_complaint', 'desc')
            ->get();
        $countOpen = Aduan::where('status', 'OPEN')->where('site', 'VIB')->count();
        $countClosed = Aduan::where('status', 'CLOSED')->where('site', 'VIB')->count();
        $countProgress = Aduan::where('status', 'PROGRESS')->where('site', 'VIB')->count();
        $countCancel = Aduan::where('status', 'CANCEL')->where('site', 'VIB')->count();

        $crew = User::whereIn('role', ['ict_technician', 'ict_group_leader'])->where('site', 'VIB')->pluck('name')->map(function ($name) {
            return ['name' => $name];
        })->toArray();

        return Inertia::render(
            'Inventory/SiteVale/Aduan/Aduan',
            [
                'aduan' => $aduan,
                'crew' => $crew,
                'open' => $countOpen,
                'closed' => $countClosed,
                'progress' => $countProgress,
                'cancel' => $countCancel,
            ]
        );
    }

    public function checkAduan(Request $request)
    {
        $aduanBaru = Aduan::where('site', 'VIB')->orderBy('id', 'desc')->first();

        if ($aduanBaru) {
            $response = [
                'id' => $aduanBaru->max_id,
                'site' => $aduanBaru->site,
                'message' => $aduanBaru->complaint_note
            ];

            if ($request->wantsJson() || $request->header('X-Inertia') !== 'true') {
                return response()->json($response);
            }
        }
    }

    public function create()
    {
        $categories = DB::table('root_cause_categories')
            ->select('id', 'category_root_cause')
            ->where('site_type', 'SITE')
            ->get();

        // start generate code
        $currentDate = Carbon::now();
        $year = $currentDate->format('y');
        $month = $currentDate->month;
        $day = $currentDate->day;

        $maxId = Aduan::whereDate('created_at', $currentDate->format('Y-m-d'))->where('site', 'VIB')->orderBy('max_id', 'desc')->first();

        if (is_null($maxId)) {
            $maxId = 0;
        } else {
            $split = explode('-', $maxId->complaint_code);
            $noUrut = (int) $split[2];
            $maxId = $noUrut;
        }

        $uniqueString = 'ADUAN-' . $year . $month . $day . '-' . str_pad(($maxId % 10000) + 1, 2, '0', STR_PAD_LEFT);
        $request['ticket'] = $uniqueString;

        $crew = User::where('site', 'VIB')->where('ict_group', 'Y')->pluck('name')->map(function ($name) {
            return ['name' => $name];
        })->toArray();

        return Inertia::render('Inventory/SiteVale/Aduan/AduanCreate', ['ticket' => $uniqueString, 'crew' => $crew, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $maxId = Aduan::max('max_id');
        if (is_null($maxId)) {
            $maxId = 1;
        } else {
            $maxId = $maxId + 1;
        }

        $data = [
            'max_id' => $maxId,
            'nrp' => $request['nrp'],
            'complaint_name' => $request['complaint_name'],
            'complaint_note' => $request['complaint_note'],
            'phone_number' => $request['phone_number'],
            'date_of_complaint' => $request['date_of_complaint'],
            'location' => $request['location'],
            'detail_location' => $request['location_detail'],
            'category_name' => $request['category_name'],
            'crew' => $request['crew'],
            'site' => 'VIB',
            'site_pelapor' => 'VIB'
        ];

        if ($request->file('image') != null) {
            $documentation_image = $request->file('image');
            $destinationPath = 'images/';
            $path_documentation_image = $documentation_image->store('images', 'public');
            $new_path_documentation_image = $path_documentation_image;
            $documentation_image->move($destinationPath, $new_path_documentation_image);

            $data['complaint_image'] =  url($new_path_documentation_image);
        }

        $data['complaint_code'] = $request->complaint_code;
        $data['created_date'] = Carbon::parse($request->date_of_complaint)->toDateString();

        if (!empty($request->inventory_number)) {
            $aduan_get_data_user = UserAll::where('nrp', $request->nrp)->first();
            if (!empty($aduan_get_data_user)) {
                $data['complaint_position'] = $aduan_get_data_user['position'];
            } else {
                $data['complaint_position'] = 'User Belum Terdaftar Pada Sistem (NRP Not Detect!)';
            }
            $data['inventory_number'] = $request->inventory_number;
            $data['status'] = 'OPEN';
            $aduan = Aduan::create($data);
        } else {
            $aduan_get_data_user = UserAll::where('nrp', $request->nrp)->first();
            if (!empty($aduan_get_data_user)) {
                $data['complaint_position'] = $aduan_get_data_user['position'];
            } else {
                $data['complaint_position'] = 'User Belum Terdaftar Pada Sistem (NRP Not Detect!)';
            }
            $data['status'] = 'OPEN';

            $aduan = Aduan::create($data);
        }
        return redirect()->route('aduanVale.page');
    }

    public function progress($id)
    {
        $aduan = Aduan::find($id);
        if (empty($aduan)) {
            abort(404, 'Data not found');
        }
        $crew = User::where('site', 'VIB')->where('ict_group', 'Y')->pluck('name')->map(function ($name) {
            return ['name' => $name];
        })->toArray();

        return Inertia::render('Inventory/SiteVale/Aduan/AduanProgress', [
            'aduan' => $aduan,
            'crew' => $crew,
        ]);
    }

    public function update_aduan_progress(Request $request)
    {
        $task = Aduan::find($request->id);
        $awal  = date_create($request->dateOfComplaint);
        $akhir = date_create($request->startResponse);
        $diff  = date_diff($awal, $akhir);
        $hTotal = $diff->d * 24 + ($diff->h);

        $jaditotal = sprintf('%02s', $hTotal) . ':' . sprintf('%02s', $diff->i) . ':' . sprintf('%02s', $diff->s);

        $response_time = $jaditotal;
        // end get response time

        $data = [
            'repair_note' => $request->repair_note,
            'status' => $request->status,
            'location' => $request->location,
            'detail_location' => $request->detail_location,
            'complaint_note' => $request->complaint_note,
            'action_repair' => $request->actionRepair,
            'date_of_complaint' => $request->dateOfComplaint,
            'start_response' => $request->startResponse,
            'start_progress' => $request->startProgress,
            'end_progress' => $request->endProgress,
        ];
        if ($request->crew != null || $request->crew != '') {
            $data['crew'] = $request->crew;
        }
        if ($request->file('image') != null) {
            $documentation_image = $request->file('image');
            $destinationPath = 'images/';
            $path_documentation_image = $documentation_image->store('images', 'public');
            $new_path_documentation_image = $path_documentation_image;
            $documentation_image->move($destinationPath, $new_path_documentation_image);

            $data['repair_image'] =  url($new_path_documentation_image);
        }


        $data['response_time'] = $response_time;

        $closing_aduan = Aduan::firstWhere('id', $request->id)->update($data);
        return redirect()->route('aduanVale.page');
    }

    public function updateUrgency(Request $request)
    {

        $request->validate([
            'id' => 'required|uuid', // atau 'required|integer' sesuai dengan tipe ID kamu
            'urgency' => 'required|in:NORMAL,URGENT',
        ]);

        $aduan = Aduan::findOrFail($request->id);
        $aduan->urgency = $request->urgency;
        $aduan->save();

        return response()->json(['message' => 'Urgency updated successfully']);
    }

    public function edit($id)
    {
        $categories = DB::table('root_cause_categories')
            ->select('id', 'category_root_cause')
            ->where('site_type', 'SITE')
            ->get();

        $aduan = Aduan::find($id);
        if (empty($aduan)) {
            abort(404, 'Data not found');
        }

        $selectCrew = explode(', ', $aduan->crew);
        $crew = User::where('site', 'VIB')->where('ict_group', 'Y')->pluck('name')->map(function ($name) {
            return ['name' => $name];
        })->toArray();
        return Inertia::render('Inventory/SiteVale/Aduan/AduanEdit', [
            'aduan' => $aduan,
            'crew' => $crew,
            'selectCrew' => $selectCrew,
            'categories' => $categories,
        ]);
    }

    public function update_aduan(Request $request)
    {
        $task = Aduan::find($request->id);
        $awal  = date_create($request->dateOfComplaint);
        $akhir = date_create($request->startResponse);
        $diff  = date_diff($awal, $akhir);
        $hTotal = $diff->d * 24 + ($diff->h);

        $jaditotal = sprintf('%02s', $hTotal) . ':' . sprintf('%02s', $diff->i) . ':' . sprintf('%02s', $diff->s);

        $response_time = $jaditotal;
        // end get response time

        $data = [
            'complaint_name' => $request->complaint_name,
            'nrp' => $request->nrp,
            'phone_number' => $request->phone_number,
            'category_name' => $request->category_name,
            'status' => $request->status,
            'repair_note' => $request->repair_note,
            'location' => $request->location,
            'detail_location' => $request->detail_location,
            'complaint_note' => $request->complaint_note,
            'action_repair' => $request->action_repair,
            'date_of_complaint' => $request->dateOfComplaint,
            'start_response' => $request->startResponse,
            'start_progress' => $request->startProgress,
            'end_progress' => $request->endProgress,
        ];
        if ($request->crew != null || $request->crew != '') {
            $data['crew'] = $request->crew;
        }
        if ($request->file('image') != null) {
            $documentation_image = $request->file('image');
            $destinationPath = 'images/';
            $path_documentation_image = $documentation_image->store('images', 'public');
            $new_path_documentation_image = $path_documentation_image;
            $documentation_image->move($destinationPath, $new_path_documentation_image);

            $data['repair_image'] =  url($new_path_documentation_image);
        }

        if (!empty($request->inventory_number)) {
            $aduan_get_data_user = UserAll::where('nrp', $request->nrp)->first();
            $data['complaint_position'] = $aduan_get_data_user['position'];
            $data['inventory_number'] = $request->inventory_number;
        } else {
            $aduan_get_data_user = UserAll::where('nrp', $request->nrp)->first();
            $data['complaint_position'] = $aduan_get_data_user['position'];
        }


        $data['response_time'] = $response_time;
        // return dd($data);

        $closing_aduan = Aduan::firstWhere('id', $request->id)->update($data);
        return redirect()->route('aduanVale.page');
    }

    public function show($id)
    {
        $aduan = Aduan::find($id);
        if (empty($aduan)) {
            abort(404, 'Data not found');
        }
        if (is_null($aduan)) {
            return response()->json(['message' => 'Aduan Data not found'], 404);
        }
        return response()->json($aduan);
    }

    public function detail($id)
    {
        $aduan = Aduan::where('id', $id)->first();
        if (empty($aduan)) {
            abort(404, 'Data not found');
        }
        return Inertia::render('Inventory/SiteVale/Aduan/AduanDetail', [
            'aduan' => $aduan,
        ]);
    }

    public function destroy($id)
    {
        $aduan = Aduan::find($id);
        if (empty($aduan)) {
            abort(404, 'Data not found');
        }
        $aduan->delete();
        return redirect()->back();
    }
}
