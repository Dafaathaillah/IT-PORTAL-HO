<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aduan;
use App\Models\InspeksiComputer;
use App\Models\InspeksiLaptop;
use App\Models\InvAp;
use App\Models\InvCctv;
use App\Models\InvComputer;
use App\Models\InvLaptop;
use App\Models\InvPrinter;
use App\Models\InvSwitch;
use App\Models\InvWirelless;
use App\Models\UserAll;
use Carbon\Carbon;
use Inertia\Inertia;

class DashboardValeController extends Controller
{
    public function index()
    {
        $aduan = Aduan::orderBy('date_of_complaint', 'desc')->where('site','VALE')->get();
        $countOpen = Aduan::where('status', 'OPEN')->where('site','VALE')->count();
        $countClosed = Aduan::where('status', 'CLOSED')->where('site','VALE')->count();
        $countProgress = Aduan::where('status', 'PROGRESS')->where('site','VALE')->count();
        $countCancel = Aduan::where('status', 'CANCEL')->where('site','VALE')->count();

        // access point
        $countAPreadyused = InvAp::where('status', 'READY_USED')->where('site','VALE')->count();
        $countAPstandby = InvAp::where('status', 'READY_STANDBY')->where('site','VALE')->count();
        $countAPBreakdown = InvAp::where('status', 'BREAKDOWN')->where('site','VALE')->count();
        $countAPScrap = InvAp::where('status', 'SCRAP')->where('site','VALE')->count();

        // Switch
        $countSwitchreadyused = InvSwitch::where('status', 'READY_USED')->where('site','VALE')->count();
        $countSwitchstandby = InvSwitch::where('status', 'READY_STANDBY')->where('site','VALE')->count();
        $countSwitchBreakdown = InvSwitch::where('status', 'BREAKDOWN')->where('site','VALE')->count();
        $countSwitchScrap = InvSwitch::where('status', 'SCRAP')->where('site','VALE')->count();

        // Wirelless
        $countWirellessreadyused = InvWirelless::where('status', 'READY_USED')->where('site','VALE')->count();
        $countWirellessstandby = InvWirelless::where('status', 'READY_STANDBY')->where('site','VALE')->count();
        $countWirellessBreakdown = InvWirelless::where('status', 'BREAKDOWN')->where('site','VALE')->count();
        $countWirellessScrap = InvWirelless::where('status', 'SCRAP')->where('site','VALE')->count();

        // Printer
        $countPrinterreadyused = InvPrinter::where('status', 'READY_USED')->where('site','VALE')->count();
        $countPrinterstandby = InvPrinter::where('status', 'READY_STANDBY')->where('site','VALE')->count();
        $countPrinterBreakdown = InvPrinter::where('status', 'BREAKDOWN')->where('site','VALE')->count();
        $countPrinterScrap = InvPrinter::where('status', 'SCRAP')->where('site','VALE')->count();

        // CCTV
        $countCCTVreadyused = InvCctv::where('status', 'READY_USED')->where('site','VALE')->count();
        $countCCTVstandby = InvCctv::where('status', 'READY_STANDBY')->where('site','VALE')->count();
        $countCCTVBreakdown = InvCctv::where('status', 'BREAKDOWN')->where('site','VALE')->count();
        $countCCTVScrap = InvCctv::where('status', 'SCRAP')->where('site','VALE')->count();

        // Komputer
        $countKomputerreadyused = InvComputer::where('status', 'READY_USED')->where('site','VALE')->count();
        $countKomputerstandby = InvComputer::where('status', 'READY_STANDBY')->where('site','VALE')->count();
        $countKomputerBreakdown = InvComputer::where('status', 'BREAKDOWN')->where('site','VALE')->count();
        $countKomputerScrap = InvComputer::where('status', 'SCRAP')->where('site','VALE')->count();

        // Laptop
        $countLaptopreadyused = InvLaptop::where('status', 'READY_USED')->where('site','VALE')->count();
        $countLaptopstandby = InvLaptop::where('status', 'READY_STANDBY')->where('site','VALE')->count();
        $countLaptopBreakdown = InvLaptop::where('status', 'BREAKDOWN')->where('site','VALE')->count();
        $countLaptopScrap = InvLaptop::where('status', 'SCRAP')->where('site','VALE')->count();

        // AP,SW,BB,PRT,CCTV,KOMP,Laptop

        $breakdown_array = [$countAPBreakdown, $countSwitchBreakdown, $countWirellessBreakdown, $countPrinterBreakdown, $countCCTVBreakdown, $countKomputerBreakdown, $countLaptopBreakdown];

        $scrap_array = [$countAPScrap, $countSwitchScrap, $countWirellessScrap, $countPrinterScrap, $countCCTVScrap, $countKomputerScrap, $countLaptopScrap];

        $readyStandby_array = [$countAPstandby, $countSwitchstandby, $countWirellessstandby, $countPrinterstandby, $countCCTVstandby, $countKomputerstandby, $countLaptopstandby];

        $readyUsed_array = [$countAPreadyused, $countSwitchreadyused, $countWirellessreadyused, $countPrinterreadyused, $countCCTVreadyused, $countKomputerreadyused, $countLaptopreadyused];

        $loginSession =  'tes';

        $countAllDataInspeksiLaptop = InspeksiLaptop::where('site', 'VIB')
            ->where('year', Carbon::now()->year)
            ->count();
        $countSudahInspeksiLaptop = InspeksiLaptop::where('inspection_status', 'Y')
            ->where('site', 'VIB')
            ->where('year', Carbon::now()->year)
            ->count();
        $countBelumInspeksiLaptop = InspeksiLaptop::where('inspection_status', 'N')
            ->where('site', 'VIB')
            ->where('year', Carbon::now()->year)
            ->count();
        if ($countAllDataInspeksiLaptop > 0) {
            $percentLaptopSudahInspeksi = ($countSudahInspeksiLaptop / $countAllDataInspeksiLaptop) * 100;
            $percentLaptopBelumInspeksi = ($countBelumInspeksiLaptop / $countAllDataInspeksiLaptop) * 100;
        } else {
            $percentLaptopSudahInspeksi = 0;
            $percentLaptopBelumInspeksi = 0;
        }

        $triwulanSekarang = Carbon::now()->quarter;

        $countAllDataInspeksiComputer = InspeksiComputer::where('site', 'VIB')
            ->where('triwulan', $triwulanSekarang)
            ->count();
        $countSudahInspeksiComputer = InspeksiComputer::where('inspection_status', 'Y')
            ->where('site', 'VIB')
            ->where('triwulan', $triwulanSekarang)
            ->count();
        $countBelumInspeksiComputer = InspeksiComputer::where('inspection_status', 'N')
            ->where('site', 'VIB')
            ->where('triwulan', $triwulanSekarang)
            ->count();

        if ($countAllDataInspeksiComputer > 0) {
            $percentComputerSudahInspeksi = ($countSudahInspeksiComputer / $countAllDataInspeksiComputer) * 100;
            $percentComputerBelumInspeksi = ($countBelumInspeksiComputer / $countAllDataInspeksiComputer) * 100;
        } else {
            $percentComputerSudahInspeksi = 0;
            $percentComputerBelumInspeksi = 0;
        }

        $sudahInspeksiArray = [$percentLaptopSudahInspeksi, $percentComputerSudahInspeksi];
        $belumInspeksiArray = [$percentLaptopBelumInspeksi, $percentComputerBelumInspeksi];

        $bulanSekarang = Carbon::now()->month;
        $totalAduanAll = Aduan::where('site', 'VIB')->whereMonth('created_at', $bulanSekarang)->count();
        if ($totalAduanAll > 0) {
            $totalAduan = $totalAduanAll;

            $aduanTelkomsel = Aduan::where('site', 'VIB')->whereMonth('created_at', $bulanSekarang)->where('category_name', 'TELKOMSEL')->count();
            $aduanTelkomselPercent = ($aduanTelkomsel / $totalAduan) * 100;

            $aduanRadio = Aduan::where('site', 'VIB')->whereMonth('created_at', $bulanSekarang)->where('category_name', 'RADIO')->count();
            $aduanRadioPercent = ($aduanRadio / $totalAduan) * 100;

            $aduanServer = Aduan::where('site', 'VIB')->whereMonth('created_at', $bulanSekarang)->where('category_name', 'SERVER')->count();
            $aduanServerPercent = ($aduanServer / $totalAduan) * 100;

            $aduanSs6 = Aduan::where('site', 'VIB')->whereMonth('created_at', $bulanSekarang)->where('category_name', 'SS6')->count();
            $aduanSs6Percent = ($aduanSs6 / $totalAduan) * 100;

            $aduanWebsite = Aduan::where('site', 'VIB')->whereMonth('created_at', $bulanSekarang)->where('category_name', 'WEBSITE')->count();
            $aduanWebsitePercent = ($aduanWebsite / $totalAduan) * 100;

            $aduanNetwork = Aduan::where('site', 'VIB')->whereMonth('created_at', $bulanSekarang)->where('category_name', 'NETWORK')->count();
            $aduanNetworkPercent = ($aduanNetwork / $totalAduan) * 100;

            $aduanSap = Aduan::where('site', 'VIB')->whereMonth('created_at', $bulanSekarang)->where('category_name', 'SAP')->count();
            $aduanSapPercent = ($aduanSap / $totalAduan) * 100;

            $aduanPcNb = Aduan::where('site', 'VIB')->whereMonth('created_at', $bulanSekarang)->where('category_name', 'PC/NB')->count();
            $aduanPcNbPercent = ($aduanPcNb / $totalAduan) * 100;

            $aduanPrinter = Aduan::where('site', 'VIB')->whereMonth('created_at', $bulanSekarang)->where('category_name', 'PRINTER')->count();
            $aduanPrinterPercent = ($aduanPrinter / $totalAduan) * 100;

            $aduanOther = Aduan::where('site', 'VIB')->whereMonth('created_at', $bulanSekarang)->where('category_name', 'OTHER')->count();
            $aduanOtherPercent = ($aduanOther / $totalAduan) * 100;
        }else{
            $totalAduan = 0;
            $aduanTelkomselPercent = 0;
            $aduanRadioPercent = 0;
            $aduanServerPercent = 0;
            $aduanSs6Percent = 0;
            $aduanWebsitePercent = 0;
            $aduanNetworkPercent = 0;
            $aduanSapPercent = 0;
            $aduanPcNbPercent = 0;
            $aduanPrinterPercent = 0;
            $aduanOtherPercent = 0;
            $aduanTelkomsel = 0;
            $aduanRadio = 0;
            $aduanServer = 0;
            $aduanSs6 = 0;
            $aduanWebsite = 0;
            $aduanNetwork = 0;
            $aduanSap = 0;
            $aduanPcNb = 0;
            $aduanPrinter = 0;
            $aduanOther = 0;
        }


        return Inertia::render(
            'Inventory/SiteVale/Dashboard',
            [
                'aduan' => $aduan,
                'open' => $countOpen,
                'closed' => $countClosed,
                'progress' => $countProgress,
                'cancel' => $countCancel,
                'breakdown_array' => $breakdown_array,
                'scrap_array' => $scrap_array,
                'readyStandby_array' => $readyStandby_array,
                'readyUsed_array' => $readyUsed_array,
                'loginSession' => $loginSession,
                'sudahInspeksi' => $sudahInspeksiArray,
                'belumInspeksi' => $belumInspeksiArray,
                'totalAduan' => $totalAduan,
                'telkomsel' => $aduanTelkomselPercent,
                'radio' => $aduanRadioPercent,
                'server' => $aduanServerPercent,
                'ss6' => $aduanSs6Percent,
                'website' => $aduanWebsitePercent,
                'network' => $aduanNetworkPercent,
                'sap' => $aduanSapPercent,
                'pcNb' => $aduanPcNbPercent,
                'printer' => $aduanPrinterPercent,
                'other' => $aduanOtherPercent,
                'aduanTelkomsel' => $aduanTelkomsel,
                'aduanRadio' => $aduanRadio,
                'aduanServer' => $aduanServer,
                'aduanSs6' => $aduanSs6,
                'aduanWebsite' => $aduanWebsite,
                'aduanNetwork' => $aduanNetwork,
                'aduanSap' => $aduanSap,
                'aduanPcNb' => $aduanPcNb,
                'aduanPrinter' => $aduanPrinter,
                'aduanOther' => $aduanOther,
            ]
        );
    }
}
