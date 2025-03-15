<?php

namespace App\Http\Controllers;

use App\Imports\WirellessImport;
use App\Models\InvWirelless;
use Carbon\Carbon;
use Dedoc\Scramble\Scramble;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use League\Csv\Reader;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class InvWirellessMifaController extends Controller
{
    public function index()
    {
        $dataInventory = InvWirelless::where('site', 'MIFA')->get();
        $site = auth()->user()->site;
        $role = auth()->user()->role;

        return Inertia::render('Inventory/SiteMifa/Wirelless/Wirelless', ['wirelless' => $dataInventory, 'site' => $site, 'role' => $role]);
    }

    public function create()
    {
        // start generate code
        $currentDate = Carbon::now();
        $year = $currentDate->format('y');
        $month = $currentDate->month;
        $day = $currentDate->day;

        $maxId = InvWirelless::where('site', 'MIFA')->orderBy('max_id', 'desc')->first();
        // dd($maxId->inventory_number);

        if (is_null($maxId)) {
            $maxId = 0;
        } else {
            $noUrut = (int) substr($maxId->inventory_number, 7, 3);
            $maxId = $noUrut;
        }

        $uniqueString = 'PPAMIFABB' . str_pad(($maxId % 10000) + 1, 3, '0', STR_PAD_LEFT);

        $request['inventory_number'] = $uniqueString;
        // end generate code

        return Inertia::render('Inventory/SiteMifa/Wirelless/WirellessCreate', ['inventoryNumber' => $uniqueString]);
    }

    public function store(Request $request)
    {
        $isoDate = $request->date_of_inventory;
        $formattedDate = Carbon::parse($isoDate)->setTimezone('Asia/Ujung_Pandang')->toDateString();


        $maxId = InvWirelless::max('max_id');
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
            'site' => 'MIFA'
        ];
        // DB::table('inv_aps')->insert($data);
        InvWirelless::create($data);
        return redirect()->route('wirellessMifa.page');
    }

    public function uploadCsv(Request $request)
    {
        try {
            $import = new WirellessImport();
            Excel::import($import, $request->file('file'));
            $duplicates = $import->getDuplicateRecords();
            // dd($duplicates);
            return Redirect::route('wirellessMifa.page')->with([
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
        $wirelless = InvWirelless::where('id', $id)->first();

        if (empty($wirelless)) {
            abort(404, 'Data not found');
        }

        return Inertia::render('Inventory/SiteMifa/Wirelless/WirellessDetail', [
            'wirelless' => $wirelless,
        ]);
    }

    public function edit($id)
    {
        $wirelless = InvWirelless::find($id);
        if (empty($wirelless)) {
            abort(404, 'Data not found');
        }
        return Inertia::render('Inventory/SiteMifa/Wirelless/WirellessEdit', ['wirelless' => $wirelless]);
    }

    public function update(Request $request)
    {
        $params = $request->all();
        $isoDate = $params['date_of_inventory'];
        $formattedDate = Carbon::parse($isoDate)->setTimezone('Asia/Ujung_Pandang')->toDateString();


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
            'site' => 'MIFA'
        ];
        InvWirelless::firstWhere('id', $request->id)->update($data);
        return redirect()->route('wirellessMifa.page');
    }

    public function destroy($id)
    {
        $wirelless = InvWirelless::find($id);
        if (empty($wirelless)) {
            abort(404, 'Data not found');
        }
        // return response()->json(['ap' => $wirelless]);
        $wirelless->delete();
        return redirect()->back();
    }
}
