<?php

namespace App\Http\Controllers;

use App\Imports\SwitchImport;
use App\Models\InvSwitch;
use Carbon\Carbon;
use Dedoc\Scramble\Scramble;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use League\Csv\Reader;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class InvSwitchPikController extends Controller
{
    public function index()
    {

        $dataInventory = InvSwitch::where('site', 'PIK')->get();
        $site = auth()->user()->site;
        $role = auth()->user()->role;

        return Inertia::render('Inventory/SitePik/Switch/Switch', ['switch' => $dataInventory, 'site' => $site, 'role' => $role]);
    }

    public function create()
    {
        // start generate code
        $currentDate = Carbon::now();
        $year = $currentDate->format('y');
        $month = $currentDate->month;
        $day = $currentDate->day;


        $maxId = InvSwitch::where('site', 'PIK')->orderBy('max_id', 'desc')->first();
        // dd($maxId->inventory_number);

        if (is_null($maxId)) {
            $maxId = 0;
        } else {
            $noUrut = (int) substr($maxId->inventory_number, 7, 3);
            $maxId = $noUrut;
        }

        $uniqueString = 'PPAPIKSW' . str_pad(($maxId % 10000) + 1, 3, '0', STR_PAD_LEFT);

        $request['inventory_number'] = $uniqueString;
        // end generate code

        return Inertia::render('Inventory/SitePik/Switch/SwitchCreate', ['inventoryNumber' => $uniqueString]);
    }

    public function store(Request $request)
    {
        $maxId = InvSwitch::max('max_id');
        if (is_null($maxId)) {
            $maxId = 1;
        } else {
            $maxId = $maxId + 1;
        }
        $params = $request->all();
        $data = [
            'max_id' => $maxId,
            'device_name' => $params['device_name'],
            'inventory_number' => $params['inventory_number'],
            'asset_ho_number' => $params['asset_ho_number'],
            'serial_number' => $params['serial_number'],
            'mac_address' => $params['mac_address'],
            'ip_address' => $params['ip_address'],
            'device_brand' => $params['device_brand'],
            'device_type' => $params['device_type'],
            'device_model' => $params['device_model'],
            'location' => $params['location'],
            'status' => $params['status'],
            'note' => $params['note'],
            'site' => 'PIK'
        ];
        // DB::table('inv_aps')->insert($data);
        InvSwitch::create($data);
        return redirect()->route('switchPik.page');
    }

    public function uploadCsv(Request $request)
    {
        try {
            $import = new SwitchImport();
            Excel::import($import, $request->file('file'));
            $duplicates = $import->getDuplicateRecords();
            // dd($duplicates);
            return Redirect::route('switchPik.page')->with([
                'message' => 'Import selesai!',
                'duplicates' => $duplicates, // Kirim daftar duplikat
            ]);
        } catch (\Exception $ex) {
            Log::info($ex);
            return response()->json(['data' => 'Some error has occur.', 400]);
        }
    }

    public function edit($swId)
    {
        $switch = InvSwitch::find($swId);
        if (empty($switch)) {
            abort(404, 'Data not found');
        }
        return Inertia::render('Inventory/SitePik/Switch/SwitchEdit', ['switch' => $switch]);
    }

    public function detail($id)
    {
        $switch = InvSwitch::where('id', $id)->first();
        if (empty($switch)) {
            abort(404, 'Data not found');
        }

        return Inertia::render('Inventory/SitePik/Switch/SwitchDetail', [
            'switchs' => $switch,
        ]);
    }

    public function update(Request $request)
    {
        $params = $request->all();
        $data = [
            'device_name' => $params['device_name'],
            'inventory_number' => $params['inventory_number'],
            'asset_ho_number' => $params['asset_ho_number'],
            'serial_number' => $params['serial_number'],
            'mac_address' => $params['mac_address'],
            'ip_address' => $params['ip_address'],
            'device_brand' => $params['device_brand'],
            'device_type' => $params['device_type'],
            'device_model' => $params['device_model'],
            'location' => $params['location'],
            'status' => $params['status'],
            'note' => $params['note'],
            'site' => 'PIK'
        ];
        InvSwitch::firstWhere('id', $request->id)->update($data);
        return redirect()->route('switchPik.page');
    }

    public function destroy($swId)
    {
        $switch = InvSwitch::find($swId);
        if (empty($switch)) {
            abort(404, 'Data not found');
        }
        // return response()->json(['ap' => $switch]);
        $switch->delete();
        return redirect()->back();
    }
}
