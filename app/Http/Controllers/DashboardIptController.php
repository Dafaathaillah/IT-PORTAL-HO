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

class DashboardIptController extends Controller
{
    public function index()
    {
        $aduan = Aduan::orderBy('date_of_complaint', 'desc')->where('site','IPT')->get();
        $countOpen = Aduan::where('status', 'OPEN')->where('site','IPT')->count();
        $countClosed = Aduan::where('status', 'CLOSED')->where('site','IPT')->count();
        $countProgress = Aduan::where('status', 'PROGRESS')->where('site','IPT')->count();
        $countCancel = Aduan::where('status', 'CANCEL')->where('site','IPT')->count();

        // access point
        $countAPreadyused = InvAp::where('status', 'READY_USED')->where('site','IPT')->count();
        $countAPstandby = InvAp::where('status', 'READY_STANDBY')->where('site','IPT')->count();
        $countAPBreakdown = InvAp::where('status', 'BREAKDOWN')->where('site','IPT')->count();
        $countAPScrap = InvAp::where('status', 'SCRAP')->where('site','IPT')->count();

        // Switch
        $countSwitchreadyused = InvSwitch::where('status', 'READY_USED')->where('site','IPT')->count();
        $countSwitchstandby = InvSwitch::where('status', 'READY_STANDBY')->where('site','IPT')->count();
        $countSwitchBreakdown = InvSwitch::where('status', 'BREAKDOWN')->where('site','IPT')->count();
        $countSwitchScrap = InvSwitch::where('status', 'SCRAP')->where('site','IPT')->count();

        // Wirelless
        $countWirellessreadyused = InvWirelless::where('status', 'READY_USED')->where('site','IPT')->count();
        $countWirellessstandby = InvWirelless::where('status', 'READY_STANDBY')->where('site','IPT')->count();
        $countWirellessBreakdown = InvWirelless::where('status', 'BREAKDOWN')->where('site','IPT')->count();
        $countWirellessScrap = InvWirelless::where('status', 'SCRAP')->where('site','IPT')->count();

        // Printer
        $countPrinterreadyused = InvPrinter::where('status', 'READY_USED')->where('site','IPT')->count();
        $countPrinterstandby = InvPrinter::where('status', 'READY_STANDBY')->where('site','IPT')->count();
        $countPrinterBreakdown = InvPrinter::where('status', 'BREAKDOWN')->where('site','IPT')->count();
        $countPrinterScrap = InvPrinter::where('status', 'SCRAP')->where('site','IPT')->count();

        // CCTV
        $countCCTVreadyused = InvCctv::where('status', 'READY_USED')->where('site','IPT')->count();
        $countCCTVstandby = InvCctv::where('status', 'READY_STANDBY')->where('site','IPT')->count();
        $countCCTVBreakdown = InvCctv::where('status', 'BREAKDOWN')->where('site','IPT')->count();
        $countCCTVScrap = InvCctv::where('status', 'SCRAP')->where('site','IPT')->count();

        // Komputer
        $countKomputerreadyused = InvComputer::where('status', 'READY_USED')->where('site','IPT')->count();
        $countKomputerstandby = InvComputer::where('status', 'READY_STANDBY')->where('site','IPT')->count();
        $countKomputerBreakdown = InvComputer::where('status', 'BREAKDOWN')->where('site','IPT')->count();
        $countKomputerScrap = InvComputer::where('status', 'SCRAP')->where('site','IPT')->count();

        // Laptop
        $countLaptopreadyused = InvLaptop::where('status', 'READY_USED')->where('site','IPT')->count();
        $countLaptopstandby = InvLaptop::where('status', 'READY_STANDBY')->where('site','IPT')->count();
        $countLaptopBreakdown = InvLaptop::where('status', 'BREAKDOWN')->where('site','IPT')->count();
        $countLaptopScrap = InvLaptop::where('status', 'SCRAP')->where('site','IPT')->count();

        // AP,SW,BB,PRT,CCTV,KOMP,Laptop

        $breakdown_array = [$countAPBreakdown, $countSwitchBreakdown, $countWirellessBreakdown, $countPrinterBreakdown, $countCCTVBreakdown, $countKomputerBreakdown, $countLaptopBreakdown];

        $scrap_array = [$countAPScrap, $countSwitchScrap, $countWirellessScrap, $countPrinterScrap, $countCCTVScrap, $countKomputerScrap, $countLaptopScrap];

        $readyStandby_array = [$countAPstandby, $countSwitchstandby, $countWirellessstandby, $countPrinterstandby, $countCCTVstandby, $countKomputerstandby, $countLaptopstandby];

        $readyUsed_array = [$countAPreadyused, $countSwitchreadyused, $countWirellessreadyused, $countPrinterreadyused, $countCCTVreadyused, $countKomputerreadyused, $countLaptopreadyused];

        $loginSession =  'tes';

        return Inertia::render(
            'Inventory/SiteIpt/Dashboard',
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
