<?php

namespace App\Http\Controllers;

use App\Models\InspeksiLaptop;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ExportInspeksiLaptopController extends Controller
{
    public function exportPdf(Request $request)
    {
        $user = Auth::user();
        $thisYearEncrypt = $request->query('year') ?? Carbon::now()->year;
        try {
            $thisYear = Crypt::decryptString($thisYearEncrypt); // Dekripsi year dari URL
        } catch (\Exception $e) {
            abort(403, "Akses tidak valid");
        }

        if ($thisYear > 2500) {
            return back()->with('error', 'Tahun tidak terdeteksi.');
        }

        
        $inspeksiLaptop = InspeksiLaptop::with('inventory.pengguna')
            ->where('site', $user->site)
            ->where('year', $thisYear)
            ->get();

        $pdf = Pdf::loadView('itportal.rekapAllInspeksi.inspeksiLaptop', compact('inspeksiLaptop', 'thisYear'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('inspection-laptop-report-periode-' . $thisYear . '.pdf');
    }
}
