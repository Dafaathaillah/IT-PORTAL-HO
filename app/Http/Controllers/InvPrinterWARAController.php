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
use Illuminate\Support\Facades\Redirect;

class InvPrinterWARAController extends Controller
{
    public function index()
    {
        $dataInventory = InvPrinter::where('site', 'ADW')->get();
        $site = auth()->user()->site;
        $role = auth()->user()->role;

        return Inertia::render('Inventory/SiteWARA/Printer/Printer', ['printer' => $dataInventory, 'site' => $site, 'role' => $role]);
    }

    public function create()
    {
        // start generate code
        $currentDate = Carbon::tomorrow();
        $year = $currentDate->format('y');
        $month = $currentDate->month;
        $day = $currentDate->day;

        $maxId = InvPrinter::where('site', 'ADW')->orderBy('max_id', 'desc')->first();
        // dd($maxId->printer_code);

        if (is_null($maxId)) {
            $maxId = 0;
        } else {
            preg_match('/(\d+)$/', $maxId->printer_code, $matches);
            $maxId = isset($matches[1]) ? (int) $matches[1] : null;
        }

        $uniqueString = 'PPAADWPRT' . str_pad(($maxId % 10000) + 1, 3, '0', STR_PAD_LEFT);

        $request['printer_code'] = $uniqueString;

        $department = Department::pluck('department_name')->map(function ($name) {
            return ['name' => $name];
        })->toArray();

        // end generate code

        return Inertia::render('Inventory/SiteWARA/Printer/PrinterCreate', ['printer_code' => $uniqueString, 'department' => $department]);
    }

    public function store(Request $request)
    {
        $isoDate = $request->date_of_inventory;
        $formattedDate = Carbon::parse($isoDate)->setTimezone('Asia/Ujung_Pandang')->toDateString();

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
            'date_of_inventory' => $formattedDate,
            'site' => 'ADW'
        ];
        // DB::table('inv_aps')->insert($data);
        InvPrinter::create($data);
        return redirect()->route('printerWARA.page');
    }

    public function uploadCsv(Request $request)
    {
        try {
            $import = new PrinterImport();
            Excel::import($import, $request->file('file'));
            $duplicates = $import->getDuplicateRecords();
            // dd($duplicates);
            return Redirect::route('printerWARA.page')->with([
                'message' => 'Import selesai!',
                'duplicates' => $duplicates, // Kirim daftar duplikat
            ]);
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

        return Inertia::render('Inventory/SiteWARA/Printer/PrinterDetail', [
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
        return Inertia::render('Inventory/SiteWARA/Printer/PrinterEdit', ['printer' => $printer, 'department' => $department, 'department_select' => $department_select]);
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
        $isoDate = $params['date_of_inventory'];
        $formattedDate = Carbon::parse($isoDate)->setTimezone('Asia/Ujung_Pandang')->toDateString();

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
            'date_of_inventory' => $formattedDate,
            'site' => 'ADW'
        ];
        // DB::table('inv_aps')->insert($data);
        InvPrinter::firstWhere('id', $request->id)->update($data);
        return redirect()->route('printerWARA.page');
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
