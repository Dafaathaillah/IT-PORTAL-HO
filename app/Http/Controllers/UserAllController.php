<?php

namespace App\Http\Controllers;

use App\Models\UserAll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class UserAllController extends Controller
{
    public function index()
    {
        $dataPengguna = UserAll::all();
        return Inertia::render('ManagementUser/ManagementUser', ['managementUser' => $dataPengguna]);
    }

    public function create()
    {
        return Inertia::render('ManagementUser/ManagementUserCreate');
    }

    public function store(Request $request)
    {
        $maxId = UserAll::max('max_id');
        if (is_null($maxId)) {
            $maxId = 1;
        } else {
            $maxId = $maxId + 1;
        }
        $params = $request->all();

        if (empty($request->id)) {
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
            ];
            // DB::table('inv_aps')->insert($data);
            UserAll::create($data);
        } else {
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
            ];
            // DB::table('inv_aps')->insert($data);
            UserAll::firstWhere('id', $request->id)->update($data);
        }
        return redirect()->route('managementUser.page');
    }

    public function uploadCsv(Request $request)
    {
        try {

            Excel::import(new ImportAp, $request->file('file'));
            return redirect()->route('managementUser.page');
        } catch (\Exception $ex) {
            Log::info($ex);
            return response()->json(['data' => 'Some error has occur.', 400]);
        }
    }

    public function edit($apId)
    {
        $managementUser = UserAll::find($apId);
        // return response()->json(['ap' => $managementUser]);
        return Inertia::render('ManagementUser/ManagementUserEdit', ['managementUser' => $managementUser]);
    }

    public function show($id)
    {
        $invap = UserAll::find($id);
        if (is_null($invap)) {
            return response()->json(['message' => 'AP Device not found'], 404);
        }
        return response()->json($invap);
    }

    public function destroy($apId)
    {
        $managementUser = UserAll::find($apId);
        // return response()->json(['ap' => $managementUser]);
        $managementUser->delete();
        return redirect()->back();
    }
}
