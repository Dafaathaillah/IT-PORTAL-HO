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

class DashboardSksController extends Controller
{
    public function index()
    {
        $aduan = Aduan::orderBy('date_of_complaint', 'desc')->where('site','SKS')->get();
        $countOpen = Aduan::where('status', 'OPEN')->where('site','SKS')->count();
        $countClosed = Aduan::where('status', 'CLOSED')->where('site','SKS')->count();
        $countProgress = Aduan::where('status', 'PROGRESS')->where('site','SKS')->count();
        $countCancel = Aduan::where('status', 'CANCEL')->where('site','SKS')->count();

        // access point
        $countAPreadyused = InvAp::where('status', 'READY_USED')->where('site','SKS')->count();
        $countAPstandby = InvAp::where('status', 'READY_STANDBY')->where('site','SKS')->count();
        $countAPBreakdown = InvAp::where('status', 'BREAKDOWN')->where('site','SKS')->count();
        $countAPScrap = InvAp::where('status', 'SCRAP')->where('site','SKS')->count();

        // Switch
        $countSwitchreadyused = InvSwitch::where('status', 'READY_USED')->where('site','SKS')->count();
        $countSwitchstandby = InvSwitch::where('status', 'READY_STANDBY')->where('site','SKS')->count();
        $countSwitchBreakdown = InvSwitch::where('status', 'BREAKDOWN')->where('site','SKS')->count();
        $countSwitchScrap = InvSwitch::where('status', 'SCRAP')->where('site','SKS')->count();

        // Wirelless
        $countWirellessreadyused = InvWirelless::where('status', 'READY_USED')->where('site','SKS')->count();
        $countWirellessstandby = InvWirelless::where('status', 'READY_STANDBY')->where('site','SKS')->count();
        $countWirellessBreakdown = InvWirelless::where('status', 'BREAKDOWN')->where('site','SKS')->count();
        $countWirellessScrap = InvWirelless::where('status', 'SCRAP')->where('site','SKS')->count();

        // Printer
        $countPrinterreadyused = InvPrinter::where('status', 'READY_USED')->where('site','SKS')->count();
        $countPrinterstandby = InvPrinter::where('status', 'READY_STANDBY')->where('site','SKS')->count();
        $countPrinterBreakdown = InvPrinter::where('status', 'BREAKDOWN')->where('site','SKS')->count();
        $countPrinterScrap = InvPrinter::where('status', 'SCRAP')->where('site','SKS')->count();

        // CCTV
        $countCCTVreadyused = InvCctv::where('status', 'READY_USED')->where('site','SKS')->count();
        $countCCTVstandby = InvCctv::where('status', 'READY_STANDBY')->where('site','SKS')->count();
        $countCCTVBreakdown = InvCctv::where('status', 'BREAKDOWN')->where('site','SKS')->count();
        $countCCTVScrap = InvCctv::where('status', 'SCRAP')->where('site','SKS')->count();

        // Komputer
        $countKomputerreadyused = InvComputer::where('status', 'READY_USED')->where('site','SKS')->count();
        $countKomputerstandby = InvComputer::where('status', 'READY_STANDBY')->where('site','SKS')->count();
        $countKomputerBreakdown = InvComputer::where('status', 'BREAKDOWN')->where('site','SKS')->count();
        $countKomputerScrap = InvComputer::where('status', 'SCRAP')->where('site','SKS')->count();

        // Laptop
        $countLaptopreadyused = InvLaptop::where('status', 'READY_USED')->where('site','SKS')->count();
        $countLaptopstandby = InvLaptop::where('status', 'READY_STANDBY')->where('site','SKS')->count();
        $countLaptopBreakdown = InvLaptop::where('status', 'BREAKDOWN')->where('site','SKS')->count();
        $countLaptopScrap = InvLaptop::where('status', 'SCRAP')->where('site','SKS')->count();

        // AP,SW,BB,PRT,CCTV,KOMP,Laptop

        $breakdown_array = [$countAPBreakdown, $countSwitchBreakdown, $countWirellessBreakdown, $countPrinterBreakdown, $countCCTVBreakdown, $countKomputerBreakdown, $countLaptopBreakdown];

        $scrap_array = [$countAPScrap, $countSwitchScrap, $countWirellessScrap, $countPrinterScrap, $countCCTVScrap, $countKomputerScrap, $countLaptopScrap];

        $readyStandby_array = [$countAPstandby, $countSwitchstandby, $countWirellessstandby, $countPrinterstandby, $countCCTVstandby, $countKomputerstandby, $countLaptopstandby];

        $readyUsed_array = [$countAPreadyused, $countSwitchreadyused, $countWirellessreadyused, $countPrinterreadyused, $countCCTVreadyused, $countKomputerreadyused, $countLaptopreadyused];

        $loginSession =  'tes';

        return Inertia::render(
            'Inventory/SiteSks/Dashboard',
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
