<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $dataUsers = User::all();
        return Inertia::render('ManagementUser/ManagementUserIct', ['users' => $dataUsers]);
    }
    public function edit($id)
    {
        $managementUser = User::find($id);

        if (!empty($managementUser->department)) {
            $department_select = array($managementUser->department);
        }else{
            $department_select = array('data tidak ada !');
        }
        $department = Department::pluck('department_name')->map(function ($name) {
            return ['name' => $name];
        })->toArray();
        // dd($department);
        return Inertia::render('ManagementUser/ManagementUserIctEdit', ['pengguna' => $managementUser, 'department' => $department, 'department_select' => $department_select]);
    }


    public function update(Request $request)
    {
        $params = $request->all();

        // dd($params);

        $data = [
            'nrp' => $params['nrp'],
            'name' => $params['username'],
            'department' => $params['department'],
            'position' => $params['position'],
            'role' => $params['role'],
        ];
        User::firstWhere('id', $request->id)->update($data);
        return redirect()->route('managementUserIct.page');
    }
}
