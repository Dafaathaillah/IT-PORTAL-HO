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
use Illuminate\Support\Facades\Redirect;

class InvApSksController extends Controller
{
    public function index()
    {
        $dataInventory = InvAp::where('site', 'SKS')->get();
        $site = 'SKS';
        $role = auth()->user()->role;

        return Inertia::render('Inventory/SiteSks/AccessPoint/AccessPoint', ['accessPoint' => $dataInventory, 'site' => $site, 'role' => $role]);
    }

    public function create()
    {
        // start generate code
        $currentDate = Carbon::tomorrow();
        $year = $currentDate->format('y');
        $month = $currentDate->month;
        $day = $currentDate->day;

        if (auth()->user()->role == 'ict_developer' || auth()->user()->site == 'SKS') {
            $maxId = InvAp::where('site', 'SKS')->orderBy('max_id', 'desc')->first();
            // dd($maxId->inventory_number);

            if (is_null($maxId)) {
                $maxId = 0;
            } else {
                $noUrut = (int) substr($maxId->inventory_number, 7, 3);
                $maxId = $noUrut;
            }

            $uniqueString = 'PPASKSAP' . str_pad(($maxId % 10000) + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $maxId = '';
            $uniqueString = 'User Tidak Dikenali';
        }

        $request['inventory_number'] = $uniqueString;
        // end generate code

        return Inertia::render('Inventory/SiteSks/AccessPoint/AccessPointCreate', ['inventoryNumber' => $uniqueString]);
    }

    public function store(Request $request)
    {
        $isoDate = $request->date_of_inventory;
        $formattedDate = Carbon::parse($isoDate)->toDateString();

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
            'date_of_inventory' => $formattedDate,
            'note' => $params['note'],
            'site' => 'SKS'
        ];
        // DB::table('inv_aps')->insert($data);
        InvAp::create($data);
        return redirect()->route('accessPointSks.page');
    }

    public function uploadCsv(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx,csv|max:10240', // 10MB = 10240 KB
        ]);
        
        try {
            $import = new ImportAp();
            Excel::import($import, $request->file('file'));
            $duplicates = $import->getDuplicateRecords();
            // dd($duplicates);
            return Redirect::route('accessPointSks.page')->with([
                'message' => 'Import selesai!',
                'duplicates' => $duplicates, // Kirim daftar duplikat
            ]);
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

        return Inertia::render('Inventory/SiteSks/AccessPoint/AccessPointEdit', ['accessPoint' => $accessPoint]);
    }

    public function detail($id)
    {
        $accessPoint = InvAp::where('id', $id)->first();
        if (empty($accessPoint)) {
            abort(404, 'Data not found');
        }

        return Inertia::render('Inventory/SiteSks/AccessPoint/AccessPointDetail', [
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
        $isoDate = $params['date_of_inventory'];
        $formattedDate = Carbon::parse($isoDate)->toDateString();

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
            'date_of_inventory' => $formattedDate,
            'note' => $params['note'],
            'site' => 'SKS'
        ];
        // DB::table('inv_aps')->insert($data);
        InvAp::firstWhere('id', $request->id)->update($data);
        return redirect()->route('accessPointSks.page');
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
