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

class DashboardBgeController extends Controller
{
    public function index()
    {
        $aduan = Aduan::orderBy('date_of_complaint', 'desc')->where('site','BGE')->get();
        $countOpen = Aduan::where('status', 'OPEN')->where('site','BGE')->count();
        $countClosed = Aduan::where('status', 'CLOSED')->where('site','BGE')->count();
        $countProgress = Aduan::where('status', 'PROGRESS')->where('site','BGE')->count();
        $countCancel = Aduan::where('status', 'CANCEL')->where('site','BGE')->count();

        // access point
        $countAPreadyused = InvAp::where('status', 'READY_USED')->where('site','BGE')->count();
        $countAPstandby = InvAp::where('status', 'READY_STANDBY')->where('site','BGE')->count();
        $countAPBreakdown = InvAp::where('status', 'BREAKDOWN')->where('site','BGE')->count();
        $countAPScrap = InvAp::where('status', 'SCRAP')->where('site','BGE')->count();

        // Switch
        $countSwitchreadyused = InvSwitch::where('status', 'READY_USED')->where('site','BGE')->count();
        $countSwitchstandby = InvSwitch::where('status', 'READY_STANDBY')->where('site','BGE')->count();
        $countSwitchBreakdown = InvSwitch::where('status', 'BREAKDOWN')->where('site','BGE')->count();
        $countSwitchScrap = InvSwitch::where('status', 'SCRAP')->where('site','BGE')->count();

        // Wirelless
        $countWirellessreadyused = InvWirelless::where('status', 'READY_USED')->where('site','BGE')->count();
        $countWirellessstandby = InvWirelless::where('status', 'READY_STANDBY')->where('site','BGE')->count();
        $countWirellessBreakdown = InvWirelless::where('status', 'BREAKDOWN')->where('site','BGE')->count();
        $countWirellessScrap = InvWirelless::where('status', 'SCRAP')->where('site','BGE')->count();

        // Printer
        $countPrinterreadyused = InvPrinter::where('status', 'READY_USED')->where('site','BGE')->count();
        $countPrinterstandby = InvPrinter::where('status', 'READY_STANDBY')->where('site','BGE')->count();
        $countPrinterBreakdown = InvPrinter::where('status', 'BREAKDOWN')->where('site','BGE')->count();
        $countPrinterScrap = InvPrinter::where('status', 'SCRAP')->where('site','BGE')->count();

        // CCTV
        $countCCTVreadyused = InvCctv::where('status', 'READY_USED')->where('site','BGE')->count();
        $countCCTVstandby = InvCctv::where('status', 'READY_STANDBY')->where('site','BGE')->count();
        $countCCTVBreakdown = InvCctv::where('status', 'BREAKDOWN')->where('site','BGE')->count();
        $countCCTVScrap = InvCctv::where('status', 'SCRAP')->where('site','BGE')->count();

        // Komputer
        $countKomputerreadyused = InvComputer::where('status', 'READY_USED')->where('site','BGE')->count();
        $countKomputerstandby = InvComputer::where('status', 'READY_STANDBY')->where('site','BGE')->count();
        $countKomputerBreakdown = InvComputer::where('status', 'BREAKDOWN')->where('site','BGE')->count();
        $countKomputerScrap = InvComputer::where('status', 'SCRAP')->where('site','BGE')->count();

        // Laptop
        $countLaptopreadyused = InvLaptop::where('status', 'READY_USED')->where('site','BGE')->count();
        $countLaptopstandby = InvLaptop::where('status', 'READY_STANDBY')->where('site','BGE')->count();
        $countLaptopBreakdown = InvLaptop::where('status', 'BREAKDOWN')->where('site','BGE')->count();
        $countLaptopScrap = InvLaptop::where('status', 'SCRAP')->where('site','BGE')->count();

        // AP,SW,BB,PRT,CCTV,KOMP,Laptop

        $breakdown_array = [$countAPBreakdown, $countSwitchBreakdown, $countWirellessBreakdown, $countPrinterBreakdown, $countCCTVBreakdown, $countKomputerBreakdown, $countLaptopBreakdown];

        $scrap_array = [$countAPScrap, $countSwitchScrap, $countWirellessScrap, $countPrinterScrap, $countCCTVScrap, $countKomputerScrap, $countLaptopScrap];

        $readyStandby_array = [$countAPstandby, $countSwitchstandby, $countWirellessstandby, $countPrinterstandby, $countCCTVstandby, $countKomputerstandby, $countLaptopstandby];

        $readyUsed_array = [$countAPreadyused, $countSwitchreadyused, $countWirellessreadyused, $countPrinterreadyused, $countCCTVreadyused, $countKomputerreadyused, $countLaptopreadyused];

        $loginSession =  'tes';

        return Inertia::render(
            'Inventory/SiteBge/Dashboard',
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
