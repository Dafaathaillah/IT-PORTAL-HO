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
            ]
        );
    }
}
