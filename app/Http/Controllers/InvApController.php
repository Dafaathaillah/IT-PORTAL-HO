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

class InvApController extends Controller
{

    /**
     * Display a listing of Inventory Access Point
     * @response InvAp[]
     */

    public function index()
    {
        
        $dataInventory = InvAp::where('site',null)->orWhere('site','HO')->get();

        $site = '';

        $role = auth()->user()->role;
        
        return Inertia::render('Inventory/AccessPoint/AccessPoint', ['accessPoint' => $dataInventory,'site' => $site,'role' => $role]);
    }

    public function create()
    {
        // start generate code
        $currentDate = Carbon::tomorrow();
        $year = $currentDate->format('y');
        $month = $currentDate->month;
        $day = $currentDate->day;

        if (auth()->user()->role == 'ict_developer' && auth()->user()->site == 'BIB') {
            $maxId = InvAp::where('site',null)->orWhere('site','HO')->orderBy('max_id', 'desc')->first();

            if (is_null($maxId)) {
                $maxId = 0;
            }else{
                $noUrut = (int) substr($maxId->inventory_number, 7, 3);
                $maxId = $noUrut;
            }

            $uniqueString = 'PPABIBAP' . str_pad(($maxId % 10000) + 1, 3, '0', STR_PAD_LEFT);
        }else if (auth()->user()->role == 'ict_ho' && auth()->user()->site == 'HO' || auth()->user()->role == 'ict_bod' && auth()->user()->site == 'HO') {
            $maxId = InvAp::where('site',null)->orWhere('site','HO')->orderBy('max_id', 'desc')->first();

            if (is_null($maxId)) {
                $maxId = 0;
            }else{
                $noUrut = (int) substr($maxId->inventory_number, 7, 3);
                $maxId = $noUrut;
            }

            $uniqueString = 'PPAHOAP' . str_pad(($maxId % 10000) + 1, 3, '0', STR_PAD_LEFT);
        }else{
            $maxId = InvAp::where('site','BA')->orderBy('max_id', 'desc')->first();
            // dd($maxId->inventory_number);

            if (is_null($maxId)) {
                $maxId = 0;
            }else{
                $noUrut = (int) substr($maxId->inventory_number, 7, 3);
                $maxId = $noUrut;
            }

            $uniqueString = 'PPABAAP' . str_pad(($maxId % 10000) + 1, 3, '0', STR_PAD_LEFT);
        }

        $request['inventory_number'] = $uniqueString;
        // end generate code

        return Inertia::render('Inventory/AccessPoint/AccessPointCreate', ['inventoryNumber' => $uniqueString]);
    }

    public function store(Request $request)
    {
        $maxId = InvAp::max('max_id');
        if (is_null($maxId)) {
            $maxId = 1;
        }else{
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
            'site' => auth()->user()->site
        ];
        // DB::table('inv_aps')->insert($data);
        InvAp::create($data);
        return redirect()->route('accessPoint.page');
    }

    // public function uploadCsv(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|mimes:csv,xlsx,xls',
    //     ]);

    //     $file = $request->file('file');
    //     $extension = $file->getClientOriginalExtension();

    //     $records = [];

    //     if ($extension === 'csv') {
    //         $csv = Reader::createFromPath($file->getRealPath(), 'r');
    //         $csv->setHeaderOffset(0); // Assuming the first row is the header
    //         $records = $csv->getRecords(); // Array of rows
    //     } elseif (in_array($extension, ['xls', 'xlsx'])) {
    //         $array = Excel::toArray(new MoviesImport, $file);
    //         dd($array);

    //         $excelData = Excel::toArray([], $file); // Converts the Excel file to an array
    //         $sheetData = $excelData[0]; // Assuming you are working with the first sheet

    //         // Assuming the first row is the header
    //         $header = array_shift($sheetData); // Extract header row
    //         foreach ($sheetData as $row) {
    //             $records[] = array_combine($header, $row); // Combine header with row data
    //         }
    //     }
    //     dd($records);
    //     // foreach ($records as $record) {
    //     //     $maxId = InvAp::max('max_id');
    //     //     if (is_null($maxId)) {
    //     //         $maxId = 1;
    //     //     }
    //     //     InvAp::create([
    //     //         'max_id' => $maxId,
    //     //         'device_name' => 'ada',
    //     //         'inventory_number' => 'ada',
    //     //         'serial_number' => 'ada',
    //     //         'ip_address' => 'ada',
    //     //         'device_brand' => 'ada',
    //     //         'device_type' => 'ada',
    //     //         'device_model' => 'ada',
    //     //         'location' => 'ada',
    //     //         'status' => 'ada',
    //     //         'note' => 'ada',
    //     //     ]);
    //     // }

    //     return redirect()->back()->with('success', 'File data imported successfully!');
    // }

    public function uploadCsv(Request $request)
    {
        try {

            Excel::import(new ImportAp, $request->file('file'));
            return redirect()->route('accessPoint.page');
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
        
        // return response()->json(['ap' => $accessPoint]);
        return Inertia::render('Inventory/AccessPoint/AccessPointEdit', ['accessPoint' => $accessPoint]);
    }

    public function detail($id)
    {
        $accessPoint = InvAp::where('id', $id)->first();
        if (empty($accessPoint)) {
            abort(404, 'Data not found');
        }
        
        return Inertia::render('Inventory/AccessPoint/AccessPointDetail', [
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
            'site' => auth()->user()->site
        ];
        InvAp::firstWhere('id', $request->id)->update($data);
        return redirect()->route('accessPoint.page');
    }

    public function destroy($apId)
    {
        $accessPoint = InvAp::findOrFail($apId);
        if (empty($accessPoint)) {
            abort(404, 'Data not found');
        }
        $accessPoint->delete();
        return redirect()->back();
    }
}
