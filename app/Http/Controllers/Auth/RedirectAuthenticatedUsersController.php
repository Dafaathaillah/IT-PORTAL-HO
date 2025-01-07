<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectAuthenticatedUsersController extends Controller
{
    public function home(Request $request)
    {
        if (auth()->user()->role == 'ict_developer' && auth()->user()->site == 'BIB' || auth()->user()->role == 'ict_ho' && auth()->user()->site == 'HO' || auth()->user()->role == 'ict_bod' && auth()->user()->site == 'HO') {
            // return redirect()->route('aduan.page');
                return redirect('dashboard');
        } elseif (auth()->user()->role == 'soc_ho') {
            // return dd(auth()->user());
            return redirect()->route('aduan.page');
        } elseif (auth()->user()->role == 'ict_section') {
            return redirect('sectionDashboard');
        } elseif (auth()->user()->role == 'ict_group_leader') {
            return redirect('groupLeaderDashboard');
        } elseif (auth()->user()->role == 'ict_technician') {
            return redirect('technicianDashboard');
        } elseif (auth()->user()->role == 'ict_admin') {
            return redirect('adminDashboard');
        } elseif (auth()->user()->role == 'guest') {
            return redirect('asetDashboard');
        }else{
            return redirect('/login');
        }
    }
}
