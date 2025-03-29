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

class DashboardAmiController extends Controller
{
    public function index()
    {
        $aduan = Aduan::orderBy('date_of_complaint', 'desc')->where('site','AMI')->get();
        $countOpen = Aduan::where('status', 'OPEN')->where('site','AMI')->count();
        $countClosed = Aduan::where('status', 'CLOSED')->where('site','AMI')->count();
        $countProgress = Aduan::where('status', 'PROGRESS')->where('site','AMI')->count();
        $countCancel = Aduan::where('status', 'CANCEL')->where('site','AMI')->count();

        // access point
        $countAPreadyused = InvAp::where('status', 'READY_USED')->where('site','AMI')->count();
        $countAPstandby = InvAp::where('status', 'READY_STANDBY')->where('site','AMI')->count();
        $countAPBreakdown = InvAp::where('status', 'BREAKDOWN')->where('site','AMI')->count();
        $countAPScrap = InvAp::where('status', 'SCRAP')->where('site','AMI')->count();

        // Switch
        $countSwitchreadyused = InvSwitch::where('status', 'READY_USED')->where('site','AMI')->count();
        $countSwitchstandby = InvSwitch::where('status', 'READY_STANDBY')->where('site','AMI')->count();
        $countSwitchBreakdown = InvSwitch::where('status', 'BREAKDOWN')->where('site','AMI')->count();
        $countSwitchScrap = InvSwitch::where('status', 'SCRAP')->where('site','AMI')->count();

        // Wirelless
        $countWirellessreadyused = InvWirelless::where('status', 'READY_USED')->where('site','AMI')->count();
        $countWirellessstandby = InvWirelless::where('status', 'READY_STANDBY')->where('site','AMI')->count();
        $countWirellessBreakdown = InvWirelless::where('status', 'BREAKDOWN')->where('site','AMI')->count();
        $countWirellessScrap = InvWirelless::where('status', 'SCRAP')->where('site','AMI')->count();

        // Printer
        $countPrinterreadyused = InvPrinter::where('status', 'READY_USED')->where('site','AMI')->count();
        $countPrinterstandby = InvPrinter::where('status', 'READY_STANDBY')->where('site','AMI')->count();
        $countPrinterBreakdown = InvPrinter::where('status', 'BREAKDOWN')->where('site','AMI')->count();
        $countPrinterScrap = InvPrinter::where('status', 'SCRAP')->where('site','AMI')->count();

        // CCTV
        $countCCTVreadyused = InvCctv::where('status', 'READY_USED')->where('site','AMI')->count();
        $countCCTVstandby = InvCctv::where('status', 'READY_STANDBY')->where('site','AMI')->count();
        $countCCTVBreakdown = InvCctv::where('status', 'BREAKDOWN')->where('site','AMI')->count();
        $countCCTVScrap = InvCctv::where('status', 'SCRAP')->where('site','AMI')->count();

        // Komputer
        $countKomputerreadyused = InvComputer::where('status', 'READY_USED')->where('site','AMI')->count();
        $countKomputerstandby = InvComputer::where('status', 'READY_STANDBY')->where('site','AMI')->count();
        $countKomputerBreakdown = InvComputer::where('status', 'BREAKDOWN')->where('site','AMI')->count();
        $countKomputerScrap = InvComputer::where('status', 'SCRAP')->where('site','AMI')->count();

        // Laptop
        $countLaptopreadyused = InvLaptop::where('status', 'READY_USED')->where('site','AMI')->count();
        $countLaptopstandby = InvLaptop::where('status', 'READY_STANDBY')->where('site','AMI')->count();
        $countLaptopBreakdown = InvLaptop::where('status', 'BREAKDOWN')->where('site','AMI')->count();
        $countLaptopScrap = InvLaptop::where('status', 'SCRAP')->where('site','AMI')->count();

        // AP,SW,BB,PRT,CCTV,KOMP,Laptop

        $breakdown_array = [$countAPBreakdown, $countSwitchBreakdown, $countWirellessBreakdown, $countPrinterBreakdown, $countCCTVBreakdown, $countKomputerBreakdown, $countLaptopBreakdown];

        $scrap_array = [$countAPScrap, $countSwitchScrap, $countWirellessScrap, $countPrinterScrap, $countCCTVScrap, $countKomputerScrap, $countLaptopScrap];

        $readyStandby_array = [$countAPstandby, $countSwitchstandby, $countWirellessstandby, $countPrinterstandby, $countCCTVstandby, $countKomputerstandby, $countLaptopstandby];

        $readyUsed_array = [$countAPreadyused, $countSwitchreadyused, $countWirellessreadyused, $countPrinterreadyused, $countCCTVreadyused, $countKomputerreadyused, $countLaptopreadyused];

        $loginSession =  'tes';

        $countAllDataInspeksiLaptop = 100;
        $countSudahInspeksiLaptop = InspeksiLaptop::where('inspection_status', 'Y')
            ->where('site', 'AMI')
            ->whereYear('year', Carbon::now()->year)
            ->count();
        $countBelumInspeksiLaptop = InspeksiLaptop::where('inspection_status', 'N')
            ->where('site', 'AMI')
            ->whereYear('year', Carbon::now()->year)
            ->count();
        if ($countAllDataInspeksiLaptop > 0) {
            $percentLaptopSudahInspeksi = ($countSudahInspeksiLaptop / $countAllDataInspeksiLaptop) * 100;
            $percentLaptopBelumInspeksi = ($countBelumInspeksiLaptop / $countAllDataInspeksiLaptop) * 100;
        } else {
            $percentLaptopSudahInspeksi = 0;
            $percentLaptopBelumInspeksi = 0;
        }

        $triwulanSekarang = Carbon::now()->quarter;

        $countAllDataInspeksiComputer = InspeksiComputer::where('site', 'AMI')
            ->whereYear('triwulan', $triwulanSekarang)
            ->count();
        $countSudahInspeksiComputer = InspeksiComputer::where('inspection_status', 'Y')
            ->where('site', 'AMI')
            ->whereYear('triwulan', $triwulanSekarang)
            ->count();
        $countBelumInspeksiComputer = InspeksiComputer::where('inspection_status', 'N')
            ->where('site', 'AMI')
            ->whereYear('triwulan', $triwulanSekarang)
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

        $totalAduanAll = Aduan::where('site', 'AMI')->count();
            if ($totalAduanAll > 0) {
                $totalAduan = $totalAduanAll;

                $aduanTelkomsel = Aduan::where('site', 'AMI')->where('category_name', 'TELKOMSEL')->count();
                $aduanTelkomselPercent = ($aduanTelkomsel / $totalAduan) * 100;

                $aduanRadio = Aduan::where('site', 'AMI')->where('category_name', 'RADIO')->count();
                $aduanRadioPercent = ($aduanRadio / $totalAduan) * 100;

                $aduanServer = Aduan::where('site', 'AMI')->where('category_name', 'SERVER')->count();
                $aduanServerPercent = ($aduanServer / $totalAduan) * 100;

                $aduanSs6 = Aduan::where('site', 'AMI')->where('category_name', 'SS6')->count();
                $aduanSs6Percent = ($aduanSs6 / $totalAduan) * 100;

                $aduanWebsite = Aduan::where('site', 'AMI')->where('category_name', 'WEBSITE')->count();
                $aduanWebsitePercent = ($aduanWebsite / $totalAduan) * 100;

                $aduanNetwork = Aduan::where('site', 'AMI')->where('category_name', 'NETWORK')->count();
                $aduanNetworkPercent = ($aduanNetwork / $totalAduan) * 100;

                $aduanSap = Aduan::where('site', 'AMI')->where('category_name', 'SAP')->count();
                $aduanSapPercent = ($aduanSap / $totalAduan) * 100;

                $aduanPcNb = Aduan::where('site', 'AMI')->where('category_name', 'PC/NB')->count();
                $aduanPcNbPercent = ($aduanPcNb / $totalAduan) * 100;

                $aduanPrinter = Aduan::where('site', 'AMI')->where('category_name', 'PRINTER')->count();
                $aduanPrinterPercent = ($aduanPrinter / $totalAduan) * 100;

                $aduanOther = Aduan::where('site', 'AMI')->where('category_name', 'OTHER')->count();
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
            }


        return Inertia::render(
            'Inventory/SiteAmi/Dashboard',
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
