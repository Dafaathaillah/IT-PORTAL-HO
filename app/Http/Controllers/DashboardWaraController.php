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

class DashboardWaraController extends Controller
{
    public function index()
    {
        $aduan = Aduan::orderBy('date_of_complaint', 'desc')->where('site','ADW')->get();
        $countOpen = Aduan::where('status', 'OPEN')->where('site','ADW')->count();
        $countClosed = Aduan::where('status', 'CLOSED')->where('site','ADW')->count();
        $countProgress = Aduan::where('status', 'PROGRESS')->where('site','ADW')->count();
        $countCancel = Aduan::where('status', 'CANCEL')->where('site','ADW')->count();

        // access point
        $countAPreadyused = InvAp::where('status', 'READY_USED')->where('site','ADW')->count();
        $countAPstandby = InvAp::where('status', 'READY_STANDBY')->where('site','ADW')->count();
        $countAPBreakdown = InvAp::where('status', 'BREAKDOWN')->where('site','ADW')->count();
        $countAPScrap = InvAp::where('status', 'SCRAP')->where('site','ADW')->count();

        // Switch
        $countSwitchreadyused = InvSwitch::where('status', 'READY_USED')->where('site','ADW')->count();
        $countSwitchstandby = InvSwitch::where('status', 'READY_STANDBY')->where('site','ADW')->count();
        $countSwitchBreakdown = InvSwitch::where('status', 'BREAKDOWN')->where('site','ADW')->count();
        $countSwitchScrap = InvSwitch::where('status', 'SCRAP')->where('site','ADW')->count();

        // Wirelless
        $countWirellessreadyused = InvWirelless::where('status', 'READY_USED')->where('site','ADW')->count();
        $countWirellessstandby = InvWirelless::where('status', 'READY_STANDBY')->where('site','ADW')->count();
        $countWirellessBreakdown = InvWirelless::where('status', 'BREAKDOWN')->where('site','ADW')->count();
        $countWirellessScrap = InvWirelless::where('status', 'SCRAP')->where('site','ADW')->count();

        // Printer
        $countPrinterreadyused = InvPrinter::where('status', 'READY_USED')->where('site','ADW')->count();
        $countPrinterstandby = InvPrinter::where('status', 'READY_STANDBY')->where('site','ADW')->count();
        $countPrinterBreakdown = InvPrinter::where('status', 'BREAKDOWN')->where('site','ADW')->count();
        $countPrinterScrap = InvPrinter::where('status', 'SCRAP')->where('site','ADW')->count();

        // CCTV
        $countCCTVreadyused = InvCctv::where('status', 'READY_USED')->where('site','ADW')->count();
        $countCCTVstandby = InvCctv::where('status', 'READY_STANDBY')->where('site','ADW')->count();
        $countCCTVBreakdown = InvCctv::where('status', 'BREAKDOWN')->where('site','ADW')->count();
        $countCCTVScrap = InvCctv::where('status', 'SCRAP')->where('site','ADW')->count();

        // Komputer
        $countKomputerreadyused = InvComputer::where('status', 'READY_USED')->where('site','ADW')->count();
        $countKomputerstandby = InvComputer::where('status', 'READY_STANDBY')->where('site','ADW')->count();
        $countKomputerBreakdown = InvComputer::where('status', 'BREAKDOWN')->where('site','ADW')->count();
        $countKomputerScrap = InvComputer::where('status', 'SCRAP')->where('site','ADW')->count();

        // Laptop
        $countLaptopreadyused = InvLaptop::where('status', 'READY_USED')->where('site','ADW')->count();
        $countLaptopstandby = InvLaptop::where('status', 'READY_STANDBY')->where('site','ADW')->count();
        $countLaptopBreakdown = InvLaptop::where('status', 'BREAKDOWN')->where('site','ADW')->count();
        $countLaptopScrap = InvLaptop::where('status', 'SCRAP')->where('site','ADW')->count();

        // AP,SW,BB,PRT,CCTV,KOMP,Laptop

        $breakdown_array = [$countAPBreakdown, $countSwitchBreakdown, $countWirellessBreakdown, $countPrinterBreakdown, $countCCTVBreakdown, $countKomputerBreakdown, $countLaptopBreakdown];

        $scrap_array = [$countAPScrap, $countSwitchScrap, $countWirellessScrap, $countPrinterScrap, $countCCTVScrap, $countKomputerScrap, $countLaptopScrap];

        $readyStandby_array = [$countAPstandby, $countSwitchstandby, $countWirellessstandby, $countPrinterstandby, $countCCTVstandby, $countKomputerstandby, $countLaptopstandby];

        $readyUsed_array = [$countAPreadyused, $countSwitchreadyused, $countWirellessreadyused, $countPrinterreadyused, $countCCTVreadyused, $countKomputerreadyused, $countLaptopreadyused];

        $loginSession =  'tes';

        return Inertia::render(
            'Inventory/SiteWARA/Dashboard',
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
