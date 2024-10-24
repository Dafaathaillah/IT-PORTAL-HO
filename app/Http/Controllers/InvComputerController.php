<?php

namespace App\Http\Controllers;

use App\Imports\ImportComputer;
use App\Models\Aduan;
use App\Models\InvComputer;
use Carbon\Carbon;
use Dedoc\Scramble\Scramble;
use Illuminate\Http\Request;
use Inertia\Inertia;
use League\Csv\Reader;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Expr\Empty_;

class InvComputerController extends Controller
{
    public function index()
    {
        $dataInventory = InvComputer::all();
        return Inertia::render('Inventory/Komputer/Komputer', ['komputer' => $dataInventory]);
    }

    public function create()
    {
        // start generate code
        $currentDate = Carbon::tomorrow();
        $year = $currentDate->format('y');
        $month = $currentDate->month;
        $day = $currentDate->day;

        $maxId = InvComputer::max('max_id');

        if (is_null($maxId)) {
            $maxId = 0;
        }

        $uniqueString = 'PPAHOCU' . str_pad(($maxId % 10000) + 1, 3, '0', STR_PAD_LEFT);
        $request['inventory_number'] = $uniqueString;
        // end generate code

        return Inertia::render('Inventory/Komputer/KomputerCreate', ['inventoryNumber' => $uniqueString]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $maxId = InvComputer::max('max_id');
        if (is_null($maxId) || empty($maxId)) {
            $maxId = 1;
        } else {
            $maxId = $maxId + 1;
        }

        $params = $request->all();

        $documentation_image = $request->file('image');
        $destinationPath = 'images/';
        $path_documentation_image = $documentation_image->store('images', 'public');
        $new_path_documentation_image = $path_documentation_image;
        $documentation_image->move($destinationPath, $new_path_documentation_image);

        $data = [
            'max_id' => $maxId,
            'computer_name' => $params['computer_name'],
            'computer_code' => $params['computer_code'],
            'number_asset_ho' => $params['number_asset_ho'],
            'assets_category' => $params['assets_category'],
            'spesifikasi' => $params['model'] . ', ' . $params['processor'] . ', ' . $params['hdd'] . ', ' . $params['ssd'] . ', ' . $params['ram'] . ', ' . $params['vga'] . ', ' . $params['warna_komputer'] . ', ' . $params['os_komputer'],
            'serial_number' => $params['serial_number'],
            'aplikasi' => $params['aplikasi'],
            'license' => $params['license'],
            'ip_address' => $params['ip_address'],
            'date_of_inventory' => $params['date_of_inventory'],
            'date_of_deploy' => $params['date_of_deploy'],
            'location' => $params['location'],
            'status' => $params['status'],
            'condition' => $params['condition'],
            'note' => $params['note'],
            'link_documentation_asset_image' => url($new_path_documentation_image),
            'user_alls_id' => $params['user_alls_id'],
        ];

        InvComputer::create($data);
        return redirect()->route('komputer.page');
    }

    public function uploadCsv(Request $request)
    {
        try {

            Excel::import(new ImportComputer, $request->file('file'));
            return redirect()->route('komputer.page');
        } catch (\Exception $ex) {
            Log::info($ex);
            return response()->json(['data' => 'Some error has occur.', 400]);
        }
    }

    public function edit($id)
    {
        $komputer = InvComputer::find($id);
        $spesifikasi = explode(',', $komputer->spesifikasi);
        $model = trim($spesifikasi[0]);
        $processor = trim($spesifikasi[1]);
        $hdd = trim($spesifikasi[2]);
        $ssd = trim($spesifikasi[3]);
        $ram = trim($spesifikasi[4]);
        $vga = trim($spesifikasi[5]);
        $warna_komputer = trim($spesifikasi[6]);
        $os_komputer = trim($spesifikasi[7]);
        // return response()->json(['ap' => $komputer]);
        return Inertia::render('Inventory/Komputer/KomputerEdit', [
            'komputer' => $komputer,
            'model' => $model,
            'processor' => $processor,
            'hdd' => $hdd,
            'ssd' => $ssd,
            'ram' => $ram,
            'vga' => $vga,
            'warna_komputer' => $warna_komputer,
            'os_komputer' => $os_komputer,
        ]);
    }

    public function detail($id)
    {
        $komputer = InvComputer::where('computer_code', $id)->first();
        $aduan = Aduan::where('inventory_number', $id)->get();
        return Inertia::render('Inventory/Komputer/KomputerDetail', [
            'komputer' => $komputer,
            'aduan' => $aduan,
        ]);
    }

    public function update(Request $request)
    {
        if (!empty($request->hasFile('image'))) {
            $documentation_image = $request->file('image');
            $destinationPath = 'images/';
            $path_documentation_image = $documentation_image->store('images', 'public');
            $new_path_documentation_image = $path_documentation_image;
            $documentation_image->move($destinationPath, $new_path_documentation_image);
            $data = [
                'max_id' => $request->max_id,
                'computer_name' => $request->computer_name,
                'computer_code' => $request->computer_code,
                'number_asset_ho' => $request->number_asset_ho,
                'assets_category' => $request->assets_category,
                'spesifikasi' => $request->model . ', ' . $request->processor . ', ' . $request->hdd . ', ' . $request->ssd . ', ' . $request->ram . ', ' . $request->vga . ', ' . $request->warna_komputer . ', ' . $request->os_komputer,
                'serial_number' => $request->serial_number,
                'aplikasi' => $request->aplikasi,
                'license' => $request->license,
                'ip_address' => $request->ip_address,
                'date_of_inventory' => $request->date_of_inventory,
                'date_of_deploy' => $request->date_of_deploy,
                'location' => $request->location,
                'status' => $request->status,
                'condition' => $request->condition,
                'note' => $request->note,
                'link_documentation_asset_image' => url($new_path_documentation_image),
                'user_alls_id' => null,
            ];
        } else {
            $data = [
                'max_id' => $request->max_id,
                'computer_name' => $request->computer_name,
                'computer_code' => $request->computer_code,
                'number_asset_ho' => $request->number_asset_ho,
                'assets_category' => $request->assets_category,
                'spesifikasi' => $request->model . ', ' . $request->processor . ', ' . $request->hdd . ', ' . $request->ssd . ', ' . $request->ram . ', ' . $request->vga . ', ' . $request->warna_komputer . ', ' . $request->os_komputer,
                'serial_number' => $request->serial_number,
                'aplikasi' => $request->aplikasi,
                'license' => $request->license,
                'ip_address' => $request->ip_address,
                'date_of_inventory' => $request->date_of_inventory,
                'date_of_deploy' => $request->date_of_deploy,
                'location' => $request->location,
                'status' => $request->status,
                'condition' => $request->condition,
                'note' => $request->note,
                'user_alls_id' => null,
            ];
    }

        InvComputer::firstWhere('id', $request->id)->update($data);
        return redirect()->route('komputer.page');
    }
    public function destroy($id)
    {
        $komputer = InvComputer::find($id);
        // return response()->json(['ap' => $komputer]);
        $komputer->delete();
        return redirect()->back();
    }
}
