<?php

namespace App\Http\Controllers;

use App\Models\InspeksiLaptop;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
// use Milon\Barcode\DNS2D;
use DNS2D;

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

    // public function exportPdfSingle(Request $request)
    // {
    //     $user = Auth::user();
    //     $site = $user->site;
    //     $thisYear = Carbon::now()->year;

    //     if ($thisYear > 2500) {
    //         return back()->with('error', 'Tahun tidak terdeteksi.');
    //     }


    //     $inspeksiLaptop = InspeksiLaptop::with('inventory.pengguna')
    //         ->where('id', $request->inspeksiId)
    //         ->get();

    //     // Filter hanya inspeksi yang approved (status == 'Y')
    //     $inspectionStatus = $inspeksiLaptop->where('inspection_status', 'Y');

    //     if ($inspectionStatus->isNotEmpty()) {
    //         // Ambil nama approved_by yang unik
    //         $approvedNames = $inspectionStatus->pluck('approved_by')->unique();

    //         // Ambil user berdasarkan nama saja
    //         $users = User::whereIn('name', $approvedNames)->get();

    //         // Buat map nama → user
    //         $userMap = $users->keyBy('name');

    //         // Tambahkan approved_user ke setiap inspeksi
    //         $inspeksiLaptop->transform(function ($inspeksi) use ($userMap) {
    //             $inspeksi->approved_user = $userMap[$inspeksi->approved_by] ?? null;
    //             return $inspeksi;
    //         });

    //         $dataQr = $inspeksiLaptop->map(function ($item) {
    //             return [
    //                 'nrp' => $item->approved_user->nrp,
    //                 'nama' => $item->approved_user->name,
    //                 'jabatan' => $item->approved_user->position,
    //             ];
    //         });

    //         dd($dataQr);

    //         $pdf = Pdf::loadView('itportal.rekapAllInspeksi.inspeksiLaptop', compact('inspeksiLaptop', 'thisYear', 'site'))
    //             ->setPaper('A4', 'potrait');
    //         return $pdf->stream('inspection-laptop-report-periode-' . $thisYear . '.pdf');
    //     }
    //     $pdf = Pdf::loadView('itportal.rekapAllInspeksi.inspeksiLaptop', compact('inspeksiLaptop', 'thisYear', 'site'))
    //         ->setPaper('A4', 'potrait');
    //     return $pdf->stream('inspection-laptop-report-periode-' . $thisYear . '.pdf');
    // }

    public function exportPdfSingle(Request $request)
    {
        $user = Auth::user();
        $site = $user->site;
        $thisYear = Carbon::now()->year;

        if ($thisYear > 2500) {
            return back()->with('error', 'Tahun tidak terdeteksi.');
        }

        // Ambil hanya satu data inspeksi yang sesuai dan sudah disetujui
        $inspection = InspeksiLaptop::with('inventory.pengguna')
            ->where('id', $request->inspeksiId)
            // ->where('inspection_status', 'Y')
            ->first();

        if (!$inspection) {
            return back()->with('error', 'Data inspeksi tidak ditemukan atau belum disetujui.');
        }

        // Ambil data user yang menyetujui
        if ($inspection->inspection_status == 'Y') {
            $approvedUser = User::where('name', $inspection->approved_by)->first();
            $inspectorUser = User::where('name', $inspection->inspector)->first();
        }else{
             $approvedUser = '';
            $inspectorUser = '';
        }

        // Tambahkan data tambahan untuk QR Code
        if ($approvedUser) {
            $qrString = "NRP: {$approvedUser->nrp}, Nama: {$approvedUser->name}, Jabatan: {$approvedUser->position}";
            $inspection->qr_string = $qrString;
            $barcode = new \Milon\Barcode\DNS2D();
            $barcode->setStorPath(storage_path('framework/barcodes/')); // agar tidak error
            $pngData = $barcode->getBarcodePNG($qrString, 'QRCODE');

            $inspection->qr_base64Approved = 'data:image/png;base64,' . $pngData;
        } else {
            $inspection->qr_string = null;
            $inspection->qr_base64Approved = null;
        }

        if ($inspectorUser) {
            $qrString = "NRP: {$inspectorUser->nrp}, Nama: {$inspectorUser->name}, Jabatan: {$inspectorUser->position}";
            $inspection->qr_string = $qrString;
            $barcode = new \Milon\Barcode\DNS2D();
            $barcode->setStorPath(storage_path('framework/barcodes/')); // agar tidak error
            $pngData = $barcode->getBarcodePNG($qrString, 'QRCODE');

            $inspection->qr_base64Inspector = 'data:image/png;base64,' . $pngData;
        } else {
            $inspection->qr_string = null;
            $inspection->qr_base64Inspector = null;
        }

        // Kirim ke view
        $pdf = Pdf::loadView('itportal.rekapAllInspeksi.inspeksiLaptop', [
            'inspection' => $inspection,
            'thisYear' => $thisYear,
            'site' => $site,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('inspection-laptop-report-periode-' . $thisYear . '.pdf');
    }
}
