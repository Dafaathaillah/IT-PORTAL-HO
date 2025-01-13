<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectAuthenticatedUsersController extends Controller
{
    public function home(Request $request)
    {
        if (auth()->user()->role == 'ict_developer' && auth()->user()->site == 'BIB' || auth()->user()->role == 'ict_ho' && auth()->user()->site == 'HO' || auth()->user()->role == 'ict_bod' && auth()->user()->site == 'HO') {
                return redirect('dashboard');
        } elseif (auth()->user()->role == 'ict_technician' && auth()->user()->site == 'BA') {
            return redirect()->route('dashboardBa.page');
        } elseif (auth()->user()->role == 'ict_technician' && auth()->user()->site == 'MIFA') {
            return redirect()->route('dashboardMifa.page');
        } elseif (auth()->user()->role == 'ict_technician' && auth()->user()->site == 'MHU') {
            return redirect()->route('dashboardMhu.page');
        } elseif (auth()->user()->role == 'ict_technician' && auth()->user()->site == 'AMI') {
            return redirect()->route('dashboardAmi.page');
        } elseif (auth()->user()->role == 'ict_technician' && auth()->user()->site == 'WARA') {
            return redirect()->route('dashboardWara.page');
        } elseif (auth()->user()->role == 'soc_ho') {
            return redirect()->route('aduan.page');
        }  elseif (auth()->user()->role == 'ict_section') {
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
