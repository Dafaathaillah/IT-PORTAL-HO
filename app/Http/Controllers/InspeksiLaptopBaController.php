<?php

namespace App\Http\Controllers;

use App\Models\InspeksiLaptop;
use App\Models\InvLaptop;
use App\Models\UserAll;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class InspeksiLaptopBaController extends Controller
{
    public function index()
    {
        $inspeksi_laptop = InspeksiLaptop::with('inventory.pengguna')->where('site', 'BA')->get();

        $site = auth()->user()->site;
        $role = auth()->user()->role;

        return Inertia::render(
            'Inspeksi/SiteBa/Laptop/InspeksiLaptopView',
            ['inspeksiLaptopx' => $inspeksi_laptop, 'site' => $site, 'role' => $role]
        );
    }

    public function process($id)
    {
        $dataInspeksix = InspeksiLaptop::find($id);
        if (empty($dataInspeksix)) {
            abort(404, 'Data not found');
        }

        $laptopx = InvLaptop::with('pengguna')->where('inv_laptops.id', $dataInspeksix->inv_laptop_id)->first();
        if (empty($laptopx)) {
            abort(404, 'Data not found');
        }

        // dd($laptopx);

        $penggunax = UserAll::where('site', 'BA')->pluck('username')->map(function ($name) {
            return ['name' => $name];
        })->toArray();

        return Inertia::render('Inspeksi/SiteBa/Laptop/InspeksiLaptopCreate', ['dataInspeksi' => $dataInspeksix, 'pengguna' => $penggunax, 'laptop' => $laptopx]);
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $currentDate = Carbon::now();
        $year = $currentDate->format('Y');

        // dd($request->file('image_temuan'));

        $maxId = InspeksiLaptop::where('site', "BA")->where('year', $year)->max('pica_number');

        if (is_null($maxId)) {
            $maxId = 0;
        }

        // $no_pica = 'PICA/CU/' . $year . '/' . str_pad(($maxId % 10000) + 1, 2, '0', STR_PAD_LEFT);
        $no_pica = $maxId + 1;

        $data = [
            'software_defrag' => $params['software_defrag'],
            'software_check_system_restore' => $params['software_check_system_restore'],
            'software_clean_cache_data' => $params['software_clean_cache_data'],
            'software_check_ilegal_software' => $params['software_check_ilegal_software'],
            'software_change_password' => $params['software_change_password'],
            'software_windows_license' => $params['software_windows_license'],
            'software_office_license' => $params['software_office_license'],
            'software_standaritation_software' => $params['software_standaritation_software'],
            'software_update_sinology' => $params['software_update_sinology'],
            'software_turn_off_windows_update' => $params['software_turn_off_windows_update'],
            'software_cheking_ssd_health' => $params['software_cheking_ssd_health'],
            'software_standaritation_device_name' => $params['software_standaritation_device_name'],
            'hardware_fan_cleaning' => $params['hardware_fan_cleaning'],
            'hardware_change_pasta' => $params['hardware_change_pasta'],
            'hardware_any_maintenance' => $params['hardware_any_maintenance'],
            'software_percentage_ssd_health' => $params['ssd_persen'],
            'condition' => $params['condition'],
            'inventory_status' => $params['status_inv'],
            'hardware_any_maintenance_explain' => $params['hardware_any_maintenance_explain'],
            'findings' => $params['temuan'],
            'findings_action' => $params['tindakan'],
            'due_date' => $params['due_date'],
            'findings_status' => $params['findings_status'],
            'remarks' => $params['remark'],
            'inspector' => $params['inspector'],
            'inspection_status' => $params['inspection_status'],
            'inspection_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'last_edited_by' => auth()->user()->nrp
        ];

        if ($params['temuan'] != null || $params['temuan'] != '') {
            $data['pica_number'] = $no_pica;
        }

        if ($request->file('image_temuan') != null) {
            $document_image = $request->file('image_temuan');
            $destinationPath = 'images/';
            $path_document_image = $document_image->store('images', 'public');
            $new_path_document_image = $path_document_image;
            $document_image->move($destinationPath, $new_path_document_image);

            $data['findings_image'] =  url($new_path_document_image);
        }

        if ($request->file('image_tindakan') != null) {
            $document_image = $request->file('image_tindakan');
            $destinationPath = 'images/';
            $path_document_image = $document_image->store('images', 'public');
            $new_path_document_image = $path_document_image;
            $document_image->move($destinationPath, $new_path_document_image);

            $data['action_image'] =  url($new_path_document_image);
        }

        if ($request->file('image_inspeksi') != null) {
            $document_image = $request->file('image_inspeksi');
            $destinationPath = 'images/';
            $path_document_image = $document_image->store('images', 'public');
            $new_path_document_image = $path_document_image;
            $document_image->move($destinationPath, $new_path_document_image);

            $data['inspection_image'] =  url($new_path_document_image);
        }


        InspeksiLaptop::firstWhere('id', $request->id)->update($data);
        return redirect()->route('inspeksiLaptop.page');
    }

    public function edit($id)
    {
        $dataInspeksix = InspeksiLaptop::find($id);
        if (empty($dataInspeksix)) {
            abort(404, 'Data not found');
        }

        $laptopx = InvLaptop::with('pengguna')->where('inv_laptops.id', $dataInspeksix->inv_laptop_id)->first();

        // dd($laptopx);

        if (!empty($dataInspeksix->inspector)) {

            $pengguna_selected = array($dataInspeksix->inspector);
        } else {
            $pengguna_selected = array('data tidak ada !');
        }

        $penggunax = UserAll::where('site', 'BA')->pluck('username')->map(function ($name) {
            return ['name' => $name];
        })->toArray();

        return Inertia::render('Inspeksi/SiteBa/Laptop/InspeksiLaptopEdit', ['dataInspeksi' => $dataInspeksix, 'pengguna' => $penggunax, 'laptop' => $laptopx, 'pengguna_selected' => $pengguna_selected]);
    }

    public function update(Request $request)
    {
        $params = $request->all();
        // dd($params);
        $currentDate = Carbon::now();
        $year = $currentDate->format('Y');

        // dd($request->file('image_temuan'));

        // $maxId = InspeksiLaptop::max('id');
        $maxId = InspeksiLaptop::where('site', 'BA')->where('year', $year)->max('pica_number');

        if (is_null($maxId)) {
            $maxId = 0;
        }

        // $no_pica = 'PICA/CU/' . $year . '/' . str_pad(($maxId % 10000) + 1, 2, '0', STR_PAD_LEFT);
        $no_pica = $maxId + 1;

        $data = [
            'software_defrag' => $params['software_defrag'],
            'software_check_system_restore' => $params['software_check_system_restore'],
            'software_clean_cache_data' => $params['software_clean_cache_data'],
            'software_check_ilegal_software' => $params['software_check_ilegal_software'],
            'software_change_password' => $params['software_change_password'],
            'software_windows_license' => $params['software_windows_license'],
            'software_office_license' => $params['software_office_license'],
            'software_standaritation_software' => $params['software_standaritation_software'],
            'software_update_sinology' => $params['software_update_sinology'],
            'software_turn_off_windows_update' => $params['software_turn_off_windows_update'],
            'software_cheking_ssd_health' => $params['software_cheking_ssd_health'],
            'software_standaritation_device_name' => $params['software_standaritation_device_name'],
            'hardware_fan_cleaning' => $params['hardware_fan_cleaning'],
            'hardware_change_pasta' => $params['hardware_change_pasta'],
            'hardware_any_maintenance' => $params['hardware_any_maintenance'],
            'software_percentage_ssd_health' => $params['ssd_persen'],
            'condition' => $params['condition'],
            'inventory_status' => $params['status_inv'],
            'hardware_any_maintenance_explain' => $params['hardware_any_maintenance_explain'],
            'findings' => $params['temuan'],
            'findings_action' => $params['tindakan'],
            'due_date' => $params['due_date'],
            'findings_status' => $params['findings_status'],
            'remarks' => $params['remark'],
            'inspector' => $params['inspector'],
            'inspection_status' => $params['inspection_status'],
            'inspection_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'last_edited_by' => auth()->user()->nrp
        ];

        if ($params['temuan'] != null || $params['temuan'] != '') {
            $dataInspeksix = InspeksiLaptop::find($request->id);
            if ($dataInspeksix->pica_number == null) {
                $data['pica_number'] = $no_pica;
            }
        }

        if ($request->file('image_temuan') != null) {
            $document_image = $request->file('image_temuan');
            $destinationPath = 'images/';
            $path_document_image = $document_image->store('images', 'public');
            $new_path_document_image = $path_document_image;
            $document_image->move($destinationPath, $new_path_document_image);

            $data['findings_image'] =  url($new_path_document_image);
        }

        if ($request->file('image_tindakan') != null) {
            $document_image = $request->file('image_tindakan');
            $destinationPath = 'images/';
            $path_document_image = $document_image->store('images', 'public');
            $new_path_document_image = $path_document_image;
            $document_image->move($destinationPath, $new_path_document_image);

            $data['action_image'] =  url($new_path_document_image);
        }

        if ($request->file('image_inspeksi') != null) {
            $document_image = $request->file('image_inspeksi');
            $destinationPath = 'images/';
            $path_document_image = $document_image->store('images', 'public');
            $new_path_document_image = $path_document_image;
            $document_image->move($destinationPath, $new_path_document_image);

            $data['inspection_image'] =  url($new_path_document_image);
        }


        InspeksiLaptop::firstWhere('id', $request->id)->update($data);
        return redirect()->route('inspeksiLaptop.page');
    }

    public function approval(Request $request)
    {
        $dataCheckStatusInspeksi = InspeksiLaptop::where('id', $request->id)->value('inspection_status');
        if ($dataCheckStatusInspeksi == 'sudah_inspeksi') {
            if ($request->approvalType == 'accept') {
                $dataApproval = [
                    'approved_by' => Auth::user()->name,
                    'status_approval' => 'approve',
                ];
            } else {
                $dataApproval = [
                    'approved_by' => Auth::user()->name,
                    'status_approval' => 'reject',
                ];
            }
            $data['udpateInspeksiApproval'] = InspeksiLaptop::where('id', $request->id)->update($dataApproval);
            return response()->json($data);
        } else {
            return response()->json(['message' => 'data ini belum di inspeksi']);
        }
    }

    public function approvalAll(Request $request)
    {
        $yearNow = Carbon::now()->format('Y');

        if ($request->approvalType == 'accept') {
            $dataApproval = [
                'approved_by' => Auth::user()->name,
                'status_approval' => 'approve',
            ];
        } else {
            $dataApproval = [
                'approved_by' => Auth::user()->name,
                'status_approval' => 'reject',
            ];
        }
        $data['udpateInspeksiApprovalAll'] = InspeksiLaptop::where('year', $yearNow)->where('inspection_status', 'sudah_inspeksi')->update($dataApproval);
        return response()->json(['message' => 'Approve all updated successfully']);
    }

    public function show($id)
    {
        $inspeksi_laptop = InspeksiLaptop::find($id);
        if (is_null($inspeksi_laptop)) {
            return response()->json(['message' => 'Panelbox Data not found'], 404);
        }
        return response()->json($inspeksi_laptop);
    }

    public function detail($id)
    {
        $inspeksi_laptop = InspeksiLaptop::with('inventory.pengguna')->where('inspeksi_laptops.id', $id)->first();

        if (empty($inspeksi_laptop)) {
            abort(404, 'Data not found');
        }

        // dd($inspeksi_laptop);

        return Inertia::render('Inspeksi/SiteBa/Laptop/InspeksiLaptopDetail', [
            'inspeksi' => $inspeksi_laptop
        ]);
    }

    public function destroy($id)
    {
        $inspeksi_laptop = InspeksiLaptop::find($id);
        if (empty($inspeksi_laptop)) {
            abort(404, 'Data not found');
        }
        if (is_null($inspeksi_laptop)) {
            return response()->json(['message' => 'Panelbox Data not found'], 404);
        }
        $inspeksi_laptop->delete();
        return response()->json(['message' => 'Data has deleted'], 204);
    }
}