<?php

namespace App\Http\Controllers;

use App\Imports\UserPenggunaImport;
use App\Models\Department;
use App\Models\UserAll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use League\Csv\Reader;
use Maatwebsite\Excel\Facades\Excel;

class UserAllBaController extends Controller
{
    public function index()
    {
        $dataPengguna = UserAll::where('site', 'BA')->get();
        return Inertia::render('ManagementUser/SiteBa/ManagementUser', ['pengguna' => $dataPengguna]);
    }

    public function create()
    {
        $department = Department::pluck('department_name')->map(function ($name) {
            return ['name' => $name];
        })->toArray();

        return Inertia::render('ManagementUser/SiteBa/ManagementUserCreate', ['department' => $department]);
    }

    public function store(Request $request)
    {
        $params = $request->all();
        // return dd($params);
            if (empty($request->id)) {
                $data = [
                    'nrp' => $params['nrp'],
                    'username' => $params['username'],
                    'department' => $params['department'],
                    'position' => $params['position'],
                    'email' => $params['email'],
                    'site' => 'BA',
                ];
                UserAll::create($data);
            } else {
                $data = [
                    'nrp' => $params['nrp'],
                    'username' => $params['username'],
                    'department' => $params['department'],
                    'position' => $params['position'],
                    'email' => $params['email'],
                    'site' => 'BA',
                ];
                UserAll::firstWhere('id', $request->id)->update($data);
            }
        return redirect()->route('penggunaBa.page');
    }

    public function uploadCsv(Request $request)
    {
        try {
            Excel::import(new UserPenggunaImport, $request->file('file'));
            return redirect()->route('penggunaBa.page');
        } catch (\Exception $ex) {
            Log::info($ex);
            return response()->json(['data' => 'Some error has occur.', 400]);
        }
    }

    public function edit($apId)
    {
        $managementUser = UserAll::find($apId);

        if (!empty($managementUser->department)) {
            $department_select = array($managementUser->department);
        }else{
            $department_select = array('data tidak ada !');
        }
        
        $department = Department::pluck('department_name')->map(function ($name) {
            return ['name' => $name];
        })->toArray();
        return Inertia::render('ManagementUser/SiteBa/ManagementUserEdit', ['pengguna' => $managementUser, 'department' => $department, 'department_select' => $department_select]);
    }

    public function destroy($id)
    {
        $managementUser = UserAll::find($id);
        // return response()->json(['ap' => $managementUser]);
        $managementUser->delete();
        return redirect()->back();
    }
}
