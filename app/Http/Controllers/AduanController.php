<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use App\Models\UserAll;
use Carbon\Carbon;
use Dedoc\Scramble\Scramble;
use Illuminate\Http\Request;
use Inertia\Inertia;
use League\Csv\Reader;
use Maatwebsite\Excel\Facades\Excel;

class AduanController extends Controller
{
    public function index()
    {
        $aduan = Aduan::all();
        return Inertia::render('Aduan/Aduan', ['aduan' => $aduan]);
    }

    public function create()
    {
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
        $crew = UserAll::pluck('username')->map(function ($name) {
            return ['name' => $name];
        })->toArray();
        // return response()->json($crew);
        // end generate code
        return Inertia::render('Aduan/AduanCreate', ['ticket' => $uniqueString, 'crew' => $crew]);
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
            'complaint_name' => $request['complaint_name'],
            'complaint_note' => $request['complaint_note'],
            'phone_number' => $request['phone_number'],
            'date_of_complaint' => $request['date_of_complaint'],
            'location' => $request['location'],
            'detail_location' => $request['detail_location'],
            'category_name' => $request['category_name'],
            'crew' => $request['crew'],
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
            $data['complaint_position'] = $aduan_get_data_user['position'];
            $data['inventory_number'] = $request->inventory_number;
            $data['status'] = 'OPEN';
            // return response()->json($data);
            $aduan = Aduan::create($data);
        } else {
            $aduan_get_data_user = UserAll::where('nrp', $request->nrp)->first();
            $data['complaint_position'] = $aduan_get_data_user['position'];
            $data['status'] = 'OPEN';

            $aduan = Aduan::create($data);
        }
        return redirect()->route('aduan.page');
    }

    public function progress($id)
    {
        $aduan = Aduan::find($id);
        $crew = UserAll::pluck('username')->map(function ($name) {
            return ['name' => $name];
        })->toArray();

        // return response()->json($crew);
        // dd($crew);
        return Inertia::render('Aduan/AduanProgress', [
            'aduan' => $aduan,
            'crew' => $crew,
        ]);
    }

    public function update_aduan(Request $request)
    {
        // start get response time
        $aduan_get_data_complaint = Aduan::find($request->id);

        $task = Aduan::find($aduan_get_data_complaint->id);
        $date_of_complaint = new Carbon($task->date_of_complaint);
        $start_response = new Carbon($request->start_response);

        $diff = $date_of_complaint->diff($start_response);

        $hours = $diff->h;
        $minutes = $diff->i;
        $seconds = $diff->s;

        $diffInSeconds = $date_of_complaint->diffInSeconds($start_response);
        $formattedDiff = gmdate('H:i:s', $diffInSeconds);
        // end get response time

        $validate_closing = $request->validate([
            'repair_note' => 'required|string|max:255',
            'status' => 'nullable|string',
            'root_cause' => 'nullable|string',
            'action_repair' => 'nullable|string',
            'inventory_number' => 'nullable|string',
            'start_response' => 'nullable|date_format:Y-m-d H:i:s',
            'crew' => 'nullable|string',
            'start_progress' => 'nullable|date_format:Y-m-d H:i:s',
            'end_progress' => 'nullable|date_format:Y-m-d H:i:s',
        ]);

        $validate_closing['response_time'] = $formattedDiff;

        $closing_aduan = Aduan::firstWhere('id', $request->id)->update($validate_closing);
        return response()->json($validate_closing, 201);
    }

    public function show($id)
    {
        $aduan = Aduan::find($id);
        if (is_null($aduan)) {
            return response()->json(['message' => 'Aduan Data not found'], 404);
        }
        return response()->json($aduan);
    }

    public function destroy($id)
    {
        $aduan = Aduan::find($id);
        if (is_null($aduan)) {
            return response()->json(['message' => 'User All SIte Data not found'], 404);
        }
        $aduan->delete();
        return response()->json(null, 204);
    }
}
