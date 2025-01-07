<?php

namespace App\Http\Controllers;

use App\Imports\ScannerImport;
use App\Models\Department;
use App\Models\InvScanner;
use Carbon\Carbon;
use Dedoc\Scramble\Scramble;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use League\Csv\Reader;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class InvScannerAmiController extends Controller
{
    public function index()
    {
        $dataInventory = InvScanner::where('site', 'AMI')->get();
        $site = auth()->user()->site;
        $role = auth()->user()->role;
        return Inertia::render('Inventory/SiteAmi/Scanner/Scanner', ['scanner' => $dataInventory, 'site' => $site, 'role' => $role]);
    }

    public function create()
    {
        // start generate code
        $currentDate = Carbon::tomorrow();
        $year = $currentDate->format('y');
        $month = $currentDate->month;
        $day = $currentDate->day;

        $maxId = InvScanner::where('site', 'AMI')->orderBy('max_id', 'desc')->first();
        // dd($maxId->scanner_code);

        if (is_null($maxId)) {
            $maxId = 0;
        } else {
            $noUrut = (int) substr($maxId->scanner_code, 8, 3);
            $maxId = $noUrut;
        }

        $uniqueString = 'PPAAMISCN' . str_pad(($maxId % 10000) + 1, 3, '0', STR_PAD_LEFT);

        $request['scanner_code'] = $uniqueString;

        $department = Department::pluck('department_name')->map(function ($name) {
            return ['name' => $name];
        })->toArray();

        // end generate code

        return Inertia::render('Inventory/SiteAmi/Scanner/ScannerCreate', ['scanner_code' => $uniqueString, 'department' => $department]);
    }

    public function store(Request $request)
    {
        $currentDate = Carbon::now();
        $year = $currentDate->format('y');
        $month = $currentDate->month;
        $day = $currentDate->day;

        $maxId = InvScanner::max('max_id');
        if (is_null($maxId)) {
            $maxId = 1;
        } else {
            $maxId = $maxId + 1;
        }
        $params = $request->all();
        $data = [
            'max_id' => $maxId,
            'item_name' => $params['item_name'],
            'scanner_code' => $params['scanner_code'],
            'asset_ho_number' => $params['asset_ho_number'],
            'serial_number' => $params['serial_number'],
            'mac_address' => $params['mac_address'],
            'ip_address' => $params['ip_address'],
            'scanner_brand' => $params['device_brand'],
            'scanner_type' => $params['device_type'],
            'division' => $params['divisi'],
            'department' => $params['dept'],
            'location' => $params['location'],
            'status' => $params['status'],
            'note' => $params['note'],
            'date_of_inventory' => $currentDate->format('Y-m-d H:i:s'),
            'site' => 'AMI'
        ];
        // DB::table('inv_aps')->insert($data);
        InvScanner::create($data);
        return redirect()->route('scannerAmi.page');
    }

    public function uploadCsv(Request $request)
    {
        try {

            Excel::import(new ScannerImport, $request->file('file'));
            return redirect()->route('scannerAmi.page');
        } catch (\Exception $ex) {
            Log::info($ex);
            return response()->json(['data' => 'Some error has occur.', 400]);
        }
    }

    public function detail($id)
    {
        $scanner = InvScanner::where('id', $id)->first();

        if (empty($scanner)) {
            abort(404, 'Data not found');
        }

        return Inertia::render('Inventory/SiteAmi/Scanner/ScannerDetail', [
            'scanners' => $scanner,
        ]);
    }

    public function edit($id)
    {
        $scanner = InvScanner::find($id);
        if (empty($scanner)) {
            abort(404, 'Data not found');
        }

        if (!empty($scanner->department)) {
            $department_select = array($scanner->department);
        } else {
            $department_select = array('data tidak ada !');
        }

        $department = Department::pluck('department_name')->map(function ($name) {
            return ['name' => $name];
        })->toArray();

        return Inertia::render('Inventory/SiteAmi/Scanner/ScannerEdit', ['scanner' => $scanner, 'department' => $department, 'department_select' => $department_select]);
    }

    public function update(Request $request)
    {
        $params = $request->all();
        // dd($params);
        $data = [
            'item_name' => $params['item_name'],
            'scanner_code' => $params['scanner_code'],
            'asset_ho_number' => $params['asset_ho_number'],
            'serial_number' => $params['serial_number'],
            'mac_address' => $params['mac_address'],
            'ip_address' => $params['ip_address'],
            'scanner_brand' => $params['scanner_brand'],
            'scanner_type' => $params['scanner_type'],
            'division' => $params['divisi'],
            'department' => $params['dept'],
            'location' => $params['location'],
            'status' => $params['status'],
            'note' => $params['note'],
            'site' => 'AMI'
        ];
        // DB::table('inv_aps')->insert($data);
        InvScanner::firstWhere('id', $request->id)->update($data);
        return redirect()->route('scannerAmi.page');
    }


    public function destroy($id)
    {
        $scanner = InvScanner::find($id);
        if (empty($scanner)) {
            abort(404, 'Data not found');
        }
        // return response()->json(['ap' => $scanner]);
        $scanner->delete();
        return redirect()->back();
    }
}
