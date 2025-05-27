<?php

namespace App\Http\Controllers;

use App\Models\InspeksiLaptop;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class ExportInspeksiLaptopController extends Controller
{
    public function exportPdfAll(Request $request)
    {
        $user = Auth::user();
        $site = $request->site;
        $thisYearEncrypt = $request->query('year') ?? Carbon::now()->year;
        // dd('OKE');
        try {
            $thisYear = Crypt::decryptString($thisYearEncrypt); // Dekripsi year dari URL
            // dd($thisYear);
        } catch (\Exception $e) {
            abort(403, "Akses tidak valid");
        }

        if ($thisYear > 2500) {
            return back()->with('error', 'Tahun tidak terdeteksi.');
        }
        // dd($request->site);
        $inspeksiLaptopAll = InspeksiLaptop::with('inventory.pengguna')
            ->where('site', $request->site)
            ->where('year', $thisYear)
            ->get()->map(function ($item) {
                $spesifikasi = $item->inventory->spesifikasi ?? '';
                $item->spesifikasi_singkat = $spesifikasi !== '' ? Str::before($spesifikasi, ',') : '-';
                return $item;
            });

        $unitScrap = InspeksiLaptop::with('inventory.pengguna')
            ->where('site', $request->site)
            ->where('year', $thisYear)
            ->where('inventory_status', 'SCRAP')
            ->count();

        $unitUtilize = InspeksiLaptop::with('inventory.pengguna')
            ->where('site', $request->site)
            ->where('year', $thisYear)
            ->where('inventory_status', '!=', 'SCRAP')
            ->count();

        $pdf = Pdf::loadView('itportal.rekapAllInspeksi.inspeksiLaptopAll', compact('inspeksiLaptopAll', 'thisYear', 'unitScrap', 'unitUtilize', 'site'))
            ->setPaper('A4', 'landscape');


        return $pdf->stream('inspection-laptop-report-periode-' . '.pdf');
    }

    public function exportPdfSingle(Request $request)
    {
        $user = Auth::user();
        $site = $user->site;
        $thisYear = Carbon::now()->year;

        if ($thisYear > 2500) {
            return back()->with('error', 'Tahun tidak terdeteksi.');
        }


        $inspeksiLaptop = InspeksiLaptop::with('inventory.pengguna')
            ->where('id', $request->inspeksiId)
            ->get();

        $pdf = Pdf::loadView('itportal.rekapAllInspeksi.inspeksiLaptop', compact('inspeksiLaptop', 'thisYear', 'site'))
            ->setPaper('A4', 'potrait');
        return $pdf->stream('inspection-laptop-report-periode-' . $thisYear . '.pdf');
    }
}
