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

class DashboardSbsController extends Controller
{
    public function index()
    {
        $aduan = Aduan::orderBy('date_of_complaint', 'desc')->where('site','SBS')->get();
        $countOpen = Aduan::where('status', 'OPEN')->where('site','SBS')->count();
        $countClosed = Aduan::where('status', 'CLOSED')->where('site','SBS')->count();
        $countProgress = Aduan::where('status', 'PROGRESS')->where('site','SBS')->count();
        $countCancel = Aduan::where('status', 'CANCEL')->where('site','SBS')->count();

        // access point
        $countAPreadyused = InvAp::where('status', 'READY_USED')->where('site','SBS')->count();
        $countAPstandby = InvAp::where('status', 'READY_STANDBY')->where('site','SBS')->count();
        $countAPBreakdown = InvAp::where('status', 'BREAKDOWN')->where('site','SBS')->count();
        $countAPScrap = InvAp::where('status', 'SCRAP')->where('site','SBS')->count();

        // Switch
        $countSwitchreadyused = InvSwitch::where('status', 'READY_USED')->where('site','SBS')->count();
        $countSwitchstandby = InvSwitch::where('status', 'READY_STANDBY')->where('site','SBS')->count();
        $countSwitchBreakdown = InvSwitch::where('status', 'BREAKDOWN')->where('site','SBS')->count();
        $countSwitchScrap = InvSwitch::where('status', 'SCRAP')->where('site','SBS')->count();

        // Wirelless
        $countWirellessreadyused = InvWirelless::where('status', 'READY_USED')->where('site','SBS')->count();
        $countWirellessstandby = InvWirelless::where('status', 'READY_STANDBY')->where('site','SBS')->count();
        $countWirellessBreakdown = InvWirelless::where('status', 'BREAKDOWN')->where('site','SBS')->count();
        $countWirellessScrap = InvWirelless::where('status', 'SCRAP')->where('site','SBS')->count();

        // Printer
        $countPrinterreadyused = InvPrinter::where('status', 'READY_USED')->where('site','SBS')->count();
        $countPrinterstandby = InvPrinter::where('status', 'READY_STANDBY')->where('site','SBS')->count();
        $countPrinterBreakdown = InvPrinter::where('status', 'BREAKDOWN')->where('site','SBS')->count();
        $countPrinterScrap = InvPrinter::where('status', 'SCRAP')->where('site','SBS')->count();

        // CCTV
        $countCCTVreadyused = InvCctv::where('status', 'READY_USED')->where('site','SBS')->count();
        $countCCTVstandby = InvCctv::where('status', 'READY_STANDBY')->where('site','SBS')->count();
        $countCCTVBreakdown = InvCctv::where('status', 'BREAKDOWN')->where('site','SBS')->count();
        $countCCTVScrap = InvCctv::where('status', 'SCRAP')->where('site','SBS')->count();

        // Komputer
        $countKomputerreadyused = InvComputer::where('status', 'READY_USED')->where('site','SBS')->count();
        $countKomputerstandby = InvComputer::where('status', 'READY_STANDBY')->where('site','SBS')->count();
        $countKomputerBreakdown = InvComputer::where('status', 'BREAKDOWN')->where('site','SBS')->count();
        $countKomputerScrap = InvComputer::where('status', 'SCRAP')->where('site','SBS')->count();

        // Laptop
        $countLaptopreadyused = InvLaptop::where('status', 'READY_USED')->where('site','SBS')->count();
        $countLaptopstandby = InvLaptop::where('status', 'READY_STANDBY')->where('site','SBS')->count();
        $countLaptopBreakdown = InvLaptop::where('status', 'BREAKDOWN')->where('site','SBS')->count();
        $countLaptopScrap = InvLaptop::where('status', 'SCRAP')->where('site','SBS')->count();

        // AP,SW,BB,PRT,CCTV,KOMP,Laptop

        $breakdown_array = [$countAPBreakdown, $countSwitchBreakdown, $countWirellessBreakdown, $countPrinterBreakdown, $countCCTVBreakdown, $countKomputerBreakdown, $countLaptopBreakdown];

        $scrap_array = [$countAPScrap, $countSwitchScrap, $countWirellessScrap, $countPrinterScrap, $countCCTVScrap, $countKomputerScrap, $countLaptopScrap];

        $readyStandby_array = [$countAPstandby, $countSwitchstandby, $countWirellessstandby, $countPrinterstandby, $countCCTVstandby, $countKomputerstandby, $countLaptopstandby];

        $readyUsed_array = [$countAPreadyused, $countSwitchreadyused, $countWirellessreadyused, $countPrinterreadyused, $countCCTVreadyused, $countKomputerreadyused, $countLaptopreadyused];

        $loginSession =  'tes';

        return Inertia::render(
            'Inventory/SiteSbs/Dashboard',
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
