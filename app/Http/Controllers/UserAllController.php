<?php

namespace App\Http\Controllers;

use App\Models\UserAll;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserAllController extends Controller
{
    public function index()
    {
        $dataPengguna = UserAll::all();
        return Inertia::render('ManagementUser/ManagementUser', ['pengguna' => $dataPengguna]);
    }

    public function create()
    {
        return Inertia::render('ManagementUser/ManagementUserCreate');
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
                ];
                // DB::table('inv_aps')->insert($data);
                UserAll::create($data);
            } else {
                $data = [
                    'nrp' => $params['nrp'],
                    'username' => $params['username'],
                    'department' => $params['department'],
                    'position' => $params['position'],
                    'email' => $params['email'],
                ];
                // DB::table('inv_aps')->insert($data);
                UserAll::firstWhere('id', $request->id)->update($data);
            }
        return redirect()->route('pengguna.page');
    }

    public function edit($apId)
    {
        $managementUser = UserAll::find($apId);
        // return response()->json(['ap' => $managementUser]);
        return Inertia::render('ManagementUser/ManagementUserEdit', ['pengguna' => $managementUser]);
    }

    // public function show($id)
    // {
    //     $invap = UserAll::find($id);
    //     if (is_null($invap)) {
    //         return response()->json(['message' => 'AP Device not found'], 404);
    //     }
    //     return response()->json($invap);
    // }

    public function destroy($id)
    {
        $managementUser = UserAll::find($id);
        // return response()->json(['ap' => $managementUser]);
        $managementUser->delete();
        return redirect()->back();
    }
}
