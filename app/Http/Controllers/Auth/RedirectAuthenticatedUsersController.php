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
        } elseif (auth()->user()->role == 'ict_technician' && auth()->user()->site == 'BIB' || 'ict_group_leader' && auth()->user()->site == 'BIB' || 'ict_admin' && auth()->user()->site == 'BIB') {
            return redirect()->route('dashboardBib.page');
        } elseif (auth()->user()->role == 'ict_technician' && auth()->user()->site == 'BA' || 'ict_group_leader' && auth()->user()->site == 'BA' || 'ict_admin' && auth()->user()->site == 'BA') {
            return redirect()->route('dashboardBa.page');
        } elseif (auth()->user()->role == 'ict_technician' && auth()->user()->site == 'MIFA' || 'ict_group_leader' && auth()->user()->site == 'MIFA' || 'ict_admin' && auth()->user()->site == 'MIFA') {
            return redirect()->route('dashboardMifa.page');
        } elseif (auth()->user()->role == 'ict_technician' && auth()->user()->site == 'MHU' || 'ict_group_leader' && auth()->user()->site == 'MHU' || 'ict_admin' && auth()->user()->site == 'MHU') {
            return redirect()->route('dashboardMhu.page');
        } elseif (auth()->user()->role == 'ict_technician' && auth()->user()->site == 'AMI' || 'ict_group_leader' && auth()->user()->site == 'AMI' || 'ict_admin' && auth()->user()->site == 'AMI') {
            return redirect()->route('dashboardAmi.page');
        } elseif (auth()->user()->role == 'ict_technician' && auth()->user()->site == 'WARA' || 'ict_group_leader' && auth()->user()->site == 'WARA' || 'ict_admin' && auth()->user()->site == 'WARA') {
            return redirect()->route('dashboardWara.page');
        } elseif (auth()->user()->role == 'ict_technician' && auth()->user()->site == 'PIK' || 'ict_group_leader' && auth()->user()->site == 'PIK' || 'ict_admin' && auth()->user()->site == 'PIK') {
            return redirect()->route('dashboardPik.page');
        } elseif (auth()->user()->role == 'ict_technician' && auth()->user()->site == 'IPT' || 'ict_group_leader' && auth()->user()->site == 'IPT' || 'ict_admin' && auth()->user()->site == 'IPT') {
            return redirect()->route('dashboardIpt.page');
        } elseif (auth()->user()->role == 'ict_technician' && auth()->user()->site == 'MLP' || 'ict_group_leader' && auth()->user()->site == 'MLP' || 'ict_admin' && auth()->user()->site == 'MLP') {
            return redirect()->route('dashboardMlp.page');
        } elseif (auth()->user()->role == 'ict_technician' && auth()->user()->site == 'MIP' || 'ict_group_leader' && auth()->user()->site == 'MIP' || 'ict_admin' && auth()->user()->site == 'MIP') {
            return redirect()->route('dashboardMip.page');
        } elseif (auth()->user()->role == 'ict_technician' && auth()->user()->site == 'VALE' || 'ict_group_leader' && auth()->user()->site == 'VALE' || 'ict_admin' && auth()->user()->site == 'VALE') {
            return redirect()->route('dashboardVale.page');
        } elseif (auth()->user()->role == 'ict_technician' && auth()->user()->site == 'SBS' || 'ict_group_leader' && auth()->user()->site == 'SBS' || 'ict_admin' && auth()->user()->site == 'SBS') {
            return redirect()->route('dashboardSbs.page');
        } elseif (auth()->user()->role == 'ict_technician' && auth()->user()->site == 'SKS' || 'ict_group_leader' && auth()->user()->site == 'SKS' || 'ict_admin' && auth()->user()->site == 'SKS') {
            return redirect()->route('dashboardSks.page');
        } elseif (auth()->user()->role == 'soc_ho') {
            return redirect()->route('aduan.page');
        } elseif (auth()->user()->role == 'guest') {
            return redirect('asetDashboard');
        } else{
            return redirect('/login');
        }
    }
}
