<?php

namespace App\Http\Controllers;

use App\Models\InspeksiComputer;
use App\Models\InvComputer;
use App\Models\User;
use App\Models\UserAll;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class InspeksiComputerMhuController extends Controller
{
    public function index()
    {
        $inspeksi_computer = InspeksiComputer::with('computer.pengguna')->where('site', 'MHU')->get();

        $site = 'MHU';

        $role = auth()->user()->role;

        // return dd($inspeksi_computer);
        return Inertia::render(
            'Inspeksi/SiteMhu/Komputer/InspeksiKomputerIndex',
            ['computer' => $inspeksi_computer, 'site' => $site, 'role' => $role]
        );
    }

    public function doInspection($id)
    {
        $dataInspeksi = InspeksiComputer::with('computer.pengguna')->where('id', $id)->first();
        if (empty($dataInspeksi)) {
            abort(404, 'Data not found');
        }
        $crew = User::whereIn('role', ['ict_technician', 'ict_group_leader'])->where('site', 'MHU')->pluck('name')->map(function ($name) {
            return ['name' => $name];
        })->toArray();
        // return dd($dataInspeksi);
        return Inertia::render('Inspeksi/SiteMhu/Komputer/InspeksiKomputerForm', ['inspeksi' => $dataInspeksi, 'crew' => $crew]);
    }

    public function store(Request $request)
    {
        // start generate code
        $currentDate = Carbon::now();
        $year = $currentDate->format('Y');
        $month = $currentDate->month;
        $day = $currentDate->day;

        $maxId = InspeksiComputer::where('site', 'MHU')->where('year', $year)->max('pica_number');

        if (is_null($maxId)) {
            $maxId = 0;
        }

        $uniqueString = $maxId + 1;

        $dataInspeksix = InspeksiComputer::find($request->id);
        if ($dataInspeksix->pica_number != null) {
            $uniqueString = $dataInspeksix->pica_number;
        }

        // end generate code
        $destinationPath = 'images/';

        if (!empty($request->file('findings_image'))) {
            if (!empty($request->file('action_image'))) {
                //upload image

                $findings_image = $request->file('findings_image');
                $path_findings_image = $findings_image->store('images', 'public');
                $new_path_findings = $path_findings_image;
                $findings_image->move($destinationPath, $new_path_findings);

                $action_image = $request->file('action_image');
                $path_action_image = $action_image->store('images', 'public');
                $new_path_action = $path_action_image;
                $action_image->move($destinationPath, $new_path_action);

                $inspection_image = $request->file('inspection_image');
                $path_inspection_image = $inspection_image->store('images', 'public');
                $new_path_inspection = $path_inspection_image;
                $inspection_image->move($destinationPath, $new_path_inspection);

                $dataInspection = [
                    'inspection_status' => 'Y',
                    'inspector' => Auth::user()->name,
                    'physique_condition_cpu' => $request->cpu,
                    'physique_condition_internal_cpu' => $request->internalCpu,
                    'physique_condition_monitor' => $request->monitor,
                    'software_license' => $request->license,
                    'software_standaritation' => $request->softwareStandaritation,
                    'software_device_name_standaritation' => $request->deviceNameStandaritation,
                    'software_clear_cache' => $request->cache,
                    'software_system_restore' => $request->restore,
                    'software_windows_update' => $request->winUpdate,
                    'software_storage_health' => $request->storageHealth,
                    'defrag' => $request->defrag,
                    'hard_maintenance' => $request->hard_maintenance,
                    'change_user_pass' => $request->change_user_pass,
                    'autolock' => $request->autolock,
                    'enter_password' => $request->enter_password,
                    'crew' => $request->crew,
                    'findings' => $request->findings,
                    'findings_action' => $request->action,
                    'findings_status' => $request->status,
                    'findings_image' => url($new_path_findings),
                    'action_image' => url($new_path_action),
                    'remarks' => $request->remark,
                    'inspection_image' => url($new_path_inspection),
                    'due_date' => $request->due_date,
                    'conditions' => $request->kondisi,
                    'inventory_status' => $request->inventory_status,
                    'ip_address' => $request->ip_address,
                    'location' => $request->location,
                    'pica_number' => $uniqueString,
                    'created_date' => Carbon::now()->format('Y-m-d'),
                    'last_edited_by' => auth()->user()->nrp
                ];
                $data['udpateInspeksi'] = InspeksiComputer::firstWhere('id', $request->id)->update($dataInspection);
            } else {
                if (!empty($request->file('inspection_image'))) {
                    //upload image
                    $inspection_image = $request->file('inspection_image');
                    $path_inspection_image = $inspection_image->store('images', 'public');
                    $new_path_inspection = $path_inspection_image;
                    $inspection_image->move($destinationPath, $new_path_inspection);

                    $findings_image = $request->file('findings_image');
                    $path_findings_image = $findings_image->store('images', 'public');
                    $new_path_findings = $path_findings_image;
                    $findings_image->move($destinationPath, $new_path_findings);

                    $dataInspection = [
                        'inspection_status' => 'Y',
                        'inspector' => Auth::user()->name,
                        'physique_condition_cpu' => $request->cpu,
                        'physique_condition_internal_cpu' => $request->internalCpu,
                        'physique_condition_monitor' => $request->monitor,
                        'software_license' => $request->license,
                        'software_standaritation' => $request->softwareStandaritation,
                        'software_device_name_standaritation' => $request->deviceNameStandaritation,
                        'software_clear_cache' => $request->cache,
                        'software_system_restore' => $request->restore,
                        'software_windows_update' => $request->winUpdate,
                        'software_storage_health' => $request->storageHealth,
                        'defrag' => $request->defrag,
                        'hard_maintenance' => $request->hard_maintenance,
                        'change_user_pass' => $request->change_user_pass,
                        'autolock' => $request->autolock,
                        'enter_password' => $request->enter_password,
                        'crew' => $request->crew,
                        'findings' => $request->findings,
                        'findings_action' => $request->action,
                        'findings_status' => $request->status,
                        'findings_image' => url($new_path_findings),
                        'remarks' => $request->remark,
                        'inspection_image' => url($new_path_inspection),
                        'due_date' => $request->due_date,
                        'conditions' => $request->kondisi,
                        'inventory_status' => $request->inventory_status,
                        'ip_address' => $request->ip_address,
                        'location' => $request->location,
                        'pica_number' => $uniqueString,
                        'created_date' => Carbon::now()->format('Y-m-d'),
                        'last_edited_by' => auth()->user()->nrp
                    ];
                } else {
                    //upload image
                    $findings_image = $request->file('findings_image');
                    $path_findings_image = $findings_image->store('images', 'public');
                    $new_path_findings = $path_findings_image;
                    $findings_image->move($destinationPath, $new_path_findings);

                    $dataInspection = [
                        'inspection_status' => 'Y',
                        'inspector' => Auth::user()->name,
                        'physique_condition_cpu' => $request->cpu,
                        'physique_condition_internal_cpu' => $request->internalCpu,
                        'physique_condition_monitor' => $request->monitor,
                        'software_license' => $request->license,
                        'software_standaritation' => $request->softwareStandaritation,
                        'software_device_name_standaritation' => $request->deviceNameStandaritation,
                        'software_clear_cache' => $request->cache,
                        'software_system_restore' => $request->restore,
                        'software_windows_update' => $request->winUpdate,
                        'software_storage_health' => $request->storageHealth,
                        'defrag' => $request->defrag,
                        'hard_maintenance' => $request->hard_maintenance,
                        'change_user_pass' => $request->change_user_pass,
                        'autolock' => $request->autolock,
                        'enter_password' => $request->enter_password,
                        'crew' => $request->crew,
                        'findings' => $request->findings,
                        'findings_action' => $request->action,
                        'findings_status' => $request->status,
                        'findings_image' => url($new_path_findings),
                        'remarks' => $request->remark,
                        'due_date' => $request->due_date,
                        'conditions' => $request->kondisi,
                        'inventory_status' => $request->inventory_status,
                        'ip_address' => $request->ip_address,
                        'location' => $request->location,
                        'pica_number' => $uniqueString,
                        'created_date' => Carbon::now()->format('Y-m-d'),
                        'last_edited_by' => auth()->user()->nrp
                    ];
                }
            }
            $data['udpateInspeksi'] = InspeksiComputer::firstWhere('id', $request->id)->update($dataInspection);
        } else {
            if (!empty($request->file('action_image'))) {
                if (!empty($request->file('inspection_image'))) {
                    $inspection_image = $request->file('inspection_image');
                    $path_inspection_image = $inspection_image->store('images', 'public');
                    $new_path_inspection = $path_inspection_image;
                    $inspection_image->move($destinationPath, $new_path_inspection);

                    //upload image
                    $action_image = $request->file('action_image');
                    $path_action_image = $action_image->store('images', 'public');
                    $new_path_action = $path_action_image;
                    $action_image->move($destinationPath, $new_path_action);

                    $dataInspection = [
                        'inspection_status' => 'Y',
                        'inspector' => Auth::user()->name,
                        'physique_condition_cpu' => $request->cpu,
                        'physique_condition_internal_cpu' => $request->internalCpu,
                        'physique_condition_monitor' => $request->monitor,
                        'software_license' => $request->license,
                        'software_standaritation' => $request->softwareStandaritation,
                        'software_device_name_standaritation' => $request->deviceNameStandaritation,
                        'software_clear_cache' => $request->cache,
                        'software_system_restore' => $request->restore,
                        'software_windows_update' => $request->winUpdate,
                        'software_storage_health' => $request->storageHealth,
                        'defrag' => $request->defrag,
                        'hard_maintenance' => $request->hard_maintenance,
                        'change_user_pass' => $request->change_user_pass,
                        'autolock' => $request->autolock,
                        'enter_password' => $request->enter_password,
                        'crew' => $request->crew,
                        'findings' => $request->findings,
                        'findings_action' => $request->action,
                        'findings_status' => $request->status,
                        'action_image' => url($new_path_action),
                        'remarks' => $request->remark,
                        'inspection_image' => url($new_path_inspection),
                        'due_date' => $request->due_date,
                        'conditions' => $request->kondisi,
                        'inventory_status' => $request->inventory_status,
                        'ip_address' => $request->ip_address,
                        'location' => $request->location,
                        'pica_number' => $uniqueString,
                        'created_date' => Carbon::now()->format('Y-m-d'),
                        'last_edited_by' => auth()->user()->nrp
                    ];
                    $data['udpateInspeksi'] = InspeksiComputer::firstWhere('id', $request->id)->update($dataInspection);
                } else {
                    //upload image
                    $action_image = $request->file('action_image');
                    $path_action_image = $action_image->store('images', 'public');
                    $new_path_action = $path_action_image;
                    $action_image->move($destinationPath, $new_path_action);

                    $dataInspection = [
                        'inspection_status' => 'Y',
                        'inspector' => Auth::user()->name,
                        'physique_condition_cpu' => $request->cpu,
                        'physique_condition_internal_cpu' => $request->internalCpu,
                        'physique_condition_monitor' => $request->monitor,
                        'software_license' => $request->license,
                        'software_standaritation' => $request->softwareStandaritation,
                        'software_device_name_standaritation' => $request->deviceNameStandaritation,
                        'software_clear_cache' => $request->cache,
                        'software_system_restore' => $request->restore,
                        'software_windows_update' => $request->winUpdate,
                        'software_storage_health' => $request->storageHealth,
                        'defrag' => $request->defrag,
                        'hard_maintenance' => $request->hard_maintenance,
                        'change_user_pass' => $request->change_user_pass,
                        'autolock' => $request->autolock,
                        'enter_password' => $request->enter_password,
                        'crew' => $request->crew,
                        'findings' => $request->findings,
                        'findings_action' => $request->action,
                        'findings_status' => $request->status,
                        'action_image' => url($new_path_action),
                        'remarks' => $request->remark,
                        'due_date' => $request->due_date,
                        'conditions' => $request->kondisi,
                        'inventory_status' => $request->inventory_status,
                        'ip_address' => $request->ip_address,
                        'location' => $request->location,
                        'pica_number' => $uniqueString,
                        'created_date' => Carbon::now()->format('Y-m-d'),
                        'last_edited_by' => auth()->user()->nrp
                    ];
                    $data['udpateInspeksi'] = InspeksiComputer::firstWhere('id', $request->id)->update($dataInspection);
                }
            } else {
                // return dd($request->file('inspection_image'));
                if (!empty($request->file('inspection_image'))) {
                    # code...
                    $inspection_image = $request->file('inspection_image');
                    $path_inspection_image = $inspection_image->store('images', 'public');
                    $new_path_inspection = $path_inspection_image;
                    $inspection_image->move($destinationPath, $new_path_inspection);

                    $dataInspection = [
                        'inspection_status' => 'Y',
                        'inspector' => Auth::user()->name,
                        'physique_condition_cpu' => $request->cpu,
                        'physique_condition_internal_cpu' => $request->internalCpu,
                        'physique_condition_monitor' => $request->monitor,
                        'software_license' => $request->license,
                        'software_standaritation' => $request->softwareStandaritation,
                        'software_device_name_standaritation' => $request->deviceNameStandaritation,
                        'software_clear_cache' => $request->cache,
                        'software_system_restore' => $request->restore,
                        'software_windows_update' => $request->winUpdate,
                        'software_storage_health' => $request->storageHealth,
                        'defrag' => $request->defrag,
                        'hard_maintenance' => $request->hard_maintenance,
                        'change_user_pass' => $request->change_user_pass,
                        'autolock' => $request->autolock,
                        'enter_password' => $request->enter_password,
                        'crew' => $request->crew,
                        'remarks' => $request->remark,
                        'inspection_image' => url($new_path_inspection),
                        'due_date' => $request->due_date,
                        'conditions' => $request->kondisi,
                        'inventory_status' => $request->inventory_status,
                        'ip_address' => $request->ip_address,
                        'location' => $request->location,
                        'pica_number' => $uniqueString,
                        'created_date' => Carbon::now()->format('Y-m-d'),
                        'last_edited_by' => auth()->user()->nrp
                    ];
                } else {
                    $dataInspection = [
                        'inspection_status' => 'Y',
                        'inspector' => Auth::user()->name,
                        'physique_condition_cpu' => $request->cpu,
                        'physique_condition_internal_cpu' => $request->internalCpu,
                        'physique_condition_monitor' => $request->monitor,
                        'software_license' => $request->license,
                        'software_standaritation' => $request->softwareStandaritation,
                        'software_device_name_standaritation' => $request->deviceNameStandaritation,
                        'software_clear_cache' => $request->cache,
                        'software_system_restore' => $request->restore,
                        'software_windows_update' => $request->winUpdate,
                        'software_storage_health' => $request->storageHealth,
                        'defrag' => $request->defrag,
                        'hard_maintenance' => $request->hard_maintenance,
                        'change_user_pass' => $request->change_user_pass,
                        'autolock' => $request->autolock,
                        'enter_password' => $request->enter_password,
                        'crew' => $request->crew,
                        'findings' => $request->findings,
                        'findings_action' => $request->action,
                        'findings_status' => $request->status,
                        'remarks' => $request->remark,
                        'due_date' => $request->due_date,
                        'conditions' => $request->kondisi,
                        'inventory_status' => $request->inventory_status,
                        'ip_address' => $request->ip_address,
                        'location' => $request->location,
                        'pica_number' => $uniqueString,
                        'created_date' => Carbon::now()->format('Y-m-d'),
                        'last_edited_by' => auth()->user()->nrp
                    ];
                }
                $data['udpateInspeksi'] = InspeksiComputer::firstWhere('id', $request->id)->update($dataInspection);
            }
        }

        if (!empty($request->inventory_status)) {
            $getDataInspeksi = InspeksiComputer::where('id', $request->id)->first();
            $getDataInventory = InvComputer::where('id', $getDataInspeksi->inv_computer_id)->first();
            $dataInventory = [
                'status' => $request->inventory_status,
            ];
            $data['udpateInspeksi'] = InvComputer::firstWhere('id', $getDataInventory->id)->update($dataInventory);
        }
        return redirect()->route('inspeksiKomputerMhu.page');
    }

    public function edit($id)
    {
        $dataInspeksi = InspeksiComputer::with('computer.pengguna')->where('id', $id)->first();
        if (empty($dataInspeksi)) {
            abort(404, 'Data not found');
        }
        $crew_select = explode(', ', $dataInspeksi->crew);

        $crew = User::whereIn('role', ['ict_technician', 'ict_group_leader'])->where('site', 'MHU')->pluck('name')->map(function ($name) {
            return ['name' => $name];
        })->toArray();
        return Inertia::render('Inspeksi/SiteMhu/Komputer/InspeksiKomputerFormEdit', ['inspeksi' => $dataInspeksi, 'crew' => $crew, 'crew_select' => $crew_select]);
    }



    public function approval(Request $request)
    {
        $dataCheckStatusInspeksi = InspeksiComputer::where('id', $request->id)->value('inspection_status');
        if ($dataCheckStatusInspeksi == 'Y') {
            if ($request->approvalType == 'accept') {
                $dataApproveal = [
                    'approved_by' => Auth::user()->name,
                    'status_approval' => 'approve',
                ];
            } else {
                $dataApproveal = [
                    'approved_by' => Auth::user()->name,
                    'status_approval' => 'reject',
                ];
            }
            $data['udpateInspeksiApproval'] = InspeksiComputer::firstWhere('id', $request->id)->update($dataApproveal);
            return response()->json($data);
        } else {
            return response()->json(['message' => 'data ini belum di inspeksi']);
        }
    }

    public function approvalAll(Request $request)
    {
        // Mendapatkan tanggal awal dan akhir kuartal saat ini
        $data['now'] = Carbon::now();
        $data['quarterStart'] = $data['now']->copy()->firstOfQuarter()->format('Y-m-d');
        $data['quarterEnd'] = $data['now']->copy()->lastOfQuarter()->format(('Y-m-d'));

        // Mengambil data yang berada dalam rentang kuartal saat ini
        if ($request->approvalType == 'accept') {
            $dataApproveal = [
                'approved_by' => Auth::user()->name,
                'status_approval' => 'approve',
            ];
        } else {
            $dataApproveal = [
                'approved_by' => Auth::user()->name,
                'status_approval' => 'reject',
            ];
        }
        $data['inventories'] = InspeksiComputer::where('inspection_status', 'Y')->whereBetween('created_date', [$data['quarterStart'], $data['quarterEnd']])->update($dataApproveal);
        return response()->json(['message' => 'Approve all updated successfully']);
    }

    public function show($id)
    {
        $inspeksi_computer = InspeksiComputer::find($id);
        if (is_null($inspeksi_computer)) {
            return response()->json(['message' => 'Panelbox Data not found'], 404);
        }
        return response()->json($inspeksi_computer);
    }

    public function detail($id)
    {
        $inspeksi_komputer = InspeksiComputer::with('computer.pengguna')->where('inspeksi_computers.id', $id)->first();
        if (empty($inspeksi_komputer)) {
            abort(404, 'Data not found');
        }

        return Inertia::render('Inspeksi/SiteMhu/Komputer/InspeksiKomputerDetail', [
            'inspeksi' => $inspeksi_komputer
        ]);
    }

    public function destroy($id)
    {
        $inspeksi_computer = InspeksiComputer::find($id);
        if (empty($inspeksi_computer)) {
            abort(404, 'Data not found');
        }
        if (is_null($inspeksi_computer)) {
            return response()->json(['message' => 'Panelbox Data not found'], 404);
        }
        $inspeksi_computer->delete();
        return response()->json(['message' => 'Data has deleted'], 204);
    }
}
