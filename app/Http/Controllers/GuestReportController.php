<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use App\Models\UserAll;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GuestReportController extends Controller
{
    public function index()
    {
        $aduan = Aduan::orderBy('date_of_complaint', 'desc')->get();
        $countOpen = Aduan::where('status', 'OPEN')->count();
        $countClosed = Aduan::where('status', 'CLOSED')->count();
        $countProgress = Aduan::where('status', 'PROGRESS')->count();
        $countCancel = Aduan::where('status', 'CANCEL')->count();
        return Inertia::render(
            'Guest/GuestAduan',
            [
                'aduan' => $aduan,
                'open' => $countOpen,
                'closed' => $countClosed,
                'progress' => $countProgress,
                'cancel' => $countCancel,
            ]
        );
    }

    public function create()
    {
        // return dd($complaintDataNrp);

        // start generate code
        $currentDate = Carbon::now();
        $year = $currentDate->format('y');
        $month = $currentDate->month;
        $day = $currentDate->day;

        $maxId = Aduan::whereDate('created_at', $currentDate->format('Y-m-d'))->max('id');

        if (is_null($maxId)) {
            $maxId = 0;
        }

        $uniqueString = 'ADUAN-' . $year . $month . $day . '-' . str_pad(($maxId % 10000) + 1, 2, '0', STR_PAD_LEFT);
        $request['ticket'] = $uniqueString;

         $complaintDataNrp = UserAll::select('nrp', 'username')->get()->toArray();

        // return response()->json($crew);
        // end generate code
        return Inertia::render('Guest/GuestAduanCreate', ['ticket' => $uniqueString, 'complaintDataNrp' => $complaintDataNrp]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $maxId = Aduan::max('max_id');
        if (is_null($maxId)) {
            $maxId = 1;
        } else {
            $maxId = $maxId + 1;
        }

        $data = [
            'max_id' => $maxId,
            'nrp' => $request['nrp'],
            'complaint_note' => $request['complaint_note'],
            'phone_number' => $request['phone_number'],
            'date_of_complaint' => Carbon::now('Asia/Ujung_Pandang')->format('Y-m-d H:i:s'),
            'location' => $request['location'],
            'detail_location' => $request['location_detail'],
            'category_name' => $request['category_name'],
        ];

        if (empty($request['complaint_name'])) {
            $data['complaint_name'] = 'User Belum Terdaftar Pada Sistem (NRP Not Detect!)';
        }else{
            $data['complaint_name'] = $request['complaint_name'];
        }

        if ($request->file('image') != null) {
            $documentation_image = $request->file('image');
            $destinationPath = 'images/';
            $path_documentation_image = $documentation_image->store('images', 'public');
            $new_path_documentation_image = $path_documentation_image;
            $documentation_image->move($destinationPath, $new_path_documentation_image);

            $data['complaint_image'] =  url($new_path_documentation_image);
        }

        $data['complaint_code'] = $request->complaint_code;
        $data['created_date'] = Carbon::now()->format('Y-m-d');

        if (!empty($request->inventory_number)) {
            $aduan_get_data_user = UserAll::where('nrp', $request->nrp)->first();
            if (!empty($aduan_get_data_user)) {
                $data['complaint_position'] = $aduan_get_data_user['position'];
            }else{
                $data['complaint_position'] = 'User Belum Terdaftar Pada Sistem (NRP Not Detect!)';
            }
            $data['inventory_number'] = $request->inventory_number;
            $data['status'] = 'OPEN';
            // return response()->json($data);
            $aduan = Aduan::create($data);
        } else {
            $aduan_get_data_user = UserAll::where('nrp', $request->nrp)->first();
            if (!empty($aduan_get_data_user)) {
                $data['complaint_position'] = $aduan_get_data_user['position'];
            }else{
                $data['complaint_position'] = 'User Belum Terdaftar Pada Sistem (NRP Not Detect!)';
            }
            $data['status'] = 'OPEN';

            $aduan = Aduan::create($data);
        }
        // return dd($data);
        return redirect()->route('guestAduan.page');
    }

    public function destroy($id)
    {
        $aduan = Aduan::find($id);
        // return response()->json(['ap' => $aduan]);
        $aduan->delete();
        return redirect()->back();
    }
}
