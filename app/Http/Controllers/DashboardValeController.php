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
            ]
        );
    }
}
