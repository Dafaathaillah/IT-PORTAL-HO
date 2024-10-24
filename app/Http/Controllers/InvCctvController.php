<?php

namespace App\Http\Controllers;

use App\Imports\ImportCctv;
use App\Models\Aduan;
use App\Models\InvCctv;
use App\Models\InvSwitch;
use Carbon\Carbon;
use Dedoc\Scramble\Scramble;
use Illuminate\Http\Request;
use Inertia\Inertia;
use League\Csv\Reader;
use Maatwebsite\Excel\Facades\Excel;

class InvCctvController extends Controller
{
    public function index()
    {
        $dataInventory = InvCctv::with('switch')->get();
        // return response()->json($dataInventory);
        return Inertia::render('Inventory/Cctv/Cctv', ['cctv' => $dataInventory]);
    }

    public function create()
    {
        // start generate code
        $currentDate = Carbon::tomorrow();
        $year = $currentDate->format('y');
        $month = $currentDate->month;
        $day = $currentDate->day;

        $maxId = InvCctv::max('max_id');

        if (is_null($maxId)) {
            $maxId = 0;
        }

        $uniqueString = 'PPABIBCCTV' . str_pad(($maxId % 10000) + 1, 3, '0', STR_PAD_LEFT);
        $request['inventory_number'] = $uniqueString;
        // end generate code

        $switch = InvSwitch::select('id', 'inventory_number')->get();


        return Inertia::render('Inventory/Cctv/CctvCreate', ['inventoryNumber' => $uniqueString, 'switch' => $switch]);
    }

    public function store(Request $request)
    {
        // return dd($request);
        $maxId = InvCctv::max('max_id');
        if (is_null($maxId)) {
            $maxId = 1;
        } else {
            $maxId = $maxId + 1;
        }

        $params = $request->all();
        $data = [
            'max_id' => $maxId,
            'asset_ho_number' => $params['asset_ho_number'],
            'cctv_code' => $params['cctv_code'],
            'location' => $params['location'],
            'location_detail' => $params['location_detail'],
            'cctv_name' => $params['cctv_name'],
            'cctv_brand' => $params['cctv_brand'],
            'cctv_model' => $params['cctv_model'],
            'type_cctv' => $params['type_cctv'],
            'mac_address' => $params['mac_address'],
            'ip_address' => $params['ip_address'],
            'nvr_id' => null,
            'switch_id' =>  $params['switch_id'],
            'date_of_inventory' => $params['date_of_inventory'],
            'vlan' => $params['vlan'],
            'uplink' => $params['uplink'],
            'status' => $params['status'],
            'note' => $params['note'],
        ];
        // dd($data);
        InvCctv::create($data);
        return redirect()->route('cctv.page');
    }

    public function uploadCsv(Request $request)
    {
        try {

            Excel::import(new ImportCctv, $request->file('file'));
            return redirect()->route('cctv.page');
        } catch (\Exception $ex) {
            Log::info($ex);
            return response()->json(['data' => 'Some error has occur.', 400]);
        }
    }

    public function edit($id)
    {
        $cctv = InvCctv::find($id);
        $selectSwitch = $cctv->switch_id;
        $switch = InvSwitch::select('id', 'inventory_number')->get();

        return Inertia::render('Inventory/Cctv/CctvEdit', [
            'cctv' => $cctv,
            'switch' => $switch,
            'selectSwitch' => $selectSwitch
        ]);
    }

    public function detail($id)
    {
        $cctv = InvCctv::where('cctv_code', $id)->first();
        $aduan = Aduan::where('inventory_number', $id)->get();
        // dd($aduan);

        return Inertia::render('Inventory/Cctv/CctvDetail', [
            'cctv' => $cctv,
            'aduan' => $aduan,
        ]);
    }

    public function update(Request $request)
    {
        $params = $request->all();
        $data = [
            'asset_ho_number' => $params['asset_ho_number'],
            'cctv_code' => $params['cctv_code'],
            'location' => $params['location'],
            'location_detail' => $params['location_detail'],
            'cctv_name' => $params['cctv_name'],
            'cctv_brand' => $params['cctv_brand'],
            'cctv_model' => $params['cctv_model'],
            'type_cctv' => $params['type_cctv'],
            'mac_address' => $params['mac_address'],
            'ip_address' => $params['ip_address'],
            'nvr_id' => null,
            'switch_id' => $params['switch_id'],
            'date_of_inventory' => $params['date_of_inventory'],
            'vlan' => $params['vlan'],
            'uplink' => $params['uplink'],
            'status' => $params['status'],
            'note' => $params['note'],
        ];

        InvCctv::firstWhere('id', $request->id)->update($data);
        return redirect()->route('cctv.page');
    }
    public function destroy($id)
    {
        $laptop = InvCctv::find($id);
        // return response()->json(['ap' => $laptop]);
        $laptop->delete();
        return redirect()->back();
    }
}
