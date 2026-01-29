<?php

namespace App\Http\Controllers;

use App\Models\InvMobileTower;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InvMobileTowerDmpController extends Controller
{
    public function index()
    {
        $dataInventory = InvMobileTower::orderBy('inventory_number', 'desc')->where('site', 'DMP')->get();
        // dd($dataInventory);
        $site = 'DMP';
        $role = auth()->user()->role;

        return Inertia::render('Inventory/MobileTower/dmp/MobileTower', ['mobileTower' => $dataInventory, 'site' => $site, 'role' => $role]);
    }
    public function create()
    {
        $site = 'DMP';
        $lastTower = InvMobileTower::orderBy('inventory_number', 'desc')->where('site', $site)->first();

        // dd($lastTower);

        if ($lastTower) {

            $lastNumber = (int) substr($lastTower->inventory_number, -2);
            $nextNumber = str_pad($lastNumber + 1, 2, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '01';
        }

        return Inertia::render('Inventory/MobileTower/dmp/MobileTowerCreate', ['inventoryNumber' => $site . '-MT-' . $nextNumber]);
    }

    public function store(Request $request)
    {

        $params = $request->all();
        $data = [
            'inventory_number' => $params['inventory_number'],
            'mt_code' => $params['kode_mt'],
            'type_mt' => $params['tipe_mt'],
            'location' => $params['lokasi_mt'],
            'detail_location' => $params['detail_lokasi'],
            'padlock_code' => $params['kode_gembok'],
            'gps' => $params['gps'],
            'led_lamp' => $params['lampu_led'],
            'condition' => $params['kondisi'],
            'status' => $params['status'],
            'note' => $params['note'],
            'site' => 'DMP'
        ];
        // DB::table('inv_aps')->insert($data);
        InvMobileTower::create($data);
        return redirect()->route('mobileTowerDmp.page');
    }

    public function edit($id)
    {
        $mtData = InvMobileTower::find($id);
        if (empty($mtData)) {
            abort(404, 'Data not found');
        }

        return Inertia::render('Inventory/MobileTower/dmp/MobileTowerEdit', [
            'mtData' => $mtData,
            'inventory_number' => session('inventory_number') ?? null,
        ]);
    }

    public function update(Request $request)
    {
        $params = $request->all();

        $data = [
            'inventory_number' => $params['inventory_number'],
            'mt_code' => $params['kode_mt'],
            'type_mt' => $params['tipe_mt'],
            'location' => $params['lokasi_mt'],
            'detail_location' => $params['detail_lokasi'],
            'padlock_code' => $params['kode_gembok'],
            'gps' => $params['gps'],
            'led_lamp' => $params['lampu_led'],
            'condition' => $params['kondisi'],
            'status' => $params['status'],
            'note' => $params['note'],
            'site' => 'DMP'
        ];
        // DB::table('inv_aps')->insert($data);
        InvMobileTower::firstWhere('id', $request->id)->update($data);
        return redirect()->route('mobileTowerDmp.page');
    }

    public function detail($id)
    {
        $mobileTower = InvMobileTower::where('id', $id)->first();
        if (empty($mobileTower)) {
            abort(404, 'Data not found');
        }

        return Inertia::render('Inventory/MobileTower/dmp/MobileTowerDetail', [
            'mobileTowers' => $mobileTower,
        ]);
    }

    public function destroy($id)
    {
        $mobileTower = InvMobileTower::find($id);
        if (empty($mobileTower)) {
            abort(404, 'Data not found');
        }

        // return response()->json(['ap' => $mobileTower]);
        $mobileTower->delete();
        return redirect()->back();
    }
}
