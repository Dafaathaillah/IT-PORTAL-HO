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

class InvPrinterController extends Controller
{
    public function index()
    {
        
        $dataInventory = InvPrinter::where('site',null)->orWhere('site','HO')->get();

        $site = '';

        $role = auth()->user()->role;
        return Inertia::render('Inventory/Printer/Printer', ['printer' => $dataInventory,'site' => $site,'role' => $role]);
    }

    public function create()
    {
        // start generate code
        $currentDate = Carbon::tomorrow();
        $year = $currentDate->format('y');
        $month = $currentDate->month;
        $day = $currentDate->day;

        if (auth()->user()->role == 'ict_developer' && auth()->user()->site == 'BIB') {
            $maxId = InvPrinter::where('site',null)->orWhere('site','HO')->orderBy('max_id', 'desc')->first();

            if (is_null($maxId)) {
                $maxId = 0;
            }else{
                $noUrut = (int) substr($maxId->printer_code, 8, 3);
                $maxId = $noUrut;
            }

            $uniqueString = 'PPABIBPRT' . str_pad(($maxId % 10000) + 1, 3, '0', STR_PAD_LEFT);
        }else if (auth()->user()->role == 'ict_ho' && auth()->user()->site == 'HO' || auth()->user()->role == 'ict_bod' && auth()->user()->site == 'HO') {
            $maxId = InvPrinter::where('site',null)->orWhere('site','HO')->orderBy('max_id', 'desc')->first();

            if (is_null($maxId)) {
                $maxId = 0;
            }else{
                $noUrut = (int) substr($maxId->printer_code, 8, 3);
                $maxId = $noUrut;
            }

            $uniqueString = 'PPAHOPRT' . str_pad(($maxId % 10000) + 1, 3, '0', STR_PAD_LEFT);
        }else{
            $maxId = InvPrinter::where('site','BA')->orderBy('max_id', 'desc')->first();
            // dd($maxId->printer_code);

            if (is_null($maxId)) {
                $maxId = 0;
            }else{
                $noUrut = (int) substr($maxId->printer_code, 8, 3);
                $maxId = $noUrut;
            }

            $uniqueString = 'PPABAPRT' . str_pad(($maxId % 10000) + 1, 3, '0', STR_PAD_LEFT);
        }

        $request['printer_code'] = $uniqueString;

        $department = Department::pluck('department_name')->map(function ($name) {
            return ['name' => $name];
        })->toArray();
        
        // end generate code

        return Inertia::render('Inventory/Printer/PrinterCreate', ['printer_code' => $uniqueString, 'department' => $department]);
    }

    public function store(Request $request)
    {
        $isoDate = $request->date_of_inventory;
        $formattedDate = Carbon::parse($isoDate)->setTimezone('Asia/Ujung_Pandang')->toDateString();

        $maxId = InvPrinter::max('max_id');
        if (is_null($maxId)) {
            $maxId = 1;
        }else{
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
            'site' => auth()->user()->site
        ];
        // DB::table('inv_aps')->insert($data);
        InvPrinter::create($data);
        return redirect()->route('printer.page');
    }

    public function uploadCsv(Request $request)
    {
        try {
            $import = new PrinterImport();
            Excel::import($import, $request->file('file'));
            $duplicates = $import->getDuplicateRecords();
            // dd($duplicates);
            return Redirect::route('printer.page')->with([
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
        
        return Inertia::render('Inventory/Printer/PrinterDetail', [
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
        }else{
            $department_select = array('data tidak ada !');
        }
        
        $department = Department::pluck('department_name')->map(function ($name) {
            return ['name' => $name];
        })->toArray();

        // return response()->json(['ap' => $accessPoint]);
        return Inertia::render('Inventory/Printer/PrinterEdit', ['printer' => $printer, 'department' => $department, 'department_select' => $department_select]);
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
            'site' => auth()->user()->site
        ];
        // DB::table('inv_aps')->insert($data);
        InvPrinter::firstWhere('id', $request->id)->update($data);
        return redirect()->route('printer.page');
    }

    public function destroy($id)
    {
        $invPrinter = InvPrinter::findOrFail($id);

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
