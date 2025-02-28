<?php

namespace App\Http\Controllers;

use App\Imports\PrinterImport;
use App\Models\Department;
use App\Models\InvPrinter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class InvPrinterPikController extends Controller
{
    public function index()
    {
        $dataInventory = InvPrinter::where('site', 'PIK')->get();
        $site = auth()->user()->site;
        $role = auth()->user()->role;

        return Inertia::render('Inventory/SitePik/Printer/Printer', ['printer' => $dataInventory, 'site' => $site, 'role' => $role]);
    }

    public function create()
    {
        // start generate code
        $currentDate = Carbon::tomorrow();
        $year = $currentDate->format('y');
        $month = $currentDate->month;
        $day = $currentDate->day;

        $maxId = InvPrinter::where('site', 'PIK')->orderBy('max_id', 'desc')->first();
        // dd($maxId->printer_code);

        if (is_null($maxId)) {
            $maxId = 0;
        } else {
            $noUrut = (int) substr($maxId->printer_code, 8, 3);
            $maxId = $noUrut;
        }

        $uniqueString = 'PPAPIKPRT' . str_pad(($maxId % 10000) + 1, 3, '0', STR_PAD_LEFT);

        $request['printer_code'] = $uniqueString;

        $department = Department::pluck('department_name')->map(function ($name) {
            return ['name' => $name];
        })->toArray();

        // end generate code

        return Inertia::render('Inventory/SitePik/Printer/PrinterCreate', ['printer_code' => $uniqueString, 'department' => $department]);
    }

    public function store(Request $request)
    {
        $currentDate = Carbon::now();
        $year = $currentDate->format('y');
        $month = $currentDate->month;
        $day = $currentDate->day;

        $maxId = InvPrinter::max('max_id');
        if (is_null($maxId)) {
            $maxId = 1;
        } else {
            $maxId = $maxId + 1;
        }
        $params = $request->all();
        $data = [
            'max_id' => $maxId,
            'item_name' => $params['item_name'],
            'printer_code' => $params['printer_code'],
            'asset_ho_number' => $params['asset_ho_number'],
            'serial_number' => $params['serial_number'],
            'mac_address' => $params['mac_address'],
            'ip_address' => $params['ip_address'],
            'printer_brand' => $params['device_brand'],
            'printer_type' => $params['device_type'],
            'division' => $params['divisi'],
            'department' => $params['dept'],
            'location' => $params['location'],
            'status' => $params['status'],
            'note' => $params['note'],
            'date_of_inventory' => $currentDate->format('Y-m-d H:i:s'),
            'site' => 'PIK'
        ];
        // DB::table('inv_aps')->insert($data);
        InvPrinter::create($data);
        return redirect()->route('printerPik.page');
    }

    public function uploadCsv(Request $request)
    {
        try {

            Excel::import(new PrinterImport, $request->file('file'));
            return redirect()->route('printerPik.page');
        } catch (\Exception $ex) {
            Log::info($ex);
            return response()->json(['data' => 'Some error has occur.', 400]);
        }
    }

    public function detail($id)
    {
        $printer = InvPrinter::where('id', $id)->first();
        if (empty($printer)) {
            abort(404, 'Data not found');
        }

        return Inertia::render('Inventory/SitePik/Printer/PrinterDetail', [
            'printers' => $printer,
        ]);
    }

    public function edit($printerId)
    {
        $printer = InvPrinter::find($printerId);

        if (empty($printer)) {
            abort(404, 'Data not found');
        }

        if (!empty($printer->department)) {
            $department_select = array($printer->department);
        } else {
            $department_select = array('data tidak ada !');
        }

        $department = Department::pluck('department_name')->map(function ($name) {
            return ['name' => $name];
        })->toArray();

        // return response()->json(['ap' => $accessPoint]);
        return Inertia::render('Inventory/SitePik/Printer/PrinterEdit', ['printer' => $printer, 'department' => $department, 'department_select' => $department_select]);
    }

    public function show($id)
    {
        $invPrinter = InvPrinter::find($id);

        if (empty($invPrinter)) {
            abort(404, 'Data not found');
        }

        if (is_null($invPrinter)) {
            return response()->json(['message' => 'Printers Data not found'], 404);
        }
        return response()->json($invPrinter);
    }

    public function update(Request $request)
    {
        $params = $request->all();
        $data = [
            'item_name' => $params['item_name'],
            'printer_code' => $params['printer_code'],
            'asset_ho_number' => $params['asset_ho_number'],
            'serial_number' => $params['serial_number'],
            'mac_address' => $params['mac_address'],
            'ip_address' => $params['ip_address'],
            'printer_brand' => $params['printer_brand'],
            'printer_type' => $params['printer_type'],
            'division' => $params['divisi'],
            'department' => $params['dept'],
            'location' => $params['location'],
            'status' => $params['status'],
            'note' => $params['note'],
            'site' => 'PIK'
        ];
        // DB::table('inv_aps')->insert($data);
        InvPrinter::firstWhere('id', $request->id)->update($data);
        return redirect()->route('printerPik.page');
    }

    public function destroy($id)
    {
        $invPrinter = InvPrinter::find($id);

        if (empty($invPrinter)) {
            abort(404, 'Data not found');
        }

        if (is_null($invPrinter)) {
            return response()->json(['message' => 'Printers Data not found'], 404);
        }
        $invPrinter->delete();
        return redirect()->back();
    }
}
