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

class DashboardMifaController extends Controller
{
    public function index()
    {
        $aduan = Aduan::orderBy('date_of_complaint', 'desc')->where('site','MIFA')->get();
        $countOpen = Aduan::where('status', 'OPEN')->where('site','MIFA')->count();
        $countClosed = Aduan::where('status', 'CLOSED')->where('site','MIFA')->count();
        $countProgress = Aduan::where('status', 'PROGRESS')->where('site','MIFA')->count();
        $countCancel = Aduan::where('status', 'CANCEL')->where('site','MIFA')->count();

        // access point
        $countAPreadyused = InvAp::where('status', 'READY_USED')->where('site','MIFA')->count();
        $countAPstandby = InvAp::where('status', 'READY_STANDBY')->where('site','MIFA')->count();
        $countAPBreakdown = InvAp::where('status', 'BREAKDOWN')->where('site','MIFA')->count();
        $countAPScrap = InvAp::where('status', 'SCRAP')->where('site','MIFA')->count();

        // Switch
        $countSwitchreadyused = InvSwitch::where('status', 'READY_USED')->where('site','MIFA')->count();
        $countSwitchstandby = InvSwitch::where('status', 'READY_STANDBY')->where('site','MIFA')->count();
        $countSwitchBreakdown = InvSwitch::where('status', 'BREAKDOWN')->where('site','MIFA')->count();
        $countSwitchScrap = InvSwitch::where('status', 'SCRAP')->where('site','MIFA')->count();

        // Wirelless
        $countWirellessreadyused = InvWirelless::where('status', 'READY_USED')->where('site','MIFA')->count();
        $countWirellessstandby = InvWirelless::where('status', 'READY_STANDBY')->where('site','MIFA')->count();
        $countWirellessBreakdown = InvWirelless::where('status', 'BREAKDOWN')->where('site','MIFA')->count();
        $countWirellessScrap = InvWirelless::where('status', 'SCRAP')->where('site','MIFA')->count();

        // Printer
        $countPrinterreadyused = InvPrinter::where('status', 'READY_USED')->where('site','MIFA')->count();
        $countPrinterstandby = InvPrinter::where('status', 'READY_STANDBY')->where('site','MIFA')->count();
        $countPrinterBreakdown = InvPrinter::where('status', 'BREAKDOWN')->where('site','MIFA')->count();
        $countPrinterScrap = InvPrinter::where('status', 'SCRAP')->where('site','MIFA')->count();

        // CCTV
        $countCCTVreadyused = InvCctv::where('status', 'READY_USED')->where('site','MIFA')->count();
        $countCCTVstandby = InvCctv::where('status', 'READY_STANDBY')->where('site','MIFA')->count();
        $countCCTVBreakdown = InvCctv::where('status', 'BREAKDOWN')->where('site','MIFA')->count();
        $countCCTVScrap = InvCctv::where('status', 'SCRAP')->where('site','MIFA')->count();

        // Komputer
        $countKomputerreadyused = InvComputer::where('status', 'READY_USED')->where('site','MIFA')->count();
        $countKomputerstandby = InvComputer::where('status', 'READY_STANDBY')->where('site','MIFA')->count();
        $countKomputerBreakdown = InvComputer::where('status', 'BREAKDOWN')->where('site','MIFA')->count();
        $countKomputerScrap = InvComputer::where('status', 'SCRAP')->where('site','MIFA')->count();

        // Laptop
        $countLaptopreadyused = InvLaptop::where('status', 'READY_USED')->where('site','MIFA')->count();
        $countLaptopstandby = InvLaptop::where('status', 'READY_STANDBY')->where('site','MIFA')->count();
        $countLaptopBreakdown = InvLaptop::where('status', 'BREAKDOWN')->where('site','MIFA')->count();
        $countLaptopScrap = InvLaptop::where('status', 'SCRAP')->where('site','MIFA')->count();

        // AP,SW,BB,PRT,CCTV,KOMP,Laptop

        $breakdown_array = [$countAPBreakdown, $countSwitchBreakdown, $countWirellessBreakdown, $countPrinterBreakdown, $countCCTVBreakdown, $countKomputerBreakdown, $countLaptopBreakdown];

        $scrap_array = [$countAPScrap, $countSwitchScrap, $countWirellessScrap, $countPrinterScrap, $countCCTVScrap, $countKomputerScrap, $countLaptopScrap];

        $readyStandby_array = [$countAPstandby, $countSwitchstandby, $countWirellessstandby, $countPrinterstandby, $countCCTVstandby, $countKomputerstandby, $countLaptopstandby];

        $readyUsed_array = [$countAPreadyused, $countSwitchreadyused, $countWirellessreadyused, $countPrinterreadyused, $countCCTVreadyused, $countKomputerreadyused, $countLaptopreadyused];

        $loginSession =  'tes';

        return Inertia::render(
            'Inventory/SiteMifa/Dashboard',
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
