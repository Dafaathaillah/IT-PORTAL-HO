<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aduan;
use App\Models\InvAp;
use App\Models\InvCctv;
use App\Models\InvComputer;
use App\Models\InvLaptop;
use App\Models\InvPrinter;
use App\Models\InvSwitch;
use App\Models\InvWirelless;
use App\Models\UserAll;
use Inertia\Inertia;

class DashboardBaController extends Controller
{
    public function index()
    {
        $aduan = Aduan::orderBy('date_of_complaint', 'desc')->where('site','BA')->get();
        $countOpen = Aduan::where('status', 'OPEN')->where('site','BA')->count();
        $countClosed = Aduan::where('status', 'CLOSED')->where('site','BA')->count();
        $countProgress = Aduan::where('status', 'PROGRESS')->where('site','BA')->count();
        $countCancel = Aduan::where('status', 'CANCEL')->where('site','BA')->count();

        // access point
        $countAPreadyused = InvAp::where('status', 'READY_USED')->where('site','BA')->count();
        $countAPstandby = InvAp::where('status', 'READY_STANDBY')->where('site','BA')->count();
        $countAPBreakdown = InvAp::where('status', 'BREAKDOWN')->where('site','BA')->count();
        $countAPScrap = InvAp::where('status', 'SCRAP')->where('site','BA')->count();

        // Switch
        $countSwitchreadyused = InvSwitch::where('status', 'READY_USED')->where('site','BA')->count();
        $countSwitchstandby = InvSwitch::where('status', 'READY_STANDBY')->where('site','BA')->count();
        $countSwitchBreakdown = InvSwitch::where('status', 'BREAKDOWN')->where('site','BA')->count();
        $countSwitchScrap = InvSwitch::where('status', 'SCRAP')->where('site','BA')->count();

        // Wirelless
        $countWirellessreadyused = InvWirelless::where('status', 'READY_USED')->where('site','BA')->count();
        $countWirellessstandby = InvWirelless::where('status', 'READY_STANDBY')->where('site','BA')->count();
        $countWirellessBreakdown = InvWirelless::where('status', 'BREAKDOWN')->where('site','BA')->count();
        $countWirellessScrap = InvWirelless::where('status', 'SCRAP')->where('site','BA')->count();

        // Printer
        $countPrinterreadyused = InvPrinter::where('status', 'READY_USED')->where('site','BA')->count();
        $countPrinterstandby = InvPrinter::where('status', 'READY_STANDBY')->where('site','BA')->count();
        $countPrinterBreakdown = InvPrinter::where('status', 'BREAKDOWN')->where('site','BA')->count();
        $countPrinterScrap = InvPrinter::where('status', 'SCRAP')->where('site','BA')->count();

        // CCTV
        $countCCTVreadyused = InvCctv::where('status', 'READY_USED')->where('site','BA')->count();
        $countCCTVstandby = InvCctv::where('status', 'READY_STANDBY')->where('site','BA')->count();
        $countCCTVBreakdown = InvCctv::where('status', 'BREAKDOWN')->where('site','BA')->count();
        $countCCTVScrap = InvCctv::where('status', 'SCRAP')->where('site','BA')->count();

        // Komputer
        $countKomputerreadyused = InvComputer::where('status', 'READY_USED')->where('site','BA')->count();
        $countKomputerstandby = InvComputer::where('status', 'READY_STANDBY')->where('site','BA')->count();
        $countKomputerBreakdown = InvComputer::where('status', 'BREAKDOWN')->where('site','BA')->count();
        $countKomputerScrap = InvComputer::where('status', 'SCRAP')->where('site','BA')->count();

        // Laptop
        $countLaptopreadyused = InvLaptop::where('status', 'READY_USED')->where('site','BA')->count();
        $countLaptopstandby = InvLaptop::where('status', 'READY_STANDBY')->where('site','BA')->count();
        $countLaptopBreakdown = InvLaptop::where('status', 'BREAKDOWN')->where('site','BA')->count();
        $countLaptopScrap = InvLaptop::where('status', 'SCRAP')->where('site','BA')->count();

        // AP,SW,BB,PRT,CCTV,KOMP,Laptop

        $breakdown_array = [$countAPBreakdown, $countSwitchBreakdown, $countWirellessBreakdown, $countPrinterBreakdown, $countCCTVBreakdown, $countKomputerBreakdown, $countLaptopBreakdown];

        $scrap_array = [$countAPScrap, $countSwitchScrap, $countWirellessScrap, $countPrinterScrap, $countCCTVScrap, $countKomputerScrap, $countLaptopScrap];

        $readyStandby_array = [$countAPstandby, $countSwitchstandby, $countWirellessstandby, $countPrinterstandby, $countCCTVstandby, $countKomputerstandby, $countLaptopstandby];

        $readyUsed_array = [$countAPreadyused, $countSwitchreadyused, $countWirellessreadyused, $countPrinterreadyused, $countCCTVreadyused, $countKomputerreadyused, $countLaptopreadyused];

        $loginSession =  'tes';

        return Inertia::render(
            'Inventory/SiteBa/Dashboard',
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
            ]
        );
    }
}
