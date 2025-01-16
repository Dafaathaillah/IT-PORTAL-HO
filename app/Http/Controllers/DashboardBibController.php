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

class DashboardBibController extends Controller
{
    public function index()
    {
        $aduan = Aduan::orderBy('date_of_complaint', 'desc')->where('site','BIB')->get();
        $countOpen = Aduan::where('status', 'OPEN')->where('site','BIB')->count();
        $countClosed = Aduan::where('status', 'CLOSED')->where('site','BIB')->count();
        $countProgress = Aduan::where('status', 'PROGRESS')->where('site','BIB')->count();
        $countCancel = Aduan::where('status', 'CANCEL')->where('site','BIB')->count();

        // access point
        $countAPreadyused = InvAp::where('status', 'READY_USED')->where('site','BIB')->count();
        $countAPstandby = InvAp::where('status', 'READY_STANDBY')->where('site','BIB')->count();
        $countAPBreakdown = InvAp::where('status', 'BREAKDOWN')->where('site','BIB')->count();
        $countAPScrap = InvAp::where('status', 'SCRAP')->where('site','BIB')->count();

        // Switch
        $countSwitchreadyused = InvSwitch::where('status', 'READY_USED')->where('site','BIB')->count();
        $countSwitchstandby = InvSwitch::where('status', 'READY_STANDBY')->where('site','BIB')->count();
        $countSwitchBreakdown = InvSwitch::where('status', 'BREAKDOWN')->where('site','BIB')->count();
        $countSwitchScrap = InvSwitch::where('status', 'SCRAP')->where('site','BIB')->count();

        // Wirelless
        $countWirellessreadyused = InvWirelless::where('status', 'READY_USED')->where('site','BIB')->count();
        $countWirellessstandby = InvWirelless::where('status', 'READY_STANDBY')->where('site','BIB')->count();
        $countWirellessBreakdown = InvWirelless::where('status', 'BREAKDOWN')->where('site','BIB')->count();
        $countWirellessScrap = InvWirelless::where('status', 'SCRAP')->where('site','BIB')->count();

        // Printer
        $countPrinterreadyused = InvPrinter::where('status', 'READY_USED')->where('site','BIB')->count();
        $countPrinterstandby = InvPrinter::where('status', 'READY_STANDBY')->where('site','BIB')->count();
        $countPrinterBreakdown = InvPrinter::where('status', 'BREAKDOWN')->where('site','BIB')->count();
        $countPrinterScrap = InvPrinter::where('status', 'SCRAP')->where('site','BIB')->count();

        // CCTV
        $countCCTVreadyused = InvCctv::where('status', 'READY_USED')->where('site','BIB')->count();
        $countCCTVstandby = InvCctv::where('status', 'READY_STANDBY')->where('site','BIB')->count();
        $countCCTVBreakdown = InvCctv::where('status', 'BREAKDOWN')->where('site','BIB')->count();
        $countCCTVScrap = InvCctv::where('status', 'SCRAP')->where('site','BIB')->count();

        // Komputer
        $countKomputerreadyused = InvComputer::where('status', 'READY_USED')->where('site','BIB')->count();
        $countKomputerstandby = InvComputer::where('status', 'READY_STANDBY')->where('site','BIB')->count();
        $countKomputerBreakdown = InvComputer::where('status', 'BREAKDOWN')->where('site','BIB')->count();
        $countKomputerScrap = InvComputer::where('status', 'SCRAP')->where('site','BIB')->count();

        // Laptop
        $countLaptopreadyused = InvLaptop::where('status', 'READY_USED')->where('site','BIB')->count();
        $countLaptopstandby = InvLaptop::where('status', 'READY_STANDBY')->where('site','BIB')->count();
        $countLaptopBreakdown = InvLaptop::where('status', 'BREAKDOWN')->where('site','BIB')->count();
        $countLaptopScrap = InvLaptop::where('status', 'SCRAP')->where('site','BIB')->count();

        // AP,SW,BB,PRT,CCTV,KOMP,Laptop

        $breakdown_array = [$countAPBreakdown, $countSwitchBreakdown, $countWirellessBreakdown, $countPrinterBreakdown, $countCCTVBreakdown, $countKomputerBreakdown, $countLaptopBreakdown];

        $scrap_array = [$countAPScrap, $countSwitchScrap, $countWirellessScrap, $countPrinterScrap, $countCCTVScrap, $countKomputerScrap, $countLaptopScrap];

        $readyStandby_array = [$countAPstandby, $countSwitchstandby, $countWirellessstandby, $countPrinterstandby, $countCCTVstandby, $countKomputerstandby, $countLaptopstandby];

        $readyUsed_array = [$countAPreadyused, $countSwitchreadyused, $countWirellessreadyused, $countPrinterreadyused, $countCCTVreadyused, $countKomputerreadyused, $countLaptopreadyused];

        $loginSession =  'tes';

        return Inertia::render(
            'Inventory/SitePik/Dashboard',
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
