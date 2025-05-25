<?php

namespace App\Http\Controllers;

use App\Models\InspeksiComputer;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ExportInspeksiComputerController extends Controller
{
    public function exportPdfAll(Request $request)
    {   
        // dd($request->site);
        $site = $request->site;
        if ($request->site != 'ADW') {
            if ($request->triwulan) {
                $thisTriwulan = $request->triwulan;    
            }else{
                $thisTriwulan = Carbon::now()->quarter;
            }
        }else{
            if ($request->month) {
                $thisMonth = $request->month;    
            }else{
                $thisMonth = Carbon::now()->month;
            }
        }

        $user = Auth::user();
        $thisYearEncrypt = $request->query('year') ?? Carbon::now()->year;
        // dd('OKE');
        try {
            $thisYear = Crypt::decryptString($thisYearEncrypt); // Dekripsi year dari URL
        } catch (\Exception $e) {
            abort(403, "Akses tidak valid");
        }

        if ($thisYear > 2500) {
            return back()->with('error', 'Tahun tidak terdeteksi.');
        }

        if ($request->site != 'ADW') {

            $inspeksiComputerAll = InspeksiComputer::with('computer.pengguna')
            ->where('site', $request->site)
            ->where('triwulan', $thisTriwulan)
            ->where('year', $thisYear)
            ->get();
    
            $unitScrap = InspeksiComputer::with('computer.pengguna')
            ->where('site', $request->site)
            ->where('triwulan', $thisTriwulan)
            ->where('year', $thisYear)
            ->where('inventory_status', 'SCRAP')
            ->count();
    
            $unitUtilize = InspeksiComputer::with('computer.pengguna')
            ->where('site', $request->site)
            ->where('triwulan', $thisTriwulan)
            ->where('year', $thisYear)
            ->where('inventory_status', '!=' ,'SCRAP')
            ->count();

            $pdf = Pdf::loadView('itportal.rekapAllInspeksi.inspeksiComputerAll', compact('inspeksiComputerAll', 'thisYear', 'thisTriwulan', 'unitScrap', 'unitUtilize', 'site'))
            ->setPaper('A4', 'landscape');
        return $pdf->stream('inspection-computer-report-periode-' . 'triwulan-' .$thisTriwulan . '-' . $thisYear . '.pdf');
        }else{
            $inspeksiComputerAll = InspeksiComputer::with('computer.pengguna')
            ->where('site', $request->site)
            ->where('month', $thisMonth)
            ->where('year', $thisYear)
            ->get();
    
            $unitScrap = InspeksiComputer::with('computer.pengguna')
            ->where('site', $request->site)
            ->where('month', $thisMonth)
            ->where('year', $thisYear)
            ->where('inventory_status', 'SCRAP')
            ->count();
    
            $unitUtilize = InspeksiComputer::with('computer.pengguna')
            ->where('site', $request->site)
            ->where('month', $thisMonth)
            ->where('year', $thisYear)
            ->where('inventory_status', '!=' ,'SCRAP')
            ->count();

            $pdf = Pdf::loadView('itportal.rekapAllInspeksi.inspeksiComputerAllMonth', compact('inspeksiComputerAll', 'thisYear', 'thisMonth', 'unitScrap', 'unitUtilize', 'site'))
                ->setPaper('A4', 'landscape');
        return $pdf->stream('inspection-computer-report-periode-' . 'triwulan-' .$thisMonth . '-' . $thisYear . '.pdf');
        }

    }
}
