<?php

namespace App\Http\Controllers;

use App\Imports\ImportComputer;
use App\Models\Aduan;
use App\Models\Department;
use App\Models\InvComputer;
use App\Models\UserAll;
use Carbon\Carbon;
use Dedoc\Scramble\Scramble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use League\Csv\Reader;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Expr\Empty_;

class InvComputerBaController extends Controller
{
    public function index()
    {
        $dataInventory = InvComputer::with('pengguna')->where('site', 'BA')->get();

        $site = 'BA';

        $department = Department::orderBy('department_name')->where('is_site', 'Y')->pluck('department_name')->map(function ($name) {
            return ['name' => $name];
        })->toArray();

        $role = auth()->user()->role;

        return Inertia::render('Inventory/SiteBa/Komputer/Komputer', ['komputer' => $dataInventory, 'site' => $site, 'role' => $role, 'department' => $department]);
    }

    public function create()
    {
        abort(404, 'page not found');
    }

    public function store(Request $request)
    {

        $params = $request->all();

        if ($params['roterx'] == 'index') {
            // start generate code
            $currentDate = Carbon::tomorrow();
            $year = $currentDate->format('y');
            $month = $currentDate->month;
            $day = $currentDate->day;

            $dept = $params['dept'];

            $code_dept = Department::where('department_name', $dept)->first();

            $maxId = InvComputer::where('site', 'BA')->where('dept', $code_dept->code)->orderBy('max_id', 'desc')->first();
            // dd($maxId);

            if (is_null($maxId)) {
                $maxId = 0;
            } else {
                $noUrut = (int) substr($maxId->computer_code, 10, 3);
                $maxId = $noUrut;
            }

            $uniqueString = 'BA-PC-' . $code_dept->code . '-' . str_pad(($maxId % 10000) + 1, 3, '0', STR_PAD_LEFT);

            $request['inventory_number'] = $uniqueString;
            // end generate code

            $pengguna = UserAll::where('site', 'BA')->pluck('username')->map(function ($name) {
                return ['name' => $name];
            })->toArray();

            return Inertia::render('Inventory/SiteBa/Komputer/KomputerCreate', ['inventoryNumber' => $uniqueString, 'pengguna' => $pengguna, 'dept' => $code_dept->code]);
        } else {
            // dd($request->all());
            $maxId = InvComputer::max('max_id');
            if (is_null($maxId) || empty($maxId)) {
                $maxId = 1;
            } else {
                $maxId = $maxId + 1;
            }

            $documentation_image = $request->file('image');
            $destinationPath = 'images/';
            $path_documentation_image = $documentation_image->store('images', 'public');
            $new_path_documentation_image = $path_documentation_image;
            $documentation_image->move($destinationPath, $new_path_documentation_image);

            $aduan_get_data_user = UserAll::where('username', $params['user_alls_id'])->first();

            $dept = $params['dept'];

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
                'user_alls_id' => $aduan_get_data_user['id'],
                'site' => 'BA',
                'dept' => $dept
            ];

            InvComputer::create($data);
            return redirect()->route('komputerBa.page');
        }
    }

    public function uploadCsv(Request $request)
    {
        try {

            Excel::import(new ImportComputer, $request->file('file'));
            return redirect()->route('komputerBa.page');
        } catch (\Exception $ex) {
            Log::info($ex);
            return response()->json(['data' => 'Some error has occur.', 400]);
        }
    }

    public function edit($id)
    {
        $komputer = InvComputer::find($id);

        if (empty($komputer)) {
            abort(404, 'Data not found');
        }

        if (!empty($komputer->user_alls_id)) {
            $aduan_get_data_user = UserAll::where('id', $komputer->user_alls_id)->first()->username;

            $pengguna_selected = array($aduan_get_data_user);
        } else {
            $pengguna_selected = array('data tidak ada !');
        }

        $pengguna_all = UserAll::where('site', 'BA')->pluck('username')->map(function ($name) {
            return ['name' => $name];
        })->toArray();

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
        return Inertia::render('Inventory/SiteBa/Komputer/KomputerEdit', [
            'komputer' => $komputer,
            'model' => $model,
            'processor' => $processor,
            'hdd' => $hdd,
            'ssd' => $ssd,
            'ram' => $ram,
            'vga' => $vga,
            'warna_komputer' => $warna_komputer,
            'os_komputer' => $os_komputer,
            'pengguna_selected' => $pengguna_selected,
            'pengguna_all' => $pengguna_all
        ]);
    }

    public function detail($id)
    {
        $komputer = InvComputer::where('id', $id)->first();

        if (empty($komputer)) {
            abort(404, 'Data not found');
        }

        $aduan = Aduan::where('inventory_number', $komputer->computer_code)->get();
        return Inertia::render('Inventory/SiteBa/Komputer/KomputerDetail', [
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

            $aduan_get_data_user = UserAll::where('username', $request->user_alls_id)->first();

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
                'user_alls_id' => $aduan_get_data_user['id'],
                'site' => 'BA'
            ];
        } else {

            $aduan_get_data_user = UserAll::where('username', $request->user_alls_id)->first();

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
                'user_alls_id' => $aduan_get_data_user['id'],
                'site' => 'BA'
            ];
        }

        InvComputer::firstWhere('id', $request->id)->update($data);
        return redirect()->route('komputerBa.page');
    }
    public function destroy($id)
    {
        $komputer = InvComputer::find($id);
        if (empty($komputer)) {
            abort(404, 'Data not found');
        }
        // return response()->json(['ap' => $komputer]);
        $komputer->delete();
        return redirect()->back();
    }
}