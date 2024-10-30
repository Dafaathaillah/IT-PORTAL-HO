<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DepartmentController extends Controller
{
    public function index()
    {
        $dataDepartment = Department::all();
        return Inertia::render('Department/Department', ['department' => $dataDepartment]);
    }

    public function create()
    {
        return Inertia::render('Department/DepartmentCreate');
    }

    public function store(Request $request)
    {
        $params = $request->all();
        // return dd($params);
            if (empty($request->id)) {
                $data = [
                    'department_name' => $params['department_name'],
                ];
                // DB::table('inv_aps')->insert($data);
                Department::create($data);
            } else {
                $data = [
                    'department_name' => $params['department_name'],
                ];
                // DB::table('inv_aps')->insert($data);
                Department::firstWhere('id', $request->id)->update($data);
            }
        return redirect()->route('department.page');
    }

    public function edit($id)
    {
        $dataDepartment = Department::find($id);
        // return response()->json(['ap' => $dataDepartment]);
        return Inertia::render('Department/DepartmentEdit', ['department' => $dataDepartment]);
    }

    public function destroy($id)
    {
        $dataDepartment = Department::find($id);
        // return response()->json(['ap' => $dataDepartment]);
        $dataDepartment->delete();
        return redirect()->back();
    }
}
