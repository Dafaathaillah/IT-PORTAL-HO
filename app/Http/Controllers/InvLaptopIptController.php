<?php

namespace App\Http\Controllers;

use App\Imports\ImportLaptop;
use App\Models\Aduan;
use App\Models\Department;
use App\Models\InspeksiLaptop;
use App\Models\InvLaptop;
use App\Models\UnscheduleJob;
use App\Models\UserAll;
use Carbon\Carbon;
use Dedoc\Scramble\Scramble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use League\Csv\Reader;
use Maatwebsite\Excel\Facades\Excel;

class InvLaptopIptController extends Controller
{
    public function index()
    {
        $dataInventory = InvLaptop::with('pengguna')->where('site', 'IPT')->get();

        $site = 'IPT';

        $department = Department::orderBy('department_name')->where('is_site', 'Y')->pluck('department_name')->map(function ($name) {
            return ['name' => $name];
        })->toArray();

        $role = auth()->user()->role;

        return Inertia::render('Inventory/SiteIpt/Laptop/Laptop', ['laptop' => $dataInventory, 'site' => $site, 'role' => $role, 'department' => $department]);
    }

    public function create()
    {
        abort(404, 'Page not found');
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

            // dd($dept);

            $code_dept = Department::where('department_name', $dept)->first();

            $maxId = InvLaptop::where('site', 'IPT')->where('dept', $code_dept->code)->orderBy('max_id', 'desc')->first();
            // dd($maxId);

            if (is_null($maxId)) {
                $maxId = 0;
            } else {
                $parts = explode('-', $maxId->laptop_code);
                $lastPart = end($parts);
                $maxId = (int) $lastPart;
            }
            $uniqueString = 'IPT-NB-' . $code_dept->code . '-' . str_pad(($maxId % 10000) + 1, 3, '0', STR_PAD_LEFT);

            $request['inventory_number'] = $uniqueString;
            // end generate code

            $pengguna = UserAll::where('site', 'IPT')->pluck('username')->map(function ($name) {
                return ['name' => $name];
            })->toArray();

            return Inertia::render('Inventory/SiteIpt/Laptop/LaptopCreate', ['inventoryNumber' => $uniqueString, 'pengguna' => $pengguna, 'dept' => $code_dept->code]);
        } else {
            $maxId = InvLaptop::max('max_id');
            if (is_null($maxId)) {
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
                'laptop_name' => $params['laptop_name'],
                'laptop_code' => $params['laptop_code'],
                'number_asset_ho' => $params['number_asset_ho'],
                'assets_category' => $params['assets_category'],
                'spesifikasi' => $params['model'] . ', ' . $params['processor'] . ', ' . $params['hdd'] . ', ' . $params['ssd'] . ', ' . $params['ram'] . ', ' . $params['vga'] . ', ' . $params['warna_laptop'] . ', ' . $params['os_laptop'],
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
                'site' => 'IPT',
                'dept' => $dept
            ];

            InvLaptop::create($data);
            return redirect()->route('laptopIpt.page');
        }
    }

    public function uploadCsv(Request $request)
    {
        try {

            $import = new ImportLaptop();
            Excel::import($import, $request->file('file'));
    
            $duplicates = $import->getDuplicateRecords();
            // dd($duplicates);
            return Redirect::route('laptopIpt.page')->with([
                'message' => 'Import selesai!',
                'duplicates' => $duplicates, // Kirim daftar duplikat
            ]);
        } catch (\Exception $ex) {
            Log::info($ex);
            return response()->json(['data' => 'Some error has occur.', 400]);
        }
    }

    public function edit($id)
    {
        $laptop = InvLaptop::find($id);
        if (empty($laptop)) {
            abort(404, 'Data not found');
        }

        if (!empty($laptop->user_alls_id)) {
            $aduan_get_data_user = UserAll::where('id', $laptop->user_alls_id)->first()->username;

            $pengguna_selected = array($aduan_get_data_user);
        } else {
            $pengguna_selected = array('data tidak ada !');
        }

        $pengguna_all = UserAll::where('site', 'IPT')->pluck('username')->map(function ($name) {
            return ['name' => $name];
        })->toArray();

        // dd($aduan_get_data_user);

        $spesifikasi = explode(',', $laptop->spesifikasi);
        $model = trim($spesifikasi[0]);
        $processor = trim($spesifikasi[1]);
        $hdd = trim($spesifikasi[2]);
        $ssd = trim($spesifikasi[3]);
        $ram = trim($spesifikasi[4]);
        $vga = trim($spesifikasi[5]);
        $warna_laptop = trim($spesifikasi[6]);
        $os_laptop = trim($spesifikasi[7]);
        // return response()->json(['ap' => $laptop]);
        return Inertia::render('Inventory/SiteIpt/Laptop/LaptopEdit', [
            'laptop' => $laptop,
            'model' => $model,
            'processor' => $processor,
            'hdd' => $hdd,
            'ssd' => $ssd,
            'ram' => $ram,
            'vga' => $vga,
            'warna_laptop' => $warna_laptop,
            'os_laptop' => $os_laptop,
            'pengguna_selected' => $pengguna_selected,
            'pengguna_all' => $pengguna_all,
        ]);
    }

    public function detail($id)
    {
        $laptop = InvLaptop::with('pengguna')->where('id', $id)->first();
        if (empty($laptop)) {
            abort(404, 'Data not found');
        }
        $aduan = Aduan::where('inventory_number', $laptop->laptop_code)->get();
        $unschedule = UnscheduleJob::where('inventory_number', $laptop->laptop_code)->get();
        $inspeksi = InspeksiLaptop::with('inventory')
            ->where('inv_laptop_id', $id) // Only get posts from user_id 1
            ->get();
        // return response()->json($inspeksi);
        $merge = [
            'aduan' => $aduan,
            'inspeksi' => $inspeksi
        ];
        return Inertia::render('Inventory/SiteIpt/Laptop/LaptopDetail', [
            'laptop' => $laptop,
            'aduan' => $aduan,
            'inspeksi' => $inspeksi,
            'unschedule' => $unschedule,
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
                'laptop_name' => $request->laptop_name,
                'laptop_code' => $request->laptop_code,
                'number_asset_ho' => $request->number_asset_ho,
                'assets_category' => $request->assets_category,
                'spesifikasi' => $request->model . ', ' . $request->processor . ', ' . $request->hdd . ', ' . $request->ssd . ', ' . $request->ram . ', ' . $request->vga . ', ' . $request->warna_laptop . ', ' . $request->os_laptop,
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
                'site' => 'IPT'
            ];
        } else {

            $aduan_get_data_user = UserAll::where('username', $request->user_alls_id)->first();

            $data = [
                'max_id' => $request->max_id,
                'laptop_name' => $request->laptop_name,
                'laptop_code' => $request->laptop_code,
                'number_asset_ho' => $request->number_asset_ho,
                'assets_category' => $request->assets_category,
                'spesifikasi' => $request->model . ', ' . $request->processor . ', ' . $request->hdd . ', ' . $request->ssd . ', ' . $request->ram . ', ' . $request->vga . ', ' . $request->warna_laptop . ', ' . $request->os_laptop,
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
                'site' => 'IPT'
            ];
        }

        InvLaptop::firstWhere('id', $request->id)->update($data);
        return redirect()->route('laptopIpt.page');
    }
    public function destroy($id)
    {
        $laptop = InvLaptop::find($id);
        if (empty($laptop)) {
            abort(404, 'Data not found');
        }
        // return response()->json(['ap' => $laptop]);
        $laptop->delete();
        return redirect()->back();
    }
}
