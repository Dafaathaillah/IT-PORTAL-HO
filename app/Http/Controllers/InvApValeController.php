<?php

namespace App\Http\Controllers;

use App\Imports\ImportAp;
use App\Models\InvAp;
use Carbon\Carbon;
use Dedoc\Scramble\Scramble;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use League\Csv\Reader;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class InvApValeController extends Controller
{
    public function index()
    {
        $dataInventory = InvAp::where('site', 'VALE')->get();
        $site = 'VALE';
        $role = auth()->user()->role;

        return Inertia::render('Inventory/SiteVale/AccessPoint/AccessPoint', ['accessPoint' => $dataInventory, 'site' => $site, 'role' => $role]);
    }

    public function create()
    {
        // start generate code
        $currentDate = Carbon::tomorrow();
        $year = $currentDate->format('y');
        $month = $currentDate->month;
        $day = $currentDate->day;

        if (auth()->user()->role == 'ict_developer' || auth()->user()->site == 'VALE') {
            $maxId = InvAp::where('site', 'VALE')->orderBy('max_id', 'desc')->first();
            // dd($maxId->inventory_number);

            if (is_null($maxId)) {
                $maxId = 0;
            } else {
                $noUrut = (int) substr($maxId->inventory_number, 7, 3);
                $maxId = $noUrut;
            }

            $uniqueString = 'PPAVALEAP' . str_pad(($maxId % 10000) + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $maxId = '';
            $uniqueString = 'User Tidak Dikenali';
        }

        $request['inventory_number'] = $uniqueString;
        // end generate code

        return Inertia::render('Inventory/SiteVale/AccessPoint/AccessPointCreate', ['inventoryNumber' => $uniqueString]);
    }

    public function store(Request $request)
    {
        $maxId = InvAp::max('max_id');
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
            'frequency' => $params['frequency'],
            'mac_address' => $params['mac_address'],
            'ip_address' => $params['ip_address'],
            'device_brand' => $params['device_brand'],
            'device_type' => $params['device_type'],
            'device_model' => $params['device_model'],
            'location' => $params['location'],
            'status' => $params['status'],
            'note' => $params['note'],
            'site' => 'VALE'
        ];
        // DB::table('inv_aps')->insert($data);
        InvAp::create($data);
        return redirect()->route('accessPointVale.page');
    }

    public function uploadCsv(Request $request)
    {
        try {

            Excel::import(new ImportAp, $request->file('file'));
            return redirect()->route('accessPointVale.page');
        } catch (\Exception $ex) {
            Log::info($ex);
            return response()->json(['data' => 'Some error has occur.', 400]);
        }
    }

    public function edit($apId)
    {
        $accessPoint = InvAp::find($apId);
        if (empty($accessPoint)) {
            abort(404, 'Data not found');
        }

        return Inertia::render('Inventory/SiteVale/AccessPoint/AccessPointEdit', ['accessPoint' => $accessPoint]);
    }

    public function detail($id)
    {
        $accessPoint = InvAp::where('id', $id)->first();
        if (empty($accessPoint)) {
            abort(404, 'Data not found');
        }

        return Inertia::render('Inventory/SiteVale/AccessPoint/AccessPointDetail', [
            'accessPoints' => $accessPoint,
        ]);
    }

    public function show($id)
    {
        $invap = InvAp::find($id);
        if (is_null($invap)) {
            return response()->json(['message' => 'AP Device not found'], 404);
        }
        return response()->json($invap);
    }

    public function update(Request $request)
    {
        $params = $request->all();
        $data = [
            'device_name' => $params['device_name'],
            'inventory_number' => $params['inventory_number'],
            'asset_ho_number' => $params['asset_ho_number'],
            'serial_number' => $params['serial_number'],
            'frequency' => $params['frequency'],
            'mac_address' => $params['mac_address'],
            'ip_address' => $params['ip_address'],
            'device_brand' => $params['device_brand'],
            'device_type' => $params['device_type'],
            'device_model' => $params['device_model'],
            'location' => $params['location'],
            'status' => $params['status'],
            'note' => $params['note'],
            'site' => 'VALE'
        ];
        // DB::table('inv_aps')->insert($data);
        InvAp::firstWhere('id', $request->id)->update($data);
        return redirect()->route('accessPointVale.page');
    }

    public function destroy($apId)
    {
        $accessPoint = InvAp::find($apId);
        if (empty($accessPoint)) {
            abort(404, 'Data not found');
        }

        // return response()->json(['ap' => $accessPoint]);
        $accessPoint->delete();
        return redirect()->back();
    }
}
