<?php

use App\Http\Controllers\AdminPengajuanRoleBaController;
use App\Http\Controllers\AdminPengajuanRoleController;
use App\Http\Controllers\AdminPengajuanRoleMifaController;
use App\Http\Controllers\AduanAmiController;
use App\Http\Controllers\AduanBaController;
use App\Http\Controllers\AduanBgeController;
use App\Http\Controllers\AduanBibController;
use App\Http\Controllers\AduanController;
use App\Http\Controllers\AduanHoController;
use App\Http\Controllers\AduanIptController;
use App\Http\Controllers\AduanMhuController;
use App\Http\Controllers\AduanMifaController;
use App\Http\Controllers\AduanMipController;
use App\Http\Controllers\AduanMlpController;
use App\Http\Controllers\AduanPikController;
use App\Http\Controllers\AduanRcbinController;
use App\Http\Controllers\AduanSbsController;
use App\Http\Controllers\AduanSksController;
use App\Http\Controllers\AduanValeController;
use App\Http\Controllers\AduanWARAController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAmiController;
use App\Http\Controllers\DashboardBaController;
use App\Http\Controllers\DashboardBgeController;
use App\Http\Controllers\DashboardBibController;
use App\Http\Controllers\DashboardIptController;
use App\Http\Controllers\DashboardMhuController;
use App\Http\Controllers\DashboardMifaController;
use App\Http\Controllers\DashboardMipController;
use App\Http\Controllers\DashboardMlpController;
use App\Http\Controllers\DashboardPikController;
use App\Http\Controllers\DashboardSbsController;
use App\Http\Controllers\DashboardSksController;
use App\Http\Controllers\DashboardValeController;
use App\Http\Controllers\DashboardWaraController;
use App\Http\Controllers\DataCheckerController;
use App\Http\Controllers\DepartmentBaController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentMifaController;
use App\Http\Controllers\ExportInspeksiLaptopController;
use App\Http\Controllers\GuestAllController;
use App\Http\Controllers\GuestReportController;
use App\Http\Controllers\InspeksiComputerAmiController;
use App\Http\Controllers\InspeksiComputerBaController;
use App\Http\Controllers\InspeksiComputerBgeController;
use App\Http\Controllers\InspeksiComputerBibController;
use App\Http\Controllers\InspeksiComputerWARAController;
use App\Http\Controllers\InspeksiComputerController;
use App\Http\Controllers\InspeksiComputerIptController;
use App\Http\Controllers\InspeksiComputerMhuController;
use App\Http\Controllers\InspeksiComputerMifaController;
use App\Http\Controllers\InspeksiComputerMipController;
use App\Http\Controllers\InspeksiComputerMlpController;
use App\Http\Controllers\InspeksiComputerPikController;
use App\Http\Controllers\InspeksiComputerSbsController;
use App\Http\Controllers\InspeksiComputerSksController;
use App\Http\Controllers\InspeksiComputerValeController;
use App\Http\Controllers\InspeksiLaptopAmiController;
use App\Http\Controllers\InspeksiLaptopBaController;
use App\Http\Controllers\InspeksiLaptopBgeController;
use App\Http\Controllers\InspeksiLaptopBibController;
use App\Http\Controllers\InspeksiLaptopWARAController;
use App\Http\Controllers\InspeksiLaptopController;
use App\Http\Controllers\InspeksiLaptopIptController;
use App\Http\Controllers\InspeksiLaptopMhuController;
use App\Http\Controllers\InspeksiLaptopMifaController;
use App\Http\Controllers\InspeksiLaptopMipController;
use App\Http\Controllers\InspeksiLaptopMlpController;
use App\Http\Controllers\InspeksiLaptopPikController;
use App\Http\Controllers\InspeksiLaptopSbsController;
use App\Http\Controllers\InspeksiLaptopSksController;
use App\Http\Controllers\InspeksiLaptopValeController;
use App\Http\Controllers\InvApAmiController;
use App\Http\Controllers\InvApBaController;
use App\Http\Controllers\InvApBgeController;
use App\Http\Controllers\InvApBibController;
use App\Http\Controllers\InvApWARAController;
use App\Http\Controllers\InvApController;
use App\Http\Controllers\InvApIptController;
use App\Http\Controllers\InvApMhuController;
use App\Http\Controllers\InvApMifaController;
use App\Http\Controllers\InvApMipController;
use App\Http\Controllers\InvApMlpController;
use App\Http\Controllers\InvApPikController;
use App\Http\Controllers\InvApRcbinController;
use App\Http\Controllers\InvApSbsController;
use App\Http\Controllers\InvApSksController;
use App\Http\Controllers\InvApValeController;
use App\Http\Controllers\InvCctvAmiController;
use App\Http\Controllers\InvCctvBaController;
use App\Http\Controllers\InvCctvBgeController;
use App\Http\Controllers\InvCctvBibController;
use App\Http\Controllers\InvCctvWARAController;
use App\Http\Controllers\InvCctvController;
use App\Http\Controllers\InvCctvIptController;
use App\Http\Controllers\InvCctvMhuController;
use App\Http\Controllers\InvCctvMifaController;
use App\Http\Controllers\InvCctvMipController;
use App\Http\Controllers\InvCctvMlpController;
use App\Http\Controllers\InvCctvPikController;
use App\Http\Controllers\InvCctvRcBinController;
use App\Http\Controllers\InvCctvSbsController;
use App\Http\Controllers\InvCctvSksController;
use App\Http\Controllers\InvCctvValeController;
use App\Http\Controllers\InvComputerAmiController;
use App\Http\Controllers\InvComputerBaController;
use App\Http\Controllers\InvComputerBgeController;
use App\Http\Controllers\InvComputerBibController;
use App\Http\Controllers\InvComputerWARAController;
use App\Http\Controllers\InvComputerController;
use App\Http\Controllers\InvComputerIptController;
use App\Http\Controllers\InvComputerMhuController;
use App\Http\Controllers\InvComputerMifaController;
use App\Http\Controllers\InvComputerMipController;
use App\Http\Controllers\InvComputerMlpController;
use App\Http\Controllers\InvComputerPikController;
use App\Http\Controllers\InvComputerRcBinController;
use App\Http\Controllers\InvComputerSbsController;
use App\Http\Controllers\InvComputerSksController;
use App\Http\Controllers\InvComputerValeController;
use App\Http\Controllers\InvLaptopAmiController;
use App\Http\Controllers\InvLaptopBaController;
use App\Http\Controllers\InvLaptopBgeController;
use App\Http\Controllers\InvLaptopBibController;
use App\Http\Controllers\InvLaptopWARAController;
use App\Http\Controllers\InvLaptopController;
use App\Http\Controllers\InvLaptopIptController;
use App\Http\Controllers\InvLaptopMhuController;
use App\Http\Controllers\InvLaptopMifaController;
use App\Http\Controllers\InvLaptopMipController;
use App\Http\Controllers\InvLaptopMlpController;
use App\Http\Controllers\InvLaptopPikController;
use App\Http\Controllers\InvLaptopRcBinController;
use App\Http\Controllers\InvLaptopReUtilizeController;
use App\Http\Controllers\InvLaptopSbsController;
use App\Http\Controllers\InvLaptopSksController;
use App\Http\Controllers\InvLaptopValeController;
use App\Http\Controllers\InvPrinterAmiController;
use App\Http\Controllers\InvPrinterBaController;
use App\Http\Controllers\InvPrinterBgeController;
use App\Http\Controllers\InvPrinterBibController;
use App\Http\Controllers\InvPrinterWARAController;
use App\Http\Controllers\InvPrinterController;
use App\Http\Controllers\InvPrinterIptController;
use App\Http\Controllers\InvPrinterMhuController;
use App\Http\Controllers\InvPrinterMifaController;
use App\Http\Controllers\InvPrinterMipController;
use App\Http\Controllers\InvPrinterMlpController;
use App\Http\Controllers\InvPrinterPikController;
use App\Http\Controllers\InvPrinterRcBinController;
use App\Http\Controllers\InvPrinterSbsController;
use App\Http\Controllers\InvPrinterSksController;
use App\Http\Controllers\InvPrinterValeController;
use App\Http\Controllers\InvScannerAmiController;
use App\Http\Controllers\InvScannerBaController;
use App\Http\Controllers\InvScannerBgeController;
use App\Http\Controllers\InvScannerBibController;
use App\Http\Controllers\InvScannerWARAController;
use App\Http\Controllers\InvScannerController;
use App\Http\Controllers\InvScannerIptController;
use App\Http\Controllers\InvScannerMhuController;
use App\Http\Controllers\InvScannerMifaController;
use App\Http\Controllers\InvScannerMipController;
use App\Http\Controllers\InvScannerMlpController;
use App\Http\Controllers\InvScannerPikController;
use App\Http\Controllers\InvScannerRcBinController;
use App\Http\Controllers\InvScannerSbsController;
use App\Http\Controllers\InvScannerSksController;
use App\Http\Controllers\InvScannerValeController;
use App\Http\Controllers\InvSwitchAmiController;
use App\Http\Controllers\InvSwitchController;
use App\Http\Controllers\InvSwitchBaController;
use App\Http\Controllers\InvSwitchBgeController;
use App\Http\Controllers\InvSwitchBibController;
use App\Http\Controllers\InvSwitchIptController;
use App\Http\Controllers\InvSwitchWARAController;
use App\Http\Controllers\InvSwitchMhuController;
use App\Http\Controllers\InvSwitchMifaController;
use App\Http\Controllers\InvSwitchMipController;
use App\Http\Controllers\InvSwitchMlpController;
use App\Http\Controllers\InvSwitchPikController;
use App\Http\Controllers\InvSwitchRcbinController;
use App\Http\Controllers\InvSwitchSbsController;
use App\Http\Controllers\InvSwitchSksController;
use App\Http\Controllers\InvSwitchValeController;
use App\Http\Controllers\InvWirellessAmiController;
use App\Http\Controllers\InvWirellessBaController;
use App\Http\Controllers\InvWirellessBgeController;
use App\Http\Controllers\InvWirellessBibController;
use App\Http\Controllers\InvWirellessWARAController;
use App\Http\Controllers\InvWirellessController;
use App\Http\Controllers\InvWirellessIptController;
use App\Http\Controllers\InvWirellessMhuController;
use App\Http\Controllers\InvWirellessMifaController;
use App\Http\Controllers\InvWirellessMipController;
use App\Http\Controllers\InvWirellessMlpController;
use App\Http\Controllers\InvWirellessPikController;
use App\Http\Controllers\InvWirellessRcbinController;
use App\Http\Controllers\InvWirellessSbsController;
use App\Http\Controllers\InvWirellessSksController;
use App\Http\Controllers\InvWirellessValeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestingAuthApiController;
use App\Http\Controllers\UserAllBaController;
use App\Http\Controllers\UserAllController;
use App\Http\Controllers\UserAllMhuController;
use App\Http\Controllers\UserAllMifaController;
use App\Http\Controllers\UserAllRcBinController;
use App\Http\Controllers\UserController;
use App\Models\Aduan;
use App\Models\InvAp;
use App\Models\InvCctv;
use App\Models\InvComputer;
use App\Models\InvLaptop;
use App\Models\InvPrinter;
use App\Models\InvSwitch;
use App\Models\InvWirelless;
use App\Models\UserAll;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;


// Route::get('/phpinfo', function () {
//     phpinfo();
// });

Route::middleware('auth')->group(function () {
    Route::group(['middleware' => 'checkRole:ict_developer:BIB'], function () {
        Route::get('/cekSn', [DataCheckerController::class, 'checkDuplicateSN']);
        Route::get('/cekNrp', [DataCheckerController::class, 'checkMissingNRP']);
    });
    // Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_bo:HO,ict_ho:HO,soc_ho:HO,ict_technician:BA,ict_group_leader:BA,ict_admin:BA,ict_technician:MIFA,ict_group_leader:MIFA,ict_admin:MIFA,ict_group_leader:MIFA'], function () {
        Route::post('/encrypt-year', function (Request $request) {
            $year = $request->year ?? Carbon::now()->year;
            $encryptedYear = Crypt::encryptString($year);
            return Inertia::location(route('export.inspectionLaptop', ['year' => $encryptedYear]));
        })->name('encrypt.year');
        Route::get('/export-pdf', [ExportInspeksiLaptopController::class, 'exportPdf'])->name('export.inspectionLaptop');
    // });

    Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_ho:HO,ict_bod:HO,soc_ho:HO'], function () {
        Route::get('/dashboard', function () {

            $aduan = Aduan::orderBy('date_of_complaint', 'desc')->where('site', auth()->user()->site)->get();
            $countOpen = Aduan::where('status', 'OPEN')->where('site', auth()->user()->site)->count();
            $countClosed = Aduan::where('status', 'CLOSED')->where('site', auth()->user()->site)->count();
            $countProgress = Aduan::where('status', 'PROGRESS')->where('site', auth()->user()->site)->count();
            $countCancel = Aduan::where('status', 'CANCEL')->where('site', auth()->user()->site)->count();

            // access point
            $countAPreadyused = InvAp::where('status', 'READY_USED')->count();
            $countAPstandby = InvAp::where('status', 'READY_STANDBY')->count();
            $countAPBreakdown = InvAp::where('status', 'BREAKDOWN')->count();
            $countAPScrap = InvAp::where('status', 'SCRAP')->count();

            // Switch
            $countSwitchreadyused = InvSwitch::where('status', 'READY_USED')->count();
            $countSwitchstandby = InvSwitch::where('status', 'READY_STANDBY')->count();
            $countSwitchBreakdown = InvSwitch::where('status', 'BREAKDOWN')->count();
            $countSwitchScrap = InvSwitch::where('status', 'SCRAP')->count();

            // Wirelless
            $countWirellessreadyused = InvWirelless::where('status', 'READY_USED')->count();
            $countWirellessstandby = InvWirelless::where('status', 'READY_STANDBY')->count();
            $countWirellessBreakdown = InvWirelless::where('status', 'BREAKDOWN')->count();
            $countWirellessScrap = InvWirelless::where('status', 'SCRAP')->count();

            // Printer
            $countPrinterreadyused = InvPrinter::where('status', 'READY_USED')->count();
            $countPrinterstandby = InvPrinter::where('status', 'READY_STANDBY')->count();
            $countPrinterBreakdown = InvPrinter::where('status', 'BREAKDOWN')->count();
            $countPrinterScrap = InvPrinter::where('status', 'SCRAP')->count();

            // CCTV
            $countCCTVreadyused = InvCctv::where('status', 'READY_USED')->count();
            $countCCTVstandby = InvCctv::where('status', 'READY_STANDBY')->count();
            $countCCTVBreakdown = InvCctv::where('status', 'BREAKDOWN')->count();
            $countCCTVScrap = InvCctv::where('status', 'SCRAP')->count();

            // Komputer
            $countKomputerreadyused = InvComputer::where('status', 'READY_USED')->count();
            $countKomputerstandby = InvComputer::where('status', 'READY_STANDBY')->count();
            $countKomputerBreakdown = InvComputer::where('status', 'BREAKDOWN')->count();
            $countKomputerScrap = InvComputer::where('status', 'SCRAP')->count();

            // Laptop
            $countLaptopreadyused = InvLaptop::where('status', 'READY_USED')->count();
            $countLaptopstandby = InvLaptop::where('status', 'READY_STANDBY')->count();
            $countLaptopBreakdown = InvLaptop::where('status', 'BREAKDOWN')->count();
            $countLaptopScrap = InvLaptop::where('status', 'SCRAP')->count();

            // AP,SW,BB,PRT,CCTV,KOMP,Laptop

            $breakdown_array = [$countAPBreakdown, $countSwitchBreakdown, $countWirellessBreakdown, $countPrinterBreakdown, $countCCTVBreakdown, $countKomputerBreakdown, $countLaptopBreakdown];

            $scrap_array = [$countAPScrap, $countSwitchScrap, $countWirellessScrap, $countPrinterScrap, $countCCTVScrap, $countKomputerScrap, $countLaptopScrap];

            $readyStandby_array = [$countAPstandby, $countSwitchstandby, $countWirellessstandby, $countPrinterstandby, $countCCTVstandby, $countKomputerstandby, $countLaptopstandby];

            $readyUsed_array = [$countAPreadyused, $countSwitchreadyused, $countWirellessreadyused, $countPrinterreadyused, $countCCTVreadyused, $countKomputerreadyused, $countLaptopreadyused];

            $loginSession =  'tes';

            return Inertia::render(
                'Inventory/Dashboard',
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
        })->name('developerDashboard');
    });

    Route::group(['middleware' => 'checkRole:ict_group_leader:BIB,ict_group_leader:ADW,ict_group_leader:BA,ict_group_leader:MIFA,ict_group_leader:MHU,ict_group_leader:AMI,ict_group_leader:PIK,ict_group_leader:IPT,ict_group_leader:MLP,ict_group_leader:MIP,ict_group_leader:VIB,ict_group_leader:SBS,ict_group_leader:BGE'], function () {
        Route::get('/groupLeaderDashboard', function () {
            $aduan = Aduan::orderBy('date_of_complaint', 'desc')->where('site', auth()->user()->site)->get();
            $countOpen = Aduan::where('status', 'OPEN')->where('site', auth()->user()->site)->count();
            $countClosed = Aduan::where('status', 'CLOSED')->where('site', auth()->user()->site)->count();
            $countProgress = Aduan::where('status', 'PROGRESS')->where('site', auth()->user()->site)->count();
            $countCancel = Aduan::where('status', 'CANCEL')->where('site', auth()->user()->site)->count();

            // access point
            $countAPreadyused = InvAp::where('status', 'READY_USED')->where('site', auth()->user()->site)->count();
            $countAPstandby = InvAp::where('status', 'READY_STANDBY')->where('site', auth()->user()->site)->count();
            $countAPBreakdown = InvAp::where('status', 'BREAKDOWN')->where('site', auth()->user()->site)->count();
            $countAPScrap = InvAp::where('status', 'SCRAP')->where('site', auth()->user()->site)->count();

            // Switch
            $countSwitchreadyused = InvSwitch::where('status', 'READY_USED')->where('site', auth()->user()->site)->count();
            $countSwitchstandby = InvSwitch::where('status', 'READY_STANDBY')->where('site', auth()->user()->site)->count();
            $countSwitchBreakdown = InvSwitch::where('status', 'BREAKDOWN')->where('site', auth()->user()->site)->count();
            $countSwitchScrap = InvSwitch::where('status', 'SCRAP')->where('site', auth()->user()->site)->count();

            // Wirelless
            $countWirellessreadyused = InvWirelless::where('status', 'READY_USED')->where('site', auth()->user()->site)->count();
            $countWirellessstandby = InvWirelless::where('status', 'READY_STANDBY')->where('site', auth()->user()->site)->count();
            $countWirellessBreakdown = InvWirelless::where('status', 'BREAKDOWN')->where('site', auth()->user()->site)->count();
            $countWirellessScrap = InvWirelless::where('status', 'SCRAP')->where('site', auth()->user()->site)->count();

            // Printer
            $countPrinterreadyused = InvPrinter::where('status', 'READY_USED')->where('site', auth()->user()->site)->count();
            $countPrinterstandby = InvPrinter::where('status', 'READY_STANDBY')->where('site', auth()->user()->site)->count();
            $countPrinterBreakdown = InvPrinter::where('status', 'BREAKDOWN')->where('site', auth()->user()->site)->count();
            $countPrinterScrap = InvPrinter::where('status', 'SCRAP')->where('site', auth()->user()->site)->count();

            // CCTV
            $countCCTVreadyused = InvCctv::where('status', 'READY_USED')->where('site', auth()->user()->site)->count();
            $countCCTVstandby = InvCctv::where('status', 'READY_STANDBY')->where('site', auth()->user()->site)->count();
            $countCCTVBreakdown = InvCctv::where('status', 'BREAKDOWN')->where('site', auth()->user()->site)->count();
            $countCCTVScrap = InvCctv::where('status', 'SCRAP')->where('site', auth()->user()->site)->count();

            // Komputer
            $countKomputerreadyused = InvComputer::where('status', 'READY_USED')->where('site', auth()->user()->site)->count();
            $countKomputerstandby = InvComputer::where('status', 'READY_STANDBY')->where('site', auth()->user()->site)->count();
            $countKomputerBreakdown = InvComputer::where('status', 'BREAKDOWN')->where('site', auth()->user()->site)->count();
            $countKomputerScrap = InvComputer::where('status', 'SCRAP')->where('site', auth()->user()->site)->count();

            // Laptop
            $countLaptopreadyused = InvLaptop::where('status', 'READY_USED')->where('site', auth()->user()->site)->count();
            $countLaptopstandby = InvLaptop::where('status', 'READY_STANDBY')->where('site', auth()->user()->site)->count();
            $countLaptopBreakdown = InvLaptop::where('status', 'BREAKDOWN')->where('site', auth()->user()->site)->count();
            $countLaptopScrap = InvLaptop::where('status', 'SCRAP')->where('site', auth()->user()->site)->count();

            // AP,SW,BB,PRT,CCTV,KOMP,Laptop

            $breakdown_array = [$countAPBreakdown, $countSwitchBreakdown, $countWirellessBreakdown, $countPrinterBreakdown, $countCCTVBreakdown, $countKomputerBreakdown, $countLaptopBreakdown];

            $scrap_array = [$countAPScrap, $countSwitchScrap, $countWirellessScrap, $countPrinterScrap, $countCCTVScrap, $countKomputerScrap, $countLaptopScrap];

            $readyStandby_array = [$countAPstandby, $countSwitchstandby, $countWirellessstandby, $countPrinterstandby, $countCCTVstandby, $countKomputerstandby, $countLaptopstandby];

            $readyUsed_array = [$countAPreadyused, $countSwitchreadyused, $countWirellessreadyused, $countPrinterreadyused, $countCCTVreadyused, $countKomputerreadyused, $countLaptopreadyused];

            $loginSession =  'tes';

            return Inertia::render(
                'Inventory/DashboardGroupLeader',
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
        })->name('groupLeaderDashboard');

        Route::get('/aduan-ho', [AduanHoController::class, 'index'])->name('aduan-ho.page');
        Route::get('/aduan-ho/create', [AduanHoController::class, 'create'])->name('aduan-ho.create');
        Route::post('/aduan-ho/create', [AduanHoController::class, 'store'])->name('aduan-ho.store');
        Route::get('/aduan-ho/{id}/detail', [AduanHoController::class, 'detail'])->name('aduan-ho.detail');
    });

    Route::group(['middleware' => 'checkRole:guest:BIB,guest:BA,guest:MIFA,guest:MHU,guest:ADW,guest:AMI,guest:PIK,guest:IPT,guest:MLP,guest:MIP,guest:VIB,guest:SBS,guest:SKS,ict_developer:BIB'], function () {
        Route::get('/asetDashboard', [GuestAllController::class, 'index'])->name('asetDashboard');
        Route::get('/asetDashboard/pengajuanAkses', [GuestAllController::class, 'pengajuanAkses'])->name('pengajuanAkses');
    });

    Route::group(['middleware' => 'checkRole:guest:BIB,guest:BA,guest:MIFA,guest:MHU,guest:ADW,guest:AMI,guest:PIK,guest:IPT,guest:MLP,guest:MIP,guest:VIB,guest:SBS,guest:SKS,ict_developer:BIB'], function () {
        Route::get('/complaint/dashboard', [GuestReportController::class, 'index'])->name('guestAduan.page');
        Route::get('/complaint', [GuestReportController::class, 'create'])->name('guestAduan.create');
        Route::post('/complaint-store', [GuestReportController::class, 'store'])->name('guestAduan.store');
        Route::delete('/complaint/{id}/delete', [GuestReportController::class, 'destroy'])->name('guestAduan.delete');
    });

    Route::group(['middleware' => 'checkRole:ict_technician:BIB,ict_developer:BIB'], function () {
        Route::get('/technicianDashboard', function () {
            $aduan = Aduan::orderBy('date_of_complaint', 'desc')->where('site', auth()->user()->site)->get();
            $countOpen = Aduan::where('status', 'OPEN')->where('site', auth()->user()->site)->count();
            $countClosed = Aduan::where('status', 'CLOSED')->where('site', auth()->user()->site)->count();
            $countProgress = Aduan::where('status', 'PROGRESS')->where('site', auth()->user()->site)->count();
            $countCancel = Aduan::where('status', 'CANCEL')->where('site', auth()->user()->site)->count();

            // access point
            $countAPreadyused = InvAp::where('status', 'READY_USED')->where('site', auth()->user()->site)->count();
            $countAPstandby = InvAp::where('status', 'READY_STANDBY')->where('site', auth()->user()->site)->count();
            $countAPBreakdown = InvAp::where('status', 'BREAKDOWN')->where('site', auth()->user()->site)->count();
            $countAPScrap = InvAp::where('status', 'SCRAP')->where('site', auth()->user()->site)->count();

            // Switch
            $countSwitchreadyused = InvSwitch::where('status', 'READY_USED')->where('site', auth()->user()->site)->count();
            $countSwitchstandby = InvSwitch::where('status', 'READY_STANDBY')->where('site', auth()->user()->site)->count();
            $countSwitchBreakdown = InvSwitch::where('status', 'BREAKDOWN')->where('site', auth()->user()->site)->count();
            $countSwitchScrap = InvSwitch::where('status', 'SCRAP')->where('site', auth()->user()->site)->count();

            // Wirelless
            $countWirellessreadyused = InvWirelless::where('status', 'READY_USED')->where('site', auth()->user()->site)->count();
            $countWirellessstandby = InvWirelless::where('status', 'READY_STANDBY')->where('site', auth()->user()->site)->count();
            $countWirellessBreakdown = InvWirelless::where('status', 'BREAKDOWN')->where('site', auth()->user()->site)->count();
            $countWirellessScrap = InvWirelless::where('status', 'SCRAP')->where('site', auth()->user()->site)->count();

            // Printer
            $countPrinterreadyused = InvPrinter::where('status', 'READY_USED')->where('site', auth()->user()->site)->count();
            $countPrinterstandby = InvPrinter::where('status', 'READY_STANDBY')->where('site', auth()->user()->site)->count();
            $countPrinterBreakdown = InvPrinter::where('status', 'BREAKDOWN')->where('site', auth()->user()->site)->count();
            $countPrinterScrap = InvPrinter::where('status', 'SCRAP')->where('site', auth()->user()->site)->count();

            // CCTV
            $countCCTVreadyused = InvCctv::where('status', 'READY_USED')->where('site', auth()->user()->site)->count();
            $countCCTVstandby = InvCctv::where('status', 'READY_STANDBY')->where('site', auth()->user()->site)->count();
            $countCCTVBreakdown = InvCctv::where('status', 'BREAKDOWN')->where('site', auth()->user()->site)->count();
            $countCCTVScrap = InvCctv::where('status', 'SCRAP')->where('site', auth()->user()->site)->count();

            // Komputer
            $countKomputerreadyused = InvComputer::where('status', 'READY_USED')->where('site', auth()->user()->site)->count();
            $countKomputerstandby = InvComputer::where('status', 'READY_STANDBY')->where('site', auth()->user()->site)->count();
            $countKomputerBreakdown = InvComputer::where('status', 'BREAKDOWN')->where('site', auth()->user()->site)->count();
            $countKomputerScrap = InvComputer::where('status', 'SCRAP')->where('site', auth()->user()->site)->count();

            // Laptop
            $countLaptopreadyused = InvLaptop::where('status', 'READY_USED')->where('site', auth()->user()->site)->count();
            $countLaptopstandby = InvLaptop::where('status', 'READY_STANDBY')->where('site', auth()->user()->site)->count();
            $countLaptopBreakdown = InvLaptop::where('status', 'BREAKDOWN')->where('site', auth()->user()->site)->count();
            $countLaptopScrap = InvLaptop::where('status', 'SCRAP')->where('site', auth()->user()->site)->count();

            // AP,SW,BB,PRT,CCTV,KOMP,Laptop

            $breakdown_array = [$countAPBreakdown, $countSwitchBreakdown, $countWirellessBreakdown, $countPrinterBreakdown, $countCCTVBreakdown, $countKomputerBreakdown, $countLaptopBreakdown];

            $scrap_array = [$countAPScrap, $countSwitchScrap, $countWirellessScrap, $countPrinterScrap, $countCCTVScrap, $countKomputerScrap, $countLaptopScrap];

            $readyStandby_array = [$countAPstandby, $countSwitchstandby, $countWirellessstandby, $countPrinterstandby, $countCCTVstandby, $countKomputerstandby, $countLaptopstandby];

            $readyUsed_array = [$countAPreadyused, $countSwitchreadyused, $countWirellessreadyused, $countPrinterreadyused, $countCCTVreadyused, $countKomputerreadyused, $countLaptopreadyused];

            $loginSession =  'tes';

            return Inertia::render(
                'Inventory/DashboardTechnician',
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
        })->name('technicianDashboard');
    });

    Route::prefix('inventory')->group(function () {

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_bo:HO,ict_ho:HO'], function () {
            Route::get('/accessPoint', [InvApController::class, 'index'])->name('accessPoint.page');
            Route::post('/accessPoint/generate', [InvApController::class, 'generateCode'])->name('accessPoint.generate');
            Route::post('/accessPoint/generate/edit', [InvApController::class, 'generateCodeEdit'])->name('accessPoint.generateEdit');
            Route::get('/accessPoint/create', [InvApController::class, 'create'])->name('accessPoint.create');
            Route::post('/accessPoint/create', [InvApController::class, 'store'])->name('accessPoint.store');
            Route::get('/accessPoint/{apId}/edit', [InvApController::class, 'edit'])->name('accessPoint.edit');
            Route::put('/accessPoint/{apId}/update', [InvApController::class, 'update'])->name('accessPoint.update');
            Route::delete('/accessPoint/{apId}/delete', [InvApController::class, 'destroy'])->name('accessPoint.delete');
            Route::get('/accessPoint/{id}/detail', [InvApController::class, 'detail'])->name('accessPoint.detail');
            Route::post('/uploadCsvAp', [InvApController::class, 'uploadCsv'])->name('accessPoint.import');

            Route::get('/switch', [InvSwitchController::class, 'index'])->name('switch.page');
            Route::get('/switch/create', [InvSwitchController::class, 'create'])->name('switch.create');
            Route::post('/switch/create', [InvSwitchController::class, 'store'])->name('switch.store');
            Route::post('/switch/generate', [InvSwitchController::class, 'generateCode'])->name('switch.generate');
            Route::post('/switch/generate/edit', [InvSwitchController::class, 'generateCodeEdit'])->name('switch.generateEdit');
            Route::get('/switch/{swId}/edit', [InvSwitchController::class, 'edit'])->name('switch.edit');
            Route::put('/switch/{swId}/update', [InvSwitchController::class, 'update'])->name('switch.update');
            Route::delete('/switch/{swId}/delete', [InvSwitchController::class, 'destroy'])->name('switch.delete');
            Route::get('/switch/{id}/detail', [InvSwitchController::class, 'detail'])->name('switch.detail');
            Route::post('/uploadCsvSw', [InvSwitchController::class, 'uploadCsv'])->name('switch.import');

            Route::get('/wirelless', [InvWirellessController::class, 'index'])->name('wirelless.page');
            Route::get('/wirelless/create', [InvWirellessController::class, 'create'])->name('wirelless.create');
            Route::post('/wirelless/create', [InvWirellessController::class, 'store'])->name('wirelless.store');
            Route::post('/wirelless/generate', [InvWirellessController::class, 'generateCode'])->name('wirelless.generate');
            Route::post('/wirelless/generate/edit', [InvWirellessController::class, 'generateCodeEdit'])->name('wirelless.generateEdit');
            Route::get('/wirelless/{id}/edit', [InvWirellessController::class, 'edit'])->name('wirelless.edit');
            Route::put('/wirelless/{id}/update', [InvWirellessController::class, 'update'])->name('wirelless.update');
            Route::delete('/wirelless/{id}/delete', [InvWirellessController::class, 'destroy'])->name('wirelless.delete');
            Route::get('/wirelless/{id}/detail', [InvWirellessController::class, 'detail'])->name('wirelless.detail');
            Route::post('/uploadCsvBb', [InvWirellessController::class, 'uploadCsv'])->name('wirelless.import');

            Route::get('/laptop', [InvLaptopController::class, 'index'])->name('laptop.page');
            Route::post('/laptop/generate', [InvLaptopController::class, 'generateCode'])->name('laptop.generate');
            Route::get('/laptop/create', [InvLaptopController::class, 'create'])->name('laptop.create');
            Route::post('/laptop/create', [InvLaptopController::class, 'store'])->name('laptop.store');
            Route::get('/laptop/{id}/edit', [InvLaptopController::class, 'edit'])->name('laptop.edit');
            Route::delete('/laptop/{id}/delete', [InvLaptopController::class, 'destroy'])->name('laptop.delete');
            Route::post('/laptop/update', [InvLaptopController::class, 'update'])->name('laptop.update');
            Route::get('/laptop/{id}/detail', [InvLaptopController::class, 'detail'])->name('laptop.detail');
            Route::post('/uploadCsvNb', [InvLaptopController::class, 'uploadCsv'])->name('laptop.import');

            Route::get('/komputer', [InvComputerController::class, 'index'])->name('komputer.page');
            Route::post('/komputer/generate', [InvComputerController::class, 'generateCode'])->name('komputer.generate');
            Route::get('/komputer/create', [InvComputerController::class, 'create'])->name('komputer.create');
            Route::post('/komputer/create', [InvComputerController::class, 'store'])->name('komputer.store');
            Route::get('/komputer/{id}/edit', [InvComputerController::class, 'edit'])->name('komputer.edit');
            Route::delete('/komputer/{id}/delete', [InvComputerController::class, 'destroy'])->name('komputer.delete');
            Route::post('/komputer/update', [InvComputerController::class, 'update'])->name('komputer.update');
            Route::get('/komputer/{id}/detail', [InvComputerController::class, 'detail'])->name('komputer.detail');
            Route::post('/uploadCsvCu', [InvComputerController::class, 'uploadCsv'])->name('komputer.import');

            Route::get('/printer', [InvPrinterController::class, 'index'])->name(name: 'printer.page');
            Route::get('/printer/create', [InvPrinterController::class, 'create'])->name('printer.create');
            Route::post('/printer/create', [InvPrinterController::class, 'store'])->name('printer.store');
            Route::get('/printer/{id}/edit', [InvPrinterController::class, 'edit'])->name('printer.edit');
            Route::delete('/printer/{id}/delete', [InvPrinterController::class, 'destroy'])->name('printer.delete');
            Route::post('/printer/update', [InvPrinterController::class, 'update'])->name('printer.update');
            Route::get('/printer/{id}/detail', [InvPrinterController::class, 'detail'])->name('printer.detail');
            Route::post('/uploadCsvPrt', [InvPrinterController::class, 'uploadCsv'])->name('printer.import');

            Route::get('/scanner', [InvScannerController::class, 'index'])->name('scanner.page');
            Route::get('/scanner/create', [InvScannerController::class, 'create'])->name('scanner.create');
            Route::post('/scanner/create', [InvScannerController::class, 'store'])->name('scanner.store');
            Route::get('/scanner/{id}/edit', [InvScannerController::class, 'edit'])->name('scanner.edit');
            Route::delete('/scanner/{id}/delete', [InvScannerController::class, 'destroy'])->name('scanner.delete');
            Route::post('/scanner/update', [InvScannerController::class, 'update'])->name('scanner.update');
            Route::get('/scanner/{id}/detail', [InvScannerController::class, 'detail'])->name('scanner.detail');
            Route::post('/uploadCsvScn', [InvScannerController::class, 'uploadCsv'])->name('scanner.import');

            Route::get('/cctv', [InvCctvController::class, 'index'])->name('cctv.page');
            Route::get('/cctv/create', [InvCctvController::class, 'create'])->name('cctv.create');
            Route::post('/cctv/create', [InvCctvController::class, 'store'])->name('cctv.store');
            Route::get('/cctv/{id}/edit', [InvCctvController::class, 'edit'])->name('cctv.edit');
            Route::delete('/cctv/{id}/delete', [InvCctvController::class, 'destroy'])->name('cctv.delete');
            Route::post('/cctv/update', [InvCctvController::class, 'update'])->name('cctv.update');
            Route::get('/cctv/{id}/detail', [InvCctvController::class, 'detail'])->name('cctv.detail');
            Route::post('/uploadCsvCCTV', [InvCctvController::class, 'uploadCsv'])->name('cctv.import');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:BA,ict_group_leader:BA,ict_admin:BA,ict_ho:HO'], function () {
            Route::get('/dashboardSiteBa', [DashboardBaController::class, 'index'])->name('dashboardBa.page');

            Route::get('/accessPointSiteBa', [InvApBaController::class, 'index'])->name('accessPointBa.page');
            Route::post('/accessPointSiteBa/generate', [InvApBaController::class, 'generateCode'])->name('accessPointBa.generate');
            Route::post('/accessPointSiteBa/generate/edit', [InvApBaController::class, 'generateCodeEdit'])->name('accessPointBa.generateEdit');
            Route::get('/accessPointSiteBa/create', [InvApBaController::class, 'create'])->name('accessPointBa.create');
            Route::post('/accessPointSiteBa/create', [InvApBaController::class, 'store'])->name('accessPointBa.store');
            Route::get('/accessPointSiteBa/{apId}/edit', [InvApBaController::class, 'edit'])->name('accessPointBa.edit');
            Route::put('/accessPointSiteBa/{apId}/update', [InvApBaController::class, 'update'])->name('accessPointBa.update');
            Route::delete('/accessPointSiteBa/{apId}/delete', [InvApBaController::class, 'destroy'])->name('accessPointBa.delete');
            Route::get('/accessPointSiteBa/{id}/detail', [InvApBaController::class, 'detail'])->name('accessPointBa.detail');
            Route::post('/uploadCsvApBa', [InvApBaController::class, 'uploadCsv'])->name('accessPointBa.import');

            Route::get('/switchBa', [InvSwitchBaController::class, 'index'])->name('switchBa.page');
            Route::get('/switchBa/create', [InvSwitchBaController::class, 'create'])->name('switchBa.create');
            Route::post('/switchBa/create', [InvSwitchBaController::class, 'store'])->name('switchBa.store');
            Route::post('/switchBa/generate', [InvSwitchBaController::class, 'generateCode'])->name('switchBa.generate');
            Route::post('/switchBa/generate/edit', [InvSwitchBaController::class, 'generateCodeEdit'])->name('switchBa.generateEdit');
            Route::get('/switchBa/{swId}/edit', [InvSwitchBaController::class, 'edit'])->name('switchBa.edit');
            Route::put('/switchBa/{swId}/update', [InvSwitchBaController::class, 'update'])->name('switchBa.update');
            Route::delete('/switchBa/{swId}/delete', [InvSwitchBaController::class, 'destroy'])->name('switchBa.delete');
            Route::get('/switchBa/{id}/detail', [InvSwitchBaController::class, 'detail'])->name('switchBa.detail');
            Route::post('/uploadCsvSwBa', [InvSwitchBaController::class, 'uploadCsv'])->name('switchBa.import');

            Route::get('/wirellessBa', [InvWirellessBaController::class, 'index'])->name('wirellessBa.page');
            Route::get('/wirellessBa/create', [InvWirellessBaController::class, 'create'])->name('wirellessBa.create');
            Route::post('/wirellessBa/create', [InvWirellessBaController::class, 'store'])->name('wirellessBa.store');
            Route::post('/wirellessBa/generate', [InvWirellessBaController::class, 'generateCode'])->name('wirellessBa.generate');
            Route::post('/wirellessBa/generate/edit', [InvWirellessBaController::class, 'generateCodeEdit'])->name('wirellessBa.generateEdit');
            Route::get('/wirellessBa/{id}/edit', [InvWirellessBaController::class, 'edit'])->name('wirellessBa.edit');
            Route::put('/wirellessBa/{id}/update', [InvWirellessBaController::class, 'update'])->name('wirellessBa.update');
            Route::delete('/wirellessBa/{id}/delete', [InvWirellessBaController::class, 'destroy'])->name('wirellessBa.delete');
            Route::get('/wirellessBa/{id}/detail', [InvWirellessBaController::class, 'detail'])->name('wirellessBa.detail');
            Route::post('/uploadCsvBbBa', [InvWirellessBaController::class, 'uploadCsv'])->name('wirellessBa.import');

            Route::get('/laptopBa', [InvLaptopBaController::class, 'index'])->name('laptopBa.page');
            Route::post('/laptopBa/generate', [InvLaptopBaController::class, 'generateCode'])->name('laptopBa.generate');
            Route::get('/laptopBa/create', [InvLaptopBaController::class, 'create'])->name('laptopBa.create');
            Route::post('/laptopBa/create', [InvLaptopBaController::class, 'store'])->name('laptopBa.store');
            Route::get('/laptopBa/{id}/edit', [InvLaptopBaController::class, 'edit'])->name('laptopBa.edit');
            Route::delete('/laptopBa/{id}/delete', [InvLaptopBaController::class, 'destroy'])->name('laptopBa.delete');
            Route::post('/laptopBa/update', [InvLaptopBaController::class, 'update'])->name('laptopBa.update');
            Route::get('/laptopBa/{id}/detail', [InvLaptopBaController::class, 'detail'])->name('laptopBa.detail');
            Route::post('/uploadCsvNbBa', [InvLaptopBaController::class, 'uploadCsv'])->name('laptopBa.import');

            Route::get('/komputerBa', [InvComputerBaController::class, 'index'])->name('komputerBa.page');
            Route::post('/komputerBa/generate', [InvComputerBaController::class, 'generateCode'])->name('komputerBa.generate');
            Route::get('/komputerBa/create', [InvComputerBaController::class, 'create'])->name('komputerBa.create');
            Route::post('/komputerBa/create', [InvComputerBaController::class, 'store'])->name('komputerBa.store');
            Route::get('/komputerBa/{id}/edit', [InvComputerBaController::class, 'edit'])->name('komputerBa.edit');
            Route::delete('/komputerBa/{id}/delete', [InvComputerBaController::class, 'destroy'])->name('komputerBa.delete');
            Route::post('/komputerBa/update', [InvComputerBaController::class, 'update'])->name('komputerBa.update');
            Route::get('/komputerBa/{id}/detail', [InvComputerBaController::class, 'detail'])->name('komputerBa.detail');
            Route::post('/uploadCsvCuBa', [InvComputerBaController::class, 'uploadCsv'])->name('komputerBa.import');

            Route::get('/printerBa', [InvPrinterBaController::class, 'index'])->name(name: 'printerBa.page');
            Route::get('/printerBa/create', [InvPrinterBaController::class, 'create'])->name('printerBa.create');
            Route::post('/printerBa/create', [InvPrinterBaController::class, 'store'])->name('printerBa.store');
            Route::get('/printerBa/{id}/edit', [InvPrinterBaController::class, 'edit'])->name('printerBa.edit');
            Route::delete('/printerBa/{id}/delete', [InvPrinterBaController::class, 'destroy'])->name('printerBa.delete');
            Route::post('/printerBa/update', [InvPrinterBaController::class, 'update'])->name('printerBa.update');
            Route::get('/printerBa/{id}/detail', [InvPrinterBaController::class, 'detail'])->name('printerBa.detail');
            Route::post('/uploadCsvPrtBa', [InvPrinterBaController::class, 'uploadCsv'])->name('printerBa.import');

            Route::get('/scannerBa', [InvScannerBaController::class, 'index'])->name('scannerBa.page');
            Route::get('/scannerBa/create', [InvScannerBaController::class, 'create'])->name('scannerBa.create');
            Route::post('/scannerBa/create', [InvScannerBaController::class, 'store'])->name('scannerBa.store');
            Route::get('/scannerBa/{id}/edit', [InvScannerBaController::class, 'edit'])->name('scannerBa.edit');
            Route::delete('/scannerBa/{id}/delete', [InvScannerBaController::class, 'destroy'])->name('scannerBa.delete');
            Route::post('/scannerBa/update', [InvScannerBaController::class, 'update'])->name('scannerBa.update');
            Route::get('/scannerBa/{id}/detail', [InvScannerBaController::class, 'detail'])->name('scannerBa.detail');
            Route::post('/uploadCsvScnBa', [InvScannerBaController::class, 'uploadCsv'])->name('scannerBa.import');

            Route::get('/cctvBa', [InvCctvBaController::class, 'index'])->name('cctvBa.page');
            Route::get('/cctvBa/create', [InvCctvBaController::class, 'create'])->name('cctvBa.create');
            Route::post('/cctvBa/create', [InvCctvBaController::class, 'store'])->name('cctvBa.store');
            Route::get('/cctvBa/{id}/edit', [InvCctvBaController::class, 'edit'])->name('cctvBa.edit');
            Route::delete('/cctvBa/{id}/delete', [InvCctvBaController::class, 'destroy'])->name('cctvBa.delete');
            Route::post('/cctvBa/update', [InvCctvBaController::class, 'update'])->name('cctvBa.update');
            Route::get('/cctvBa/{id}/detail', [InvCctvBaController::class, 'detail'])->name('cctvBa.detail');
            Route::post('/uploadCsvCCTVBa', [InvCctvBaController::class, 'uploadCsv'])->name('cctvBa.import');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:MIFA,ict_group_leader:MIFA,ict_admin:MIFA,ict_group_leader:MIFA,ict_ho:HO'], function () {
            Route::get('/dashboardSiteMifa', [DashboardMifaController::class, 'index'])->name('dashboardMifa.page');

            Route::get('/accessPointSiteMifa', [InvApMifaController::class, 'index'])->name('accessPointMifa.page');
            Route::get('/accessPointSiteMifa/create', [InvApMifaController::class, 'create'])->name('accessPointMifa.create');
            Route::post('/accessPointSiteMifa/create', [InvApMifaController::class, 'store'])->name('accessPointMifa.store');
            Route::post('/accessPointSiteMifa/generate', [InvApMifaController::class, 'generateCode'])->name('accessPointMifa.generate');
            Route::post('/accessPointSiteMifa/generate/edit', [InvApMifaController::class, 'generateCodeEdit'])->name('accessPointMifa.generateEdit');
            Route::get('/accessPointSiteMifa/{apId}/edit', [InvApMifaController::class, 'edit'])->name('accessPointMifa.edit');
            Route::put('/accessPointSiteMifa/{apId}/update', [InvApMifaController::class, 'update'])->name('accessPointMifa.update');
            Route::delete('/accessPointSiteMifa/{apId}/delete', [InvApMifaController::class, 'destroy'])->name('accessPointMifa.delete');
            Route::get('/accessPointSiteMifa/{id}/detail', [InvApMifaController::class, 'detail'])->name('accessPointMifa.detail');
            Route::post('/uploadCsvApMifa', [InvApMifaController::class, 'uploadCsv'])->name('accessPointMifa.import');

            Route::get('/switchMifa', [InvSwitchMifaController::class, 'index'])->name('switchMifa.page');
            Route::get('/switchMifa/create', [InvSwitchMifaController::class, 'create'])->name('switchMifa.create');
            Route::post('/switchMifa/create', [InvSwitchMifaController::class, 'store'])->name('switchMifa.store');
            Route::post('/switchMifa/generate', [InvSwitchMifaController::class, 'generateCode'])->name('switchMifa.generate');
            Route::post('/switchMifa/generate/edit', [InvSwitchMifaController::class, 'generateCodeEdit'])->name('switchMifa.generateEdit');
            Route::get('/switchMifa/{swId}/edit', [InvSwitchMifaController::class, 'edit'])->name('switchMifa.edit');
            Route::put('/switchMifa/{swId}/update', [InvSwitchMifaController::class, 'update'])->name('switchMifa.update');
            Route::delete('/switchMifa/{swId}/delete', [InvSwitchMifaController::class, 'destroy'])->name('switchMifa.delete');
            Route::get('/switchMifa/{id}/detail', [InvSwitchMifaController::class, 'detail'])->name('switchMifa.detail');
            Route::post('/uploadCsvSwMifa', [InvSwitchMifaController::class, 'uploadCsv'])->name('switchMifa.import');

            Route::get('/wirellessMifa', [InvWirellessMifaController::class, 'index'])->name('wirellessMifa.page');
            Route::get('/wirellessMifa/create', [InvWirellessMifaController::class, 'create'])->name('wirellessMifa.create');
            Route::post('/wirellessMifa/create', [InvWirellessMifaController::class, 'store'])->name('wirellessMifa.store');
            Route::get('/wirellessMifa/{id}/edit', [InvWirellessMifaController::class, 'edit'])->name('wirellessMifa.edit');
            Route::put('/wirellessMifa/{id}/update', [InvWirellessMifaController::class, 'update'])->name('wirellessMifa.update');
            Route::delete('/wirellessMifa/{id}/delete', [InvWirellessMifaController::class, 'destroy'])->name('wirellessMifa.delete');
            Route::get('/wirellessMifa/{id}/detail', [InvWirellessMifaController::class, 'detail'])->name('wirellessMifa.detail');
            Route::post('/uploadCsvBbMifa', [InvWirellessMifaController::class, 'uploadCsv'])->name('wirellessMifa.import');

            Route::get('/laptopMifa', [InvLaptopMifaController::class, 'index'])->name('laptopMifa.page');
            Route::post('/laptopMifa/generate', [InvLaptopMifaController::class, 'generateCode'])->name('laptopMifa.generate');
            Route::get('/laptopMifa/create', [InvLaptopMifaController::class, 'create'])->name('laptopMifa.create');
            Route::post('/laptopMifa/create', [InvLaptopMifaController::class, 'store'])->name('laptopMifa.store');
            Route::get('/laptopMifa/{id}/edit', [InvLaptopMifaController::class, 'edit'])->name('laptopMifa.edit');
            Route::delete('/laptopMifa/{id}/delete', [InvLaptopMifaController::class, 'destroy'])->name('laptopMifa.delete');
            Route::post('/laptopMifa/update', [InvLaptopMifaController::class, 'update'])->name('laptopMifa.update');
            Route::get('/laptopMifa/{id}/detail', [InvLaptopMifaController::class, 'detail'])->name('laptopMifa.detail');
            Route::post('/uploadCsvNbMifa', [InvLaptopMifaController::class, 'uploadCsv'])->name('laptopMifa.import');

            Route::get('/komputerMifa', [InvComputerMifaController::class, 'index'])->name('komputerMifa.page');
            Route::post('/komputerMifa/generate', [InvComputerMifaController::class, 'generateCode'])->name('komputerMifa.generate');
            Route::get('/komputerMifa/create', [InvComputerMifaController::class, 'create'])->name('komputerMifa.create');
            Route::post('/komputerMifa/create', [InvComputerMifaController::class, 'store'])->name('komputerMifa.store');
            Route::get('/komputerMifa/{id}/edit', [InvComputerMifaController::class, 'edit'])->name('komputerMifa.edit');
            Route::delete('/komputerMifa/{id}/delete', [InvComputerMifaController::class, 'destroy'])->name('komputerMifa.delete');
            Route::post('/komputerMifa/update', [InvComputerMifaController::class, 'update'])->name('komputerMifa.update');
            Route::get('/komputerMifa/{id}/detail', [InvComputerMifaController::class, 'detail'])->name('komputerMifa.detail');
            Route::post('/uploadCsvCuMifa', [InvComputerMifaController::class, 'uploadCsv'])->name('komputerMifa.import');

            Route::get('/printerMifa', [InvPrinterMifaController::class, 'index'])->name(name: 'printerMifa.page');
            Route::get('/printerMifa/create', [InvPrinterMifaController::class, 'create'])->name('printerMifa.create');
            Route::post('/printerMifa/create', [InvPrinterMifaController::class, 'store'])->name('printerMifa.store');
            Route::get('/printerMifa/{id}/edit', [InvPrinterMifaController::class, 'edit'])->name('printerMifa.edit');
            Route::delete('/printerMifa/{id}/delete', [InvPrinterMifaController::class, 'destroy'])->name('printerMifa.delete');
            Route::post('/printerMifa/update', [InvPrinterMifaController::class, 'update'])->name('printerMifa.update');
            Route::get('/printerMifa/{id}/detail', [InvPrinterMifaController::class, 'detail'])->name('printerMifa.detail');
            Route::post('/uploadCsvPrtMifa', [InvPrinterMifaController::class, 'uploadCsv'])->name('printerMifa.import');

            Route::get('/scannerMifa', [InvScannerMifaController::class, 'index'])->name('scannerMifa.page');
            Route::get('/scannerMifa/create', [InvScannerMifaController::class, 'create'])->name('scannerMifa.create');
            Route::post('/scannerMifa/create', [InvScannerMifaController::class, 'store'])->name('scannerMifa.store');
            Route::get('/scannerMifa/{id}/edit', [InvScannerMifaController::class, 'edit'])->name('scannerMifa.edit');
            Route::delete('/scannerMifa/{id}/delete', [InvScannerMifaController::class, 'destroy'])->name('scannerMifa.delete');
            Route::post('/scannerMifa/update', [InvScannerMifaController::class, 'update'])->name('scannerMifa.update');
            Route::get('/scannerMifa/{id}/detail', [InvScannerMifaController::class, 'detail'])->name('scannerMifa.detail');
            Route::post('/uploadCsvScnMifa', [InvScannerMifaController::class, 'uploadCsv'])->name('scannerMifa.import');

            Route::get('/cctvMifa', [InvCctvMifaController::class, 'index'])->name('cctvMifa.page');
            Route::get('/cctvMifa/create', [InvCctvMifaController::class, 'create'])->name('cctvMifa.create');
            Route::post('/cctvMifa/create', [InvCctvMifaController::class, 'store'])->name('cctvMifa.store');
            Route::get('/cctvMifa/{id}/edit', [InvCctvMifaController::class, 'edit'])->name('cctvMifa.edit');
            Route::delete('/cctvMifa/{id}/delete', [InvCctvMifaController::class, 'destroy'])->name('cctvMifa.delete');
            Route::post('/cctvMifa/update', [InvCctvMifaController::class, 'update'])->name('cctvMifa.update');
            Route::get('/cctvMifa/{id}/detail', [InvCctvMifaController::class, 'detail'])->name('cctvMifa.detail');
            Route::post('/uploadCsvCCTVMifa', [InvCctvMifaController::class, 'uploadCsv'])->name('cctvMifa.import');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:MHU,ict_group_leader:MHU,ict_admin:MHU,ict_ho:HO'], function () {
            Route::get('/dashboardSiteMhu', [DashboardMhuController::class, 'index'])->name('dashboardMhu.page');

            Route::get('/accessPointSiteMHU', [InvApMhuController::class, 'index'])->name('accessPointMhu.page');
            Route::get('/accessPointSiteMHU/create', [InvApMhuController::class, 'create'])->name('accessPointMhu.create');
            Route::post('/accessPointSiteMhu/generate', [InvApMhuController::class, 'generateCode'])->name('accessPointMhu.generate');
            Route::post('/accessPointSiteMhu/generate/edit', [InvApMhuController::class, 'generateCodeEdit'])->name('accessPointMhu.generateEdit');
            Route::post('/accessPointSiteMHU/create', [InvApMhuController::class, 'store'])->name('accessPointMhu.store');
            Route::get('/accessPointSiteMHU/{apId}/edit', [InvApMhuController::class, 'edit'])->name('accessPointMhu.edit');
            Route::put('/accessPointSiteMHU/{apId}/update', [InvApMhuController::class, 'update'])->name('accessPointMhu.update');
            Route::delete('/accessPointSiteMHU/{apId}/delete', [InvApMhuController::class, 'destroy'])->name('accessPointMhu.delete');
            Route::get('/accessPointSiteMHU/{id}/detail', [InvApMhuController::class, 'detail'])->name('accessPointMhu.detail');
            Route::post('/uploadCsvApMHU', [InvApMhuController::class, 'uploadCsv'])->name('accessPointMhu.import');

            Route::get('/switchMhu', [InvSwitchMhuController::class, 'index'])->name('switchMhu.page');
            Route::get('/switchMhu/create', [InvSwitchMhuController::class, 'create'])->name('switchMhu.create');
            Route::post('/switchMhu/create', [InvSwitchMhuController::class, 'store'])->name('switchMhu.store');
            Route::post('/switchMhu/generate', [InvSwitchMhuController::class, 'generateCode'])->name('switchMhu.generate');
            Route::post('/switchMhu/generate/edit', [InvSwitchMhuController::class, 'generateCodeEdit'])->name('switchMhu.generateEdit');
            Route::get('/switchMhu/{swId}/edit', [InvSwitchMhuController::class, 'edit'])->name('switchMhu.edit');
            Route::put('/switchMhu/{swId}/update', [InvSwitchMhuController::class, 'update'])->name('switchMhu.update');
            Route::delete('/switchMhu/{swId}/delete', [InvSwitchMhuController::class, 'destroy'])->name('switchMhu.delete');
            Route::get('/switchMhu/{id}/detail', [InvSwitchMhuController::class, 'detail'])->name('switchMhu.detail');
            Route::post('/uploadCsvSwMhu', [InvSwitchMhuController::class, 'uploadCsv'])->name('switchMhu.import');

            Route::get('/wirellessMhu', [InvWirellessMhuController::class, 'index'])->name('wirellessMhu.page');
            Route::get('/wirellessMhu/create', [InvWirellessMhuController::class, 'create'])->name('wirellessMhu.create');
            Route::post('/wirellessMhu/create', [InvWirellessMhuController::class, 'store'])->name('wirellessMhu.store');
            Route::get('/wirellessMhu/{id}/edit', [InvWirellessMhuController::class, 'edit'])->name('wirellessMhu.edit');
            Route::put('/wirellessMhu/{id}/update', [InvWirellessMhuController::class, 'update'])->name('wirellessMhu.update');
            Route::delete('/wirellessMhu/{id}/delete', [InvWirellessMhuController::class, 'destroy'])->name('wirellessMhu.delete');
            Route::get('/wirellessMhu/{id}/detail', [InvWirellessMhuController::class, 'detail'])->name('wirellessMhu.detail');
            Route::post('/uploadCsvBbMhu', [InvWirellessMhuController::class, 'uploadCsv'])->name('wirellessMhu.import');

            Route::get('/laptopMhu', [InvLaptopMhuController::class, 'index'])->name('laptopMhu.page');
            Route::post('/laptopMhu/generate', [InvLaptopMhuController::class, 'generateCode'])->name('laptopMhu.generate');
            Route::get('/laptopMhu/create', [InvLaptopMhuController::class, 'create'])->name('laptopMhu.create');
            Route::post('/laptopMhu/create', [InvLaptopMhuController::class, 'store'])->name('laptopMhu.store');
            Route::get('/laptopMhu/{id}/edit', [InvLaptopMhuController::class, 'edit'])->name('laptopMhu.edit');
            Route::delete('/laptopMhu/{id}/delete', [InvLaptopMhuController::class, 'destroy'])->name('laptopMhu.delete');
            Route::post('/laptopMhu/update', [InvLaptopMhuController::class, 'update'])->name('laptopMhu.update');
            Route::get('/laptopMhu/{id}/detail', [InvLaptopMhuController::class, 'detail'])->name('laptopMhu.detail');
            Route::post('/uploadCsvNbMhu', [InvLaptopMhuController::class, 'uploadCsv'])->name('laptopMhu.import');

            Route::get('/komputerMhu', [InvComputerMhuController::class, 'index'])->name('komputerMhu.page');
            Route::post('/komputerMhu/generate', [InvComputerMhuController::class, 'generateCode'])->name('komputerMhu.generate');
            Route::get('/komputerMhu/create', [InvComputerMhuController::class, 'create'])->name('komputerMhu.create');
            Route::post('/komputerMhu/create', [InvComputerMhuController::class, 'store'])->name('komputerMhu.store');
            Route::get('/komputerMhu/{id}/edit', [InvComputerMhuController::class, 'edit'])->name('komputerMhu.edit');
            Route::delete('/komputerMhu/{id}/delete', [InvComputerMhuController::class, 'destroy'])->name('komputerMhu.delete');
            Route::post('/komputerMhu/update', [InvComputerMhuController::class, 'update'])->name('komputerMhu.update');
            Route::get('/komputerMhu/{id}/detail', [InvComputerMhuController::class, 'detail'])->name('komputerMhu.detail');
            Route::post('/uploadCsvCuMhu', [InvComputerMhuController::class, 'uploadCsv'])->name('komputerMhu.import');

            Route::get('/printerMhu', [InvPrinterMhuController::class, 'index'])->name(name: 'printerMhu.page');
            Route::get('/printerMhu/create', [InvPrinterMhuController::class, 'create'])->name('printerMhu.create');
            Route::post('/printerMhu/create', [InvPrinterMhuController::class, 'store'])->name('printerMhu.store');
            Route::get('/printerMhu/{id}/edit', [InvPrinterMhuController::class, 'edit'])->name('printerMhu.edit');
            Route::delete('/printerMhu/{id}/delete', [InvPrinterMhuController::class, 'destroy'])->name('printerMhu.delete');
            Route::post('/printerMhu/update', [InvPrinterMhuController::class, 'update'])->name('printerMhu.update');
            Route::get('/printerMhu/{id}/detail', [InvPrinterMhuController::class, 'detail'])->name('printerMhu.detail');
            Route::post('/uploadCsvPrtMhu', [InvPrinterMhuController::class, 'uploadCsv'])->name('printerMhu.import');

            Route::get('/scannerMhu', [InvScannerMhuController::class, 'index'])->name('scannerMhu.page');
            Route::get('/scannerMhu/create', [InvScannerMhuController::class, 'create'])->name('scannerMhu.create');
            Route::post('/scannerMhu/create', [InvScannerMhuController::class, 'store'])->name('scannerMhu.store');
            Route::get('/scannerMhu/{id}/edit', [InvScannerMhuController::class, 'edit'])->name('scannerMhu.edit');
            Route::delete('/scannerMhu/{id}/delete', [InvScannerMhuController::class, 'destroy'])->name('scannerMhu.delete');
            Route::post('/scannerMhu/update', [InvScannerMhuController::class, 'update'])->name('scannerMhu.update');
            Route::get('/scannerMhu/{id}/detail', [InvScannerMhuController::class, 'detail'])->name('scannerMhu.detail');
            Route::post('/uploadCsvScnMhu', [InvScannerMhuController::class, 'uploadCsv'])->name('scannerMhu.import');

            Route::get('/cctvMhu', [InvCctvMhuController::class, 'index'])->name('cctvMhu.page');
            Route::get('/cctvMhu/create', [InvCctvMhuController::class, 'create'])->name('cctvMhu.create');
            Route::post('/cctvMhu/create', [InvCctvMhuController::class, 'store'])->name('cctvMhu.store');
            Route::get('/cctvMhu/{id}/edit', [InvCctvMhuController::class, 'edit'])->name('cctvMhu.edit');
            Route::delete('/cctvMhu/{id}/delete', [InvCctvMhuController::class, 'destroy'])->name('cctvMhu.delete');
            Route::post('/cctvMhu/update', [InvCctvMhuController::class, 'update'])->name('cctvMhu.update');
            Route::get('/cctvMhu/{id}/detail', [InvCctvMhuController::class, 'detail'])->name('cctvMhu.detail');
            Route::post('/uploadCsvCCTVMhu', [InvCctvMhuController::class, 'uploadCsv'])->name('cctvMhu.import');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:AMI,ict_group_leader:AMI,ict_admin:AMI,ict_ho:HO'], function () {
            Route::get('/dashboardSiteAmi', [DashboardAmiController::class, 'index'])->name('dashboardAmi.page');

            Route::get('/accessPointSiteAmi', [InvApAmiController::class, 'index'])->name('accessPointAmi.page');
            Route::post('/accessPointSiteAmi/generate', [InvApAmiController::class, 'generateCode'])->name('accessPointAmi.generate');
            Route::post('/accessPointSiteAmi/generate/edit', [InvApAmiController::class, 'generateCodeEdit'])->name('accessPointAmi.generateEdit');
            Route::get('/accessPointSiteAmi/create', [InvApAmiController::class, 'create'])->name('accessPointAmi.create');
            Route::post('/accessPointSiteAmi/create', [InvApAmiController::class, 'store'])->name('accessPointAmi.store');
            Route::get('/accessPointSiteAmi/{apId}/edit', [InvApAmiController::class, 'edit'])->name('accessPointAmi.edit');
            Route::put('/accessPointSiteAmi/{apId}/update', [InvApAmiController::class, 'update'])->name('accessPointAmi.update');
            Route::delete('/accessPointSiteAmi/{apId}/delete', [InvApAmiController::class, 'destroy'])->name('accessPointAmi.delete');
            Route::get('/accessPointSiteAmi/{id}/detail', [InvApAmiController::class, 'detail'])->name('accessPointAmi.detail');
            Route::post('/uploadCsvApAmi', [InvApAmiController::class, 'uploadCsv'])->name('accessPointAmi.import');

            Route::get('/switchAmi', [InvSwitchAmiController::class, 'index'])->name('switchAmi.page');
            Route::get('/switchAmi/create', [InvSwitchAmiController::class, 'create'])->name('switchAmi.create');
            Route::post('/switchAmi/create', [InvSwitchAmiController::class, 'store'])->name('switchAmi.store');
            Route::post('/switchAmi/generate', [InvSwitchAmiController::class, 'generateCode'])->name('switchAmi.generate');
            Route::post('/switchAmi/generate/edit', [InvSwitchAmiController::class, 'generateCodeEdit'])->name('switchAmi.generateEdit');
            Route::get('/switchAmi/{swId}/edit', [InvSwitchAmiController::class, 'edit'])->name('switchAmi.edit');
            Route::put('/switchAmi/{swId}/update', [InvSwitchAmiController::class, 'update'])->name('switchAmi.update');
            Route::delete('/switchAmi/{swId}/delete', [InvSwitchAmiController::class, 'destroy'])->name('switchAmi.delete');
            Route::get('/switchAmi/{id}/detail', [InvSwitchAmiController::class, 'detail'])->name('switchAmi.detail');
            Route::post('/uploadCsvSwAmi', [InvSwitchAmiController::class, 'uploadCsv'])->name('switchAmi.import');

            Route::get('/wirellessAmi', [InvWirellessAmiController::class, 'index'])->name('wirellessAmi.page');
            Route::get('/wirellessAmi/create', [InvWirellessAmiController::class, 'create'])->name('wirellessAmi.create');
            Route::post('/wirellessAmi/create', [InvWirellessAmiController::class, 'store'])->name('wirellessAmi.store');
            Route::post('/wirellessAmi/generate', [InvWirellessAmiController::class, 'generateCode'])->name('wirellessAmi.generate');
            Route::post('/wirellessAmi/generate/edit', [InvWirellessAmiController::class, 'generateCodeEdit'])->name('wirellessAmi.generateEdit');
            Route::get('/wirellessAmi/{id}/edit', [InvWirellessAmiController::class, 'edit'])->name('wirellessAmi.edit');
            Route::put('/wirellessAmi/{id}/update', [InvWirellessAmiController::class, 'update'])->name('wirellessAmi.update');
            Route::delete('/wirellessAmi/{id}/delete', [InvWirellessAmiController::class, 'destroy'])->name('wirellessAmi.delete');
            Route::get('/wirellessAmi/{id}/detail', [InvWirellessAmiController::class, 'detail'])->name('wirellessAmi.detail');
            Route::post('/uploadCsvBbAmi', [InvWirellessAmiController::class, 'uploadCsv'])->name('wirellessAmi.import');

            Route::get('/laptopAmi', [InvLaptopAmiController::class, 'index'])->name('laptopAmi.page');
            Route::post('/laptopAmi/generate', [InvLaptopAmiController::class, 'generateCode'])->name('laptopAmi.generate');
            Route::get('/laptopAmi/create', [InvLaptopAmiController::class, 'create'])->name('laptopAmi.create');
            Route::post('/laptopAmi/create', [InvLaptopAmiController::class, 'store'])->name('laptopAmi.store');
            Route::get('/laptopAmi/{id}/edit', [InvLaptopAmiController::class, 'edit'])->name('laptopAmi.edit');
            Route::delete('/laptopAmi/{id}/delete', [InvLaptopAmiController::class, 'destroy'])->name('laptopAmi.delete');
            Route::post('/laptopAmi/update', [InvLaptopAmiController::class, 'update'])->name('laptopAmi.update');
            Route::get('/laptopAmi/{id}/detail', [InvLaptopAmiController::class, 'detail'])->name('laptopAmi.detail');
            Route::post('/uploadCsvNbAmi', [InvLaptopAmiController::class, 'uploadCsv'])->name('laptopAmi.import');

            Route::get('/komputerAmi', [InvComputerAmiController::class, 'index'])->name('komputerAmi.page');
            Route::post('/komputerAmi/generate', [InvComputerAmiController::class, 'generateCode'])->name('komputerAmi.generate');
            Route::get('/komputerAmi/create', [InvComputerAmiController::class, 'create'])->name('komputerAmi.create');
            Route::post('/komputerAmi/create', [InvComputerAmiController::class, 'store'])->name('komputerAmi.store');
            Route::get('/komputerAmi/{id}/edit', [InvComputerAmiController::class, 'edit'])->name('komputerAmi.edit');
            Route::delete('/komputerAmi/{id}/delete', [InvComputerAmiController::class, 'destroy'])->name('komputerAmi.delete');
            Route::post('/komputerAmi/update', [InvComputerAmiController::class, 'update'])->name('komputerAmi.update');
            Route::get('/komputerAmi/{id}/detail', [InvComputerAmiController::class, 'detail'])->name('komputerAmi.detail');
            Route::post('/uploadCsvCuAmi', [InvComputerAmiController::class, 'uploadCsv'])->name('komputerAmi.import');

            Route::get('/printerAmi', [InvPrinterAmiController::class, 'index'])->name(name: 'printerAmi.page');
            Route::get('/printerAmi/create', [InvPrinterAmiController::class, 'create'])->name('printerAmi.create');
            Route::post('/printerAmi/create', [InvPrinterAmiController::class, 'store'])->name('printerAmi.store');
            Route::get('/printerAmi/{id}/edit', [InvPrinterAmiController::class, 'edit'])->name('printerAmi.edit');
            Route::delete('/printerAmi/{id}/delete', [InvPrinterAmiController::class, 'destroy'])->name('printerAmi.delete');
            Route::post('/printerAmi/update', [InvPrinterAmiController::class, 'update'])->name('printerAmi.update');
            Route::get('/printerAmi/{id}/detail', [InvPrinterAmiController::class, 'detail'])->name('printerAmi.detail');
            Route::post('/uploadCsvPrtAmi', [InvPrinterAmiController::class, 'uploadCsv'])->name('printerAmi.import');

            Route::get('/scannerAmi', [InvScannerAmiController::class, 'index'])->name('scannerAmi.page');
            Route::get('/scannerAmi/create', [InvScannerAmiController::class, 'create'])->name('scannerAmi.create');
            Route::post('/scannerAmi/create', [InvScannerAmiController::class, 'store'])->name('scannerAmi.store');
            Route::get('/scannerAmi/{id}/edit', [InvScannerAmiController::class, 'edit'])->name('scannerAmi.edit');
            Route::delete('/scannerAmi/{id}/delete', [InvScannerAmiController::class, 'destroy'])->name('scannerAmi.delete');
            Route::post('/scannerAmi/update', [InvScannerAmiController::class, 'update'])->name('scannerAmi.update');
            Route::get('/scannerAmi/{id}/detail', [InvScannerAmiController::class, 'detail'])->name('scannerAmi.detail');
            Route::post('/uploadCsvScnAmi', [InvScannerAmiController::class, 'uploadCsv'])->name('scannerAmi.import');

            Route::get('/cctvAmi', [InvCctvAmiController::class, 'index'])->name('cctvAmi.page');
            Route::get('/cctvAmi/create', [InvCctvAmiController::class, 'create'])->name('cctvAmi.create');
            Route::post('/cctvAmi/create', [InvCctvAmiController::class, 'store'])->name('cctvAmi.store');
            Route::get('/cctvAmi/{id}/edit', [InvCctvAmiController::class, 'edit'])->name('cctvAmi.edit');
            Route::delete('/cctvAmi/{id}/delete', [InvCctvAmiController::class, 'destroy'])->name('cctvAmi.delete');
            Route::post('/cctvAmi/update', [InvCctvAmiController::class, 'update'])->name('cctvAmi.update');
            Route::get('/cctvAmi/{id}/detail', [InvCctvAmiController::class, 'detail'])->name('cctvAmi.detail');
            Route::post('/uploadCsvCCTVAmi', [InvCctvAmiController::class, 'uploadCsv'])->name('cctvAmi.import');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:PIK,ict_group_leader:PIK,ict_admin:PIK,ict_ho:HO'], function () {
            Route::get('/dashboardSitePik', [DashboardPikController::class, 'index'])->name('dashboardPik.page');

            Route::get('/accessPointSitePik', [InvApPikController::class, 'index'])->name('accessPointPik.page');
            Route::get('/accessPointSitePik/create', [InvApPikController::class, 'create'])->name('accessPointPik.create');
            Route::post('/accessPointSitePik/create', [InvApPikController::class, 'store'])->name('accessPointPik.store');
            Route::post('/accessPointSitePik/generate', [InvApPikController::class, 'generateCode'])->name('accessPointPik.generate');
            Route::post('/accessPointSitePik/generate/edit', [InvApPikController::class, 'generateCodeEdit'])->name('accessPointPik.generateEdit');
            Route::get('/accessPointSitePik/{apId}/edit', [InvApPikController::class, 'edit'])->name('accessPointPik.edit');
            Route::put('/accessPointSitePik/{apId}/update', [InvApPikController::class, 'update'])->name('accessPointPik.update');
            Route::delete('/accessPointSitePik/{apId}/delete', [InvApPikController::class, 'destroy'])->name('accessPointPik.delete');
            Route::get('/accessPointSitePik/{id}/detail', [InvApPikController::class, 'detail'])->name('accessPointPik.detail');
            Route::post('/uploadCsvApPik', [InvApPikController::class, 'uploadCsv'])->name('accessPointPik.import');

            Route::get('/switchPik', [InvSwitchPikController::class, 'index'])->name('switchPik.page');
            Route::get('/switchPik/create', [InvSwitchPikController::class, 'create'])->name('switchPik.create');
            Route::post('/switchPik/create', [InvSwitchPikController::class, 'store'])->name('switchPik.store');
            Route::post('/switchPik/generate', [InvSwitchPikController::class, 'generateCode'])->name('switchPik.generate');
            Route::post('/switchPik/generate/edit', [InvSwitchPikController::class, 'generateCodeEdit'])->name('switchPik.generateEdit');
            Route::get('/switchPik/{swId}/edit', [InvSwitchPikController::class, 'edit'])->name('switchPik.edit');
            Route::put('/switchPik/{swId}/update', [InvSwitchPikController::class, 'update'])->name('switchPik.update');
            Route::delete('/switchPik/{swId}/delete', [InvSwitchPikController::class, 'destroy'])->name('switchPik.delete');
            Route::get('/switchPik/{id}/detail', [InvSwitchPikController::class, 'detail'])->name('switchPik.detail');
            Route::post('/uploadCsvSwPik', [InvSwitchPikController::class, 'uploadCsv'])->name('switchPik.import');

            Route::get('/wirellessPik', [InvWirellessPikController::class, 'index'])->name('wirellessPik.page');
            Route::get('/wirellessPik/create', [InvWirellessPikController::class, 'create'])->name('wirellessPik.create');
            Route::post('/wirellessPik/create', [InvWirellessPikController::class, 'store'])->name('wirellessPik.store');
            Route::get('/wirellessPik/{id}/edit', [InvWirellessPikController::class, 'edit'])->name('wirellessPik.edit');
            Route::put('/wirellessPik/{id}/update', [InvWirellessPikController::class, 'update'])->name('wirellessPik.update');
            Route::delete('/wirellessPik/{id}/delete', [InvWirellessPikController::class, 'destroy'])->name('wirellessPik.delete');
            Route::get('/wirellessPik/{id}/detail', [InvWirellessPikController::class, 'detail'])->name('wirellessPik.detail');
            Route::post('/uploadCsvBbPik', [InvWirellessPikController::class, 'uploadCsv'])->name('wirellessPik.import');

            Route::get('/laptopPik', [InvLaptopPikController::class, 'index'])->name('laptopPik.page');
            Route::post('/laptopPik/generate', [InvLaptopPikController::class, 'generateCode'])->name('laptopPik.generate');
            Route::get('/laptopPik/create', [InvLaptopPikController::class, 'create'])->name('laptopPik.create');
            Route::post('/laptopPik/create', [InvLaptopPikController::class, 'store'])->name('laptopPik.store');
            Route::get('/laptopPik/{id}/edit', [InvLaptopPikController::class, 'edit'])->name('laptopPik.edit');
            Route::delete('/laptopPik/{id}/delete', [InvLaptopPikController::class, 'destroy'])->name('laptopPik.delete');
            Route::post('/laptopPik/update', [InvLaptopPikController::class, 'update'])->name('laptopPik.update');
            Route::get('/laptopPik/{id}/detail', [InvLaptopPikController::class, 'detail'])->name('laptopPik.detail');
            Route::post('/uploadCsvNbPik', [InvLaptopPikController::class, 'uploadCsv'])->name('laptopPik.import');

            Route::get('/komputerPik', [InvComputerPikController::class, 'index'])->name('komputerPik.page');
            Route::post('/komputerPik/generate', [InvComputerPikController::class, 'generateCode'])->name('komputerPik.generate');
            Route::get('/komputerPik/create', [InvComputerPikController::class, 'create'])->name('komputerPik.create');
            Route::post('/komputerPik/create', [InvComputerPikController::class, 'store'])->name('komputerPik.store');
            Route::get('/komputerPik/{id}/edit', [InvComputerPikController::class, 'edit'])->name('komputerPik.edit');
            Route::delete('/komputerPik/{id}/delete', [InvComputerPikController::class, 'destroy'])->name('komputerPik.delete');
            Route::post('/komputerPik/update', [InvComputerPikController::class, 'update'])->name('komputerPik.update');
            Route::get('/komputerPik/{id}/detail', [InvComputerPikController::class, 'detail'])->name('komputerPik.detail');
            Route::post('/uploadCsvCuPik', [InvComputerPikController::class, 'uploadCsv'])->name('komputerPik.import');

            Route::get('/printerPik', [InvPrinterPikController::class, 'index'])->name(name: 'printerPik.page');
            Route::get('/printerPik/create', [InvPrinterPikController::class, 'create'])->name('printerPik.create');
            Route::post('/printerPik/create', [InvPrinterPikController::class, 'store'])->name('printerPik.store');
            Route::get('/printerPik/{id}/edit', [InvPrinterPikController::class, 'edit'])->name('printerPik.edit');
            Route::delete('/printerPik/{id}/delete', [InvPrinterPikController::class, 'destroy'])->name('printerPik.delete');
            Route::post('/printerPik/update', [InvPrinterPikController::class, 'update'])->name('printerPik.update');
            Route::get('/printerPik/{id}/detail', [InvPrinterPikController::class, 'detail'])->name('printerPik.detail');
            Route::post('/uploadCsvPrtPik', [InvPrinterPikController::class, 'uploadCsv'])->name('printerPik.import');

            Route::get('/scannerPik', [InvScannerPikController::class, 'index'])->name('scannerPik.page');
            Route::get('/scannerPik/create', [InvScannerPikController::class, 'create'])->name('scannerPik.create');
            Route::post('/scannerPik/create', [InvScannerPikController::class, 'store'])->name('scannerPik.store');
            Route::get('/scannerPik/{id}/edit', [InvScannerPikController::class, 'edit'])->name('scannerPik.edit');
            Route::delete('/scannerPik/{id}/delete', [InvScannerPikController::class, 'destroy'])->name('scannerPik.delete');
            Route::post('/scannerPik/update', [InvScannerPikController::class, 'update'])->name('scannerPik.update');
            Route::get('/scannerPik/{id}/detail', [InvScannerPikController::class, 'detail'])->name('scannerPik.detail');
            Route::post('/uploadCsvScnPik', [InvScannerPikController::class, 'uploadCsv'])->name('scannerPik.import');

            Route::get('/cctvPik', [InvCctvPikController::class, 'index'])->name('cctvPik.page');
            Route::get('/cctvPik/create', [InvCctvPikController::class, 'create'])->name('cctvPik.create');
            Route::post('/cctvPik/create', [InvCctvPikController::class, 'store'])->name('cctvPik.store');
            Route::get('/cctvPik/{id}/edit', [InvCctvPikController::class, 'edit'])->name('cctvPik.edit');
            Route::delete('/cctvPik/{id}/delete', [InvCctvPikController::class, 'destroy'])->name('cctvPik.delete');
            Route::post('/cctvPik/update', [InvCctvPikController::class, 'update'])->name('cctvPik.update');
            Route::get('/cctvPik/{id}/detail', [InvCctvPikController::class, 'detail'])->name('cctvPik.detail');
            Route::post('/uploadCsvCCTVPik', [InvCctvPikController::class, 'uploadCsv'])->name('cctvPik.import');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_group_leader:BGE,ict_ho:HO'], function () {
            Route::get('/dashboardSiteBge', [DashboardBgeController::class, 'index'])->name('dashboardBge.page');

            Route::get('/accessPointSiteBge', [InvApBgeController::class, 'index'])->name('accessPointBge.page');
            Route::get('/accessPointSiteBge/create', [InvApBgeController::class, 'create'])->name('accessPointBge.create');
            Route::post('/accessPointSiteBge/generate', [InvApBgeController::class, 'generateCode'])->name('accessPointBge.generate');
            Route::post('/accessPointSiteBge/generate/edit', [InvApBgeController::class, 'generateCodeEdit'])->name('accessPointBge.generateEdit');
            Route::post('/accessPointSiteBge/create', [InvApBgeController::class, 'store'])->name('accessPointBge.store');
            Route::get('/accessPointSiteBge/{apId}/edit', [InvApBgeController::class, 'edit'])->name('accessPointBge.edit');
            Route::put('/accessPointSiteBge/{apId}/update', [InvApBgeController::class, 'update'])->name('accessPointBge.update');
            Route::delete('/accessPointSiteBge/{apId}/delete', [InvApBgeController::class, 'destroy'])->name('accessPointBge.delete');
            Route::get('/accessPointSiteBge/{id}/detail', [InvApBgeController::class, 'detail'])->name('accessPointBge.detail');
            Route::post('/uploadCsvApBge', [InvApBgeController::class, 'uploadCsv'])->name('accessPointBge.import');

            Route::get('/switchBge', [InvSwitchBgeController::class, 'index'])->name('switchBge.page');
            Route::get('/switchBge/create', [InvSwitchBgeController::class, 'create'])->name('switchBge.create');
            Route::post('/switchBge/create', [InvSwitchBgeController::class, 'store'])->name('switchBge.store');
            Route::post('/switchBge/generate', [InvSwitchBgeController::class, 'generateCode'])->name('switchBge.generate');
            Route::post('/switchBge/generate/edit', [InvSwitchBgeController::class, 'generateCodeEdit'])->name('switchBge.generateEdit');
            Route::get('/switchBge/{swId}/edit', [InvSwitchBgeController::class, 'edit'])->name('switchBge.edit');
            Route::put('/switchBge/{swId}/update', [InvSwitchBgeController::class, 'update'])->name('switchBge.update');
            Route::delete('/switchBge/{swId}/delete', [InvSwitchBgeController::class, 'destroy'])->name('switchBge.delete');
            Route::get('/switchBge/{id}/detail', [InvSwitchBgeController::class, 'detail'])->name('switchBge.detail');
            Route::post('/uploadCsvSwBge', [InvSwitchBgeController::class, 'uploadCsv'])->name('switchBge.import');

            Route::get('/wirellessBge', [InvWirellessBgeController::class, 'index'])->name('wirellessBge.page');
            Route::get('/wirellessBge/create', [InvWirellessBgeController::class, 'create'])->name('wirellessBge.create');
            Route::post('/wirellessBge/create', [InvWirellessBgeController::class, 'store'])->name('wirellessBge.store');
            Route::post('/wirellessBge/generate', [InvWirellessBgeController::class, 'generateCode'])->name('wirellessBge.generate');
            Route::post('/wirellessBge/generate/edit', [InvWirellessBgeController::class, 'generateCodeEdit'])->name('wirellessBge.generateEdit');
            Route::get('/wirellessBge/{id}/edit', [InvWirellessBgeController::class, 'edit'])->name('wirellessBge.edit');
            Route::put('/wirellessBge/{id}/update', [InvWirellessBgeController::class, 'update'])->name('wirellessBge.update');
            Route::delete('/wirellessBge/{id}/delete', [InvWirellessBgeController::class, 'destroy'])->name('wirellessBge.delete');
            Route::get('/wirellessBge/{id}/detail', [InvWirellessBgeController::class, 'detail'])->name('wirellessBge.detail');
            Route::post('/uploadCsvBbBge', [InvWirellessBgeController::class, 'uploadCsv'])->name('wirellessBge.import');

            Route::get('/laptopBge', [InvLaptopBgeController::class, 'index'])->name('laptopBge.page');
            Route::post('/laptopBge/generate', [InvLaptopBgeController::class, 'generateCode'])->name('laptopBge.generate');
            Route::get('/laptopBge/create', [InvLaptopBgeController::class, 'create'])->name('laptopBge.create');
            Route::post('/laptopBge/create', [InvLaptopBgeController::class, 'store'])->name('laptopBge.store');
            Route::get('/laptopBge/{id}/edit', [InvLaptopBgeController::class, 'edit'])->name('laptopBge.edit');
            Route::delete('/laptopBge/{id}/delete', [InvLaptopBgeController::class, 'destroy'])->name('laptopBge.delete');
            Route::post('/laptopBge/update', [InvLaptopBgeController::class, 'update'])->name('laptopBge.update');
            Route::get('/laptopBge/{id}/detail', [InvLaptopBgeController::class, 'detail'])->name('laptopBge.detail');
            Route::post('/uploadCsvNbBge', [InvLaptopBgeController::class, 'uploadCsv'])->name('laptopBge.import');

            Route::get('/komputerBge', [InvComputerBgeController::class, 'index'])->name('komputerBge.page');
            Route::post('/komputerBge/generate', [InvComputerBgeController::class, 'generateCode'])->name('komputerBge.generate');
            Route::get('/komputerBge/create', [InvComputerBgeController::class, 'create'])->name('komputerBge.create');
            Route::post('/komputerBge/create', [InvComputerBgeController::class, 'store'])->name('komputerBge.store');
            Route::get('/komputerBge/{id}/edit', [InvComputerBgeController::class, 'edit'])->name('komputerBge.edit');
            Route::delete('/komputerBge/{id}/delete', [InvComputerBgeController::class, 'destroy'])->name('komputerBge.delete');
            Route::post('/komputerBge/update', [InvComputerBgeController::class, 'update'])->name('komputerBge.update');
            Route::get('/komputerBge/{id}/detail', [InvComputerBgeController::class, 'detail'])->name('komputerBge.detail');
            Route::post('/uploadCsvCuBge', [InvComputerBgeController::class, 'uploadCsv'])->name('komputerBge.import');

            Route::get('/printerBge', [InvPrinterBgeController::class, 'index'])->name(name: 'printerBge.page');
            Route::get('/printerBge/create', [InvPrinterBgeController::class, 'create'])->name('printerBge.create');
            Route::post('/printerBge/create', [InvPrinterBgeController::class, 'store'])->name('printerBge.store');
            Route::get('/printerBge/{id}/edit', [InvPrinterBgeController::class, 'edit'])->name('printerBge.edit');
            Route::delete('/printerBge/{id}/delete', [InvPrinterBgeController::class, 'destroy'])->name('printerBge.delete');
            Route::post('/printerBge/update', [InvPrinterBgeController::class, 'update'])->name('printerBge.update');
            Route::get('/printerBge/{id}/detail', [InvPrinterBgeController::class, 'detail'])->name('printerBge.detail');
            Route::post('/uploadCsvPrtBge', [InvPrinterBgeController::class, 'uploadCsv'])->name('printerBge.import');

            Route::get('/scannerBge', [InvScannerBgeController::class, 'index'])->name('scannerBge.page');
            Route::get('/scannerBge/create', [InvScannerBgeController::class, 'create'])->name('scannerBge.create');
            Route::post('/scannerBge/create', [InvScannerBgeController::class, 'store'])->name('scannerBge.store');
            Route::get('/scannerBge/{id}/edit', [InvScannerBgeController::class, 'edit'])->name('scannerBge.edit');
            Route::delete('/scannerBge/{id}/delete', [InvScannerBgeController::class, 'destroy'])->name('scannerBge.delete');
            Route::post('/scannerBge/update', [InvScannerBgeController::class, 'update'])->name('scannerBge.update');
            Route::get('/scannerBge/{id}/detail', [InvScannerBgeController::class, 'detail'])->name('scannerBge.detail');
            Route::post('/uploadCsvScnBge', [InvScannerBgeController::class, 'uploadCsv'])->name('scannerBge.import');

            Route::get('/cctvBge', [InvCctvBgeController::class, 'index'])->name('cctvBge.page');
            Route::get('/cctvBge/create', [InvCctvBgeController::class, 'create'])->name('cctvBge.create');
            Route::post('/cctvBge/create', [InvCctvBgeController::class, 'store'])->name('cctvBge.store');
            Route::get('/cctvBge/{id}/edit', [InvCctvBgeController::class, 'edit'])->name('cctvBge.edit');
            Route::delete('/cctvBge/{id}/delete', [InvCctvBgeController::class, 'destroy'])->name('cctvBge.delete');
            Route::post('/cctvBge/update', [InvCctvBgeController::class, 'update'])->name('cctvBge.update');
            Route::get('/cctvBge/{id}/detail', [InvCctvBgeController::class, 'detail'])->name('cctvBge.detail');
            Route::post('/uploadCsvCCTVBge', [InvCctvBgeController::class, 'uploadCsv'])->name('cctvBge.import');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:BIB,ict_group_leader:BIB,ict_admin:BIB,ict_ho:HO'], function () {
            Route::get('/dashboardSiteBib', [DashboardBibController::class, 'index'])->name('dashboardBib.page');

            Route::get('/accessPointSiteBib', [InvApBibController::class, 'index'])->name('accessPointBib.page');
            Route::get('/accessPointSiteBib/create', [InvApBibController::class, 'create'])->name('accessPointBib.create');
            Route::post('/accessPointSiteBib/generate', [InvApBibController::class, 'generateCode'])->name('accessPointBib.generate');
            Route::post('/accessPointSiteBib/generate/edit', [InvApBibController::class, 'generateCodeEdit'])->name('accessPointBib.generateEdit');
            Route::post('/accessPointSiteBib/create', [InvApBibController::class, 'store'])->name('accessPointBib.store');
            Route::get('/accessPointSiteBib/{apId}/edit', [InvApBibController::class, 'edit'])->name('accessPointBib.edit');
            Route::put('/accessPointSiteBib/{apId}/update', [InvApBibController::class, 'update'])->name('accessPointBib.update');
            Route::delete('/accessPointSiteBib/{apId}/delete', [InvApBibController::class, 'destroy'])->name('accessPointBib.delete');
            Route::get('/accessPointSiteBib/{id}/detail', [InvApBibController::class, 'detail'])->name('accessPointBib.detail');
            Route::post('/uploadCsvApBib', [InvApBibController::class, 'uploadCsv'])->name('accessPointBib.import');

            Route::get('/switchBib', [InvSwitchBibController::class, 'index'])->name('switchBib.page');
            Route::get('/switchBib/create', [InvSwitchBibController::class, 'create'])->name('switchBib.create');
            Route::post('/switchBib/create', [InvSwitchBibController::class, 'store'])->name('switchBib.store');
            Route::post('/switchBib/generate', [InvSwitchBibController::class, 'generateCode'])->name('switchBib.generate');
            Route::post('/switchBib/generate/edit', [InvSwitchBibController::class, 'generateCodeEdit'])->name('switchBib.generateEdit');
            Route::get('/switchBib/{swId}/edit', [InvSwitchBibController::class, 'edit'])->name('switchBib.edit');
            Route::put('/switchBib/{swId}/update', [InvSwitchBibController::class, 'update'])->name('switchBib.update');
            Route::delete('/switchBib/{swId}/delete', [InvSwitchBibController::class, 'destroy'])->name('switchBib.delete');
            Route::get('/switchBib/{id}/detail', [InvSwitchBibController::class, 'detail'])->name('switchBib.detail');
            Route::post('/uploadCsvSwBib', [InvSwitchBibController::class, 'uploadCsv'])->name('switchBib.import');

            Route::get('/wirellessBib', [InvWirellessBibController::class, 'index'])->name('wirellessBib.page');
            Route::get('/wirellessBib/create', [InvWirellessBibController::class, 'create'])->name('wirellessBib.create');
            Route::post('/wirellessBib/create', [InvWirellessBibController::class, 'store'])->name('wirellessBib.store');
            Route::post('/wirellessBib/generate', [InvWirellessBibController::class, 'generateCode'])->name('wirellessBib.generate');
            Route::post('/wirellessBib/generate/edit', [InvWirellessBibController::class, 'generateCodeEdit'])->name('wirellessBib.generateEdit');
            Route::get('/wirellessBib/{id}/edit', [InvWirellessBibController::class, 'edit'])->name('wirellessBib.edit');
            Route::put('/wirellessBib/{id}/update', [InvWirellessBibController::class, 'update'])->name('wirellessBib.update');
            Route::delete('/wirellessBib/{id}/delete', [InvWirellessBibController::class, 'destroy'])->name('wirellessBib.delete');
            Route::get('/wirellessBib/{id}/detail', [InvWirellessBibController::class, 'detail'])->name('wirellessBib.detail');
            Route::post('/uploadCsvBbBib', [InvWirellessBibController::class, 'uploadCsv'])->name('wirellessBib.import');

            Route::get('/laptopBib', [InvLaptopBibController::class, 'index'])->name('laptopBib.page');
            Route::post('/laptopBib/generate', [InvLaptopBibController::class, 'generateCode'])->name('laptopBib.generate');
            Route::get('/laptopBib/create', [InvLaptopBibController::class, 'create'])->name('laptopBib.create');
            Route::post('/laptopBib/create', [InvLaptopBibController::class, 'store'])->name('laptopBib.store');
            Route::get('/laptopBib/{id}/edit', [InvLaptopBibController::class, 'edit'])->name('laptopBib.edit');
            Route::delete('/laptopBib/{id}/delete', [InvLaptopBibController::class, 'destroy'])->name('laptopBib.delete');
            Route::post('/laptopBib/update', [InvLaptopBibController::class, 'update'])->name('laptopBib.update');
            Route::get('/laptopBib/{id}/detail', [InvLaptopBibController::class, 'detail'])->name('laptopBib.detail');
            Route::post('/uploadCsvNbBib', [InvLaptopBibController::class, 'uploadCsv'])->name('laptopBib.import');

            Route::get('/komputerBib', [InvComputerBibController::class, 'index'])->name('komputerBib.page');
            Route::post('/komputerBib/generate', [InvComputerBibController::class, 'generateCode'])->name('komputerBib.generate');
            Route::get('/komputerBib/create', [InvComputerBibController::class, 'create'])->name('komputerBib.create');
            Route::post('/komputerBib/create', [InvComputerBibController::class, 'store'])->name('komputerBib.store');
            Route::get('/komputerBib/{id}/edit', [InvComputerBibController::class, 'edit'])->name('komputerBib.edit');
            Route::delete('/komputerBib/{id}/delete', [InvComputerBibController::class, 'destroy'])->name('komputerBib.delete');
            Route::post('/komputerBib/update', [InvComputerBibController::class, 'update'])->name('komputerBib.update');
            Route::get('/komputerBib/{id}/detail', [InvComputerBibController::class, 'detail'])->name('komputerBib.detail');
            Route::post('/uploadCsvCuBib', [InvComputerBibController::class, 'uploadCsv'])->name('komputerBib.import');

            Route::get('/printerBib', [InvPrinterBibController::class, 'index'])->name(name: 'printerBib.page');
            Route::get('/printerBib/create', [InvPrinterBibController::class, 'create'])->name('printerBib.create');
            Route::post('/printerBib/create', [InvPrinterBibController::class, 'store'])->name('printerBib.store');
            Route::get('/printerBib/{id}/edit', [InvPrinterBibController::class, 'edit'])->name('printerBib.edit');
            Route::delete('/printerBib/{id}/delete', [InvPrinterBibController::class, 'destroy'])->name('printerBib.delete');
            Route::post('/printerBib/update', [InvPrinterBibController::class, 'update'])->name('printerBib.update');
            Route::get('/printerBib/{id}/detail', [InvPrinterBibController::class, 'detail'])->name('printerBib.detail');
            Route::post('/uploadCsvPrtBib', [InvPrinterBibController::class, 'uploadCsv'])->name('printerBib.import');

            Route::get('/scannerBib', [InvScannerBibController::class, 'index'])->name('scannerBib.page');
            Route::get('/scannerBib/create', [InvScannerBibController::class, 'create'])->name('scannerBib.create');
            Route::post('/scannerBib/create', [InvScannerBibController::class, 'store'])->name('scannerBib.store');
            Route::get('/scannerBib/{id}/edit', [InvScannerBibController::class, 'edit'])->name('scannerBib.edit');
            Route::delete('/scannerBib/{id}/delete', [InvScannerBibController::class, 'destroy'])->name('scannerBib.delete');
            Route::post('/scannerBib/update', [InvScannerBibController::class, 'update'])->name('scannerBib.update');
            Route::get('/scannerBib/{id}/detail', [InvScannerBibController::class, 'detail'])->name('scannerBib.detail');
            Route::post('/uploadCsvScnBib', [InvScannerBibController::class, 'uploadCsv'])->name('scannerBib.import');

            Route::get('/cctvBib', [InvCctvBibController::class, 'index'])->name('cctvBib.page');
            Route::get('/cctvBib/create', [InvCctvBibController::class, 'create'])->name('cctvBib.create');
            Route::post('/cctvBib/create', [InvCctvBibController::class, 'store'])->name('cctvBib.store');
            Route::get('/cctvBib/{id}/edit', [InvCctvBibController::class, 'edit'])->name('cctvBib.edit');
            Route::delete('/cctvBib/{id}/delete', [InvCctvBibController::class, 'destroy'])->name('cctvBib.delete');
            Route::post('/cctvBib/update', [InvCctvBibController::class, 'update'])->name('cctvBib.update');
            Route::get('/cctvBib/{id}/detail', [InvCctvBibController::class, 'detail'])->name('cctvBib.detail');
            Route::post('/uploadCsvCCTVBib', [InvCctvBibController::class, 'uploadCsv'])->name('cctvBib.import');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:IPT,ict_group_leader:IPT,ict_admin:IPT,ict_ho:HO'], function () {
            Route::get('/dashboardSiteIpt', [DashboardIptController::class, 'index'])->name('dashboardIpt.page');

            Route::get('/accessPointSiteIpt', [InvApIptController::class, 'index'])->name('accessPointIpt.page');
            Route::get('/accessPointSiteIpt/create', [InvApIptController::class, 'create'])->name('accessPointIpt.create');
            Route::post('/accessPointSiteIpt/generate', [InvApIptController::class, 'generateCode'])->name('accessPointIpt.generate');
            Route::post('/accessPointSiteIpt/generate/edit', [InvApIptController::class, 'generateCodeEdit'])->name('accessPointIpt.generateEdit');
            Route::post('/accessPointSiteIpt/create', [InvApIptController::class, 'store'])->name('accessPointIpt.store');
            Route::get('/accessPointSiteIpt/{apId}/edit', [InvApIptController::class, 'edit'])->name('accessPointIpt.edit');
            Route::put('/accessPointSiteIpt/{apId}/update', [InvApIptController::class, 'update'])->name('accessPointIpt.update');
            Route::delete('/accessPointSiteIpt/{apId}/delete', [InvApIptController::class, 'destroy'])->name('accessPointIpt.delete');
            Route::get('/accessPointSiteIpt/{id}/detail', [InvApIptController::class, 'detail'])->name('accessPointIpt.detail');
            Route::post('/uploadCsvApIpt', [InvApIptController::class, 'uploadCsv'])->name('accessPointIpt.import');

            Route::get('/switchIpt', [InvSwitchIptController::class, 'index'])->name('switchIpt.page');
            Route::get('/switchIpt/create', [InvSwitchIptController::class, 'create'])->name('switchIpt.create');
            Route::post('/switchIpt/create', [InvSwitchIptController::class, 'store'])->name('switchIpt.store');
            Route::post('/switchIpt/generate', [InvSwitchIptController::class, 'generateCode'])->name('switchIpt.generate');
            Route::post('/switchIpt/generate/edit', [InvSwitchIptController::class, 'generateCodeEdit'])->name('switchIpt.generateEdit');
            Route::get('/switchIpt/{swId}/edit', [InvSwitchIptController::class, 'edit'])->name('switchIpt.edit');
            Route::put('/switchIpt/{swId}/update', [InvSwitchIptController::class, 'update'])->name('switchIpt.update');
            Route::delete('/switchIpt/{swId}/delete', [InvSwitchIptController::class, 'destroy'])->name('switchIpt.delete');
            Route::get('/switchIpt/{id}/detail', [InvSwitchIptController::class, 'detail'])->name('switchIpt.detail');
            Route::post('/uploadCsvSwIpt', [InvSwitchIptController::class, 'uploadCsv'])->name('switchIpt.import');

            Route::get('/wirellessIpt', [InvWirellessIptController::class, 'index'])->name('wirellessIpt.page');
            Route::get('/wirellessIpt/create', [InvWirellessIptController::class, 'create'])->name('wirellessIpt.create');
            Route::post('/wirellessIpt/create', [InvWirellessIptController::class, 'store'])->name('wirellessIpt.store');
            Route::get('/wirellessIpt/{id}/edit', [InvWirellessIptController::class, 'edit'])->name('wirellessIpt.edit');
            Route::put('/wirellessIpt/{id}/update', [InvWirellessIptController::class, 'update'])->name('wirellessIpt.update');
            Route::delete('/wirellessIpt/{id}/delete', [InvWirellessIptController::class, 'destroy'])->name('wirellessIpt.delete');
            Route::get('/wirellessIpt/{id}/detail', [InvWirellessIptController::class, 'detail'])->name('wirellessIpt.detail');
            Route::post('/uploadCsvBbIpt', [InvWirellessIptController::class, 'uploadCsv'])->name('wirellessIpt.import');

            Route::get('/laptopIpt', [InvLaptopIptController::class, 'index'])->name('laptopIpt.page');
            Route::post('/laptopIpt/generate', [InvLaptopIptController::class, 'generateCode'])->name('laptopIpt.generate');
            Route::get('/laptopIpt/create', [InvLaptopIptController::class, 'create'])->name('laptopIpt.create');
            Route::post('/laptopIpt/create', [InvLaptopIptController::class, 'store'])->name('laptopIpt.store');
            Route::get('/laptopIpt/{id}/edit', [InvLaptopIptController::class, 'edit'])->name('laptopIpt.edit');
            Route::delete('/laptopIpt/{id}/delete', [InvLaptopIptController::class, 'destroy'])->name('laptopIpt.delete');
            Route::post('/laptopIpt/update', [InvLaptopIptController::class, 'update'])->name('laptopIpt.update');
            Route::get('/laptopIpt/{id}/detail', [InvLaptopIptController::class, 'detail'])->name('laptopIpt.detail');
            Route::post('/uploadCsvNbIpt', [InvLaptopIptController::class, 'uploadCsv'])->name('laptopIpt.import');

            Route::get('/komputerIpt', [InvComputerIptController::class, 'index'])->name('komputerIpt.page');
            Route::post('/komputerIpt/generate', [InvComputerIptController::class, 'generateCode'])->name('komputerIpt.generate');
            Route::get('/komputerIpt/create', [InvComputerIptController::class, 'create'])->name('komputerIpt.create');
            Route::post('/komputerIpt/create', [InvComputerIptController::class, 'store'])->name('komputerIpt.store');
            Route::get('/komputerIpt/{id}/edit', [InvComputerIptController::class, 'edit'])->name('komputerIpt.edit');
            Route::delete('/komputerIpt/{id}/delete', [InvComputerIptController::class, 'destroy'])->name('komputerIpt.delete');
            Route::post('/komputerIpt/update', [InvComputerIptController::class, 'update'])->name('komputerIpt.update');
            Route::get('/komputerIpt/{id}/detail', [InvComputerIptController::class, 'detail'])->name('komputerIpt.detail');
            Route::post('/uploadCsvCuIpt', [InvComputerIptController::class, 'uploadCsv'])->name('komputerIpt.import');

            Route::get('/printerIpt', [InvPrinterIptController::class, 'index'])->name(name: 'printerIpt.page');
            Route::get('/printerIpt/create', [InvPrinterIptController::class, 'create'])->name('printerIpt.create');
            Route::post('/printerIpt/create', [InvPrinterIptController::class, 'store'])->name('printerIpt.store');
            Route::get('/printerIpt/{id}/edit', [InvPrinterIptController::class, 'edit'])->name('printerIpt.edit');
            Route::delete('/printerIpt/{id}/delete', [InvPrinterIptController::class, 'destroy'])->name('printerIpt.delete');
            Route::post('/printerIpt/update', [InvPrinterIptController::class, 'update'])->name('printerIpt.update');
            Route::get('/printerIpt/{id}/detail', [InvPrinterIptController::class, 'detail'])->name('printerIpt.detail');
            Route::post('/uploadCsvPrtIpt', [InvPrinterIptController::class, 'uploadCsv'])->name('printerIpt.import');

            Route::get('/scannerIpt', [InvScannerIptController::class, 'index'])->name('scannerIpt.page');
            Route::get('/scannerIpt/create', [InvScannerIptController::class, 'create'])->name('scannerIpt.create');
            Route::post('/scannerIpt/create', [InvScannerIptController::class, 'store'])->name('scannerIpt.store');
            Route::get('/scannerIpt/{id}/edit', [InvScannerIptController::class, 'edit'])->name('scannerIpt.edit');
            Route::delete('/scannerIpt/{id}/delete', [InvScannerIptController::class, 'destroy'])->name('scannerIpt.delete');
            Route::post('/scannerIpt/update', [InvScannerIptController::class, 'update'])->name('scannerIpt.update');
            Route::get('/scannerIpt/{id}/detail', [InvScannerIptController::class, 'detail'])->name('scannerIpt.detail');
            Route::post('/uploadCsvScnIpt', [InvScannerIptController::class, 'uploadCsv'])->name('scannerIpt.import');

            Route::get('/cctvIpt', [InvCctvIptController::class, 'index'])->name('cctvIpt.page');
            Route::get('/cctvIpt/create', [InvCctvIptController::class, 'create'])->name('cctvIpt.create');
            Route::post('/cctvIpt/create', [InvCctvIptController::class, 'store'])->name('cctvIpt.store');
            Route::get('/cctvIpt/{id}/edit', [InvCctvIptController::class, 'edit'])->name('cctvIpt.edit');
            Route::delete('/cctvIpt/{id}/delete', [InvCctvIptController::class, 'destroy'])->name('cctvIpt.delete');
            Route::post('/cctvIpt/update', [InvCctvIptController::class, 'update'])->name('cctvIpt.update');
            Route::get('/cctvIpt/{id}/detail', [InvCctvIptController::class, 'detail'])->name('cctvIpt.detail');
            Route::post('/uploadCsvCCTVIpt', [InvCctvIptController::class, 'uploadCsv'])->name('cctvIpt.import');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:MLP,ict_group_leader:MLP,ict_admin:MLP,ict_ho:HO'], function () {
            Route::get('/dashboardSiteMlp', [DashboardMlpController::class, 'index'])->name('dashboardMlp.page');

            Route::get('/accessPointSiteMlp', [InvApMlpController::class, 'index'])->name('accessPointMlp.page');
            Route::get('/accessPointSiteMlp/create', [InvApMlpController::class, 'create'])->name('accessPointMlp.create');
            Route::post('/accessPointSiteMlp/create', [InvApMlpController::class, 'store'])->name('accessPointMlp.store');
            Route::post('/accessPointSiteMlp/generate', [InvApMlpController::class, 'generateCode'])->name('accessPointMlp.generate');
            Route::post('/accessPointSiteMlp/generate/edit', [InvApMlpController::class, 'generateCodeEdit'])->name('accessPointMlp.generateEdit');
            Route::get('/accessPointSiteMlp/{apId}/edit', [InvApMlpController::class, 'edit'])->name('accessPointMlp.edit');
            Route::put('/accessPointSiteMlp/{apId}/update', [InvApMlpController::class, 'update'])->name('accessPointMlp.update');
            Route::delete('/accessPointSiteMlp/{apId}/delete', [InvApMlpController::class, 'destroy'])->name('accessPointMlp.delete');
            Route::get('/accessPointSiteMlp/{id}/detail', [InvApMlpController::class, 'detail'])->name('accessPointMlp.detail');
            Route::post('/uploadCsvApMlp', [InvApMlpController::class, 'uploadCsv'])->name('accessPointMlp.import');

            Route::get('/switchMlp', [InvSwitchMlpController::class, 'index'])->name('switchMlp.page');
            Route::get('/switchMlp/create', [InvSwitchMlpController::class, 'create'])->name('switchMlp.create');
            Route::post('/switchMlp/create', [InvSwitchMlpController::class, 'store'])->name('switchMlp.store');
            Route::post('/switchMlp/generate', [InvSwitchMlpController::class, 'generateCode'])->name('switchMlp.generate');
            Route::post('/switchMlp/generate/edit', [InvSwitchMlpController::class, 'generateCodeEdit'])->name('switchMlp.generateEdit');
            Route::get('/switchMlp/{swId}/edit', [InvSwitchMlpController::class, 'edit'])->name('switchMlp.edit');
            Route::put('/switchMlp/{swId}/update', [InvSwitchMlpController::class, 'update'])->name('switchMlp.update');
            Route::delete('/switchMlp/{swId}/delete', [InvSwitchMlpController::class, 'destroy'])->name('switchMlp.delete');
            Route::get('/switchMlp/{id}/detail', [InvSwitchMlpController::class, 'detail'])->name('switchMlp.detail');
            Route::post('/uploadCsvSwMlp', [InvSwitchMlpController::class, 'uploadCsv'])->name('switchMlp.import');

            Route::get('/wirellessMlp', [InvWirellessMlpController::class, 'index'])->name('wirellessMlp.page');
            Route::get('/wirellessMlp/create', [InvWirellessMlpController::class, 'create'])->name('wirellessMlp.create');
            Route::post('/wirellessMlp/create', [InvWirellessMlpController::class, 'store'])->name('wirellessMlp.store');
            Route::get('/wirellessMlp/{id}/edit', [InvWirellessMlpController::class, 'edit'])->name('wirellessMlp.edit');
            Route::put('/wirellessMlp/{id}/update', [InvWirellessMlpController::class, 'update'])->name('wirellessMlp.update');
            Route::delete('/wirellessMlp/{id}/delete', [InvWirellessMlpController::class, 'destroy'])->name('wirellessMlp.delete');
            Route::get('/wirellessMlp/{id}/detail', [InvWirellessMlpController::class, 'detail'])->name('wirellessMlp.detail');
            Route::post('/uploadCsvBbMlp', [InvWirellessMlpController::class, 'uploadCsv'])->name('wirellessMlp.import');

            Route::get('/laptopMlp', [InvLaptopMlpController::class, 'index'])->name('laptopMlp.page');
            Route::post('/laptopMlp/generate', [InvLaptopMlpController::class, 'generateCode'])->name('laptopMlp.generate');
            Route::get('/laptopMlp/create', [InvLaptopMlpController::class, 'create'])->name('laptopMlp.create');
            Route::post('/laptopMlp/create', [InvLaptopMlpController::class, 'store'])->name('laptopMlp.store');
            Route::get('/laptopMlp/{id}/edit', [InvLaptopMlpController::class, 'edit'])->name('laptopMlp.edit');
            Route::delete('/laptopMlp/{id}/delete', [InvLaptopMlpController::class, 'destroy'])->name('laptopMlp.delete');
            Route::post('/laptopMlp/update', [InvLaptopMlpController::class, 'update'])->name('laptopMlp.update');
            Route::get('/laptopMlp/{id}/detail', [InvLaptopMlpController::class, 'detail'])->name('laptopMlp.detail');
            Route::post('/uploadCsvNbMlp', [InvLaptopMlpController::class, 'uploadCsv'])->name('laptopMlp.import');

            Route::get('/komputerMlp', [InvComputerMlpController::class, 'index'])->name('komputerMlp.page');
            Route::post('/komputerMlp/generate', [InvComputerMlpController::class, 'generateCode'])->name('komputerMlp.generate');
            Route::get('/komputerMlp/create', [InvComputerMlpController::class, 'create'])->name('komputerMlp.create');
            Route::post('/komputerMlp/create', [InvComputerMlpController::class, 'store'])->name('komputerMlp.store');
            Route::get('/komputerMlp/{id}/edit', [InvComputerMlpController::class, 'edit'])->name('komputerMlp.edit');
            Route::delete('/komputerMlp/{id}/delete', [InvComputerMlpController::class, 'destroy'])->name('komputerMlp.delete');
            Route::post('/komputerMlp/update', [InvComputerMlpController::class, 'update'])->name('komputerMlp.update');
            Route::get('/komputerMlp/{id}/detail', [InvComputerMlpController::class, 'detail'])->name('komputerMlp.detail');
            Route::post('/uploadCsvCuIMlp', [InvComputerMlpController::class, 'uploadCsv'])->name('komputerMlp.import');

            Route::get('/printerMlp', [InvPrinterMlpController::class, 'index'])->name(name: 'printerMlp.page');
            Route::get('/printerMlp/create', [InvPrinterMlpController::class, 'create'])->name('printerMlp.create');
            Route::post('/printerMlp/create', [InvPrinterMlpController::class, 'store'])->name('printerMlp.store');
            Route::get('/printerMlp/{id}/edit', [InvPrinterMlpController::class, 'edit'])->name('printerMlp.edit');
            Route::delete('/printerMlp/{id}/delete', [InvPrinterMlpController::class, 'destroy'])->name('printerMlp.delete');
            Route::post('/printerMlp/update', [InvPrinterMlpController::class, 'update'])->name('printerMlp.update');
            Route::get('/printerMlp/{id}/detail', [InvPrinterMlpController::class, 'detail'])->name('printerMlp.detail');
            Route::post('/uploadCsvPrtMlp', [InvPrinterMlpController::class, 'uploadCsv'])->name('printerMlp.import');

            Route::get('/scannerMlp', [InvScannerMlpController::class, 'index'])->name('scannerMlp.page');
            Route::get('/scannerMlp/create', [InvScannerMlpController::class, 'create'])->name('scannerMlp.create');
            Route::post('/scannerMlp/create', [InvScannerMlpController::class, 'store'])->name('scannerMlp.store');
            Route::get('/scannerMlp/{id}/edit', [InvScannerMlpController::class, 'edit'])->name('scannerMlp.edit');
            Route::delete('/scannerMlp/{id}/delete', [InvScannerMlpController::class, 'destroy'])->name('scannerMlp.delete');
            Route::post('/scannerMlp/update', [InvScannerMlpController::class, 'update'])->name('scannerMlp.update');
            Route::get('/scannerMlp/{id}/detail', [InvScannerMlpController::class, 'detail'])->name('scannerMlp.detail');
            Route::post('/uploadCsvScnMlp', [InvScannerMlpController::class, 'uploadCsv'])->name('scannerMlp.import');

            Route::get('/cctvMlp', [InvCctvMlpController::class, 'index'])->name('cctvMlp.page');
            Route::get('/cctvMlp/create', [InvCctvMlpController::class, 'create'])->name('cctvMlp.create');
            Route::post('/cctvMlp/create', [InvCctvMlpController::class, 'store'])->name('cctvMlp.store');
            Route::get('/cctvMlp/{id}/edit', [InvCctvMlpController::class, 'edit'])->name('cctvMlp.edit');
            Route::delete('/cctvMlp/{id}/delete', [InvCctvMlpController::class, 'destroy'])->name('cctvMlp.delete');
            Route::post('/cctvMlp/update', [InvCctvMlpController::class, 'update'])->name('cctvMlp.update');
            Route::get('/cctvMlp/{id}/detail', [InvCctvMlpController::class, 'detail'])->name('cctvMlp.detail');
            Route::post('/uploadCsvCCTVMlp', [InvCctvMlpController::class, 'uploadCsv'])->name('cctvMlp.import');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:MIP,ict_group_leader:MIP,ict_admin:MIP,ict_ho:HO'], function () {
            Route::get('/dashboardSiteMip', [DashboardMipController::class, 'index'])->name('dashboardMip.page');

            Route::get('/accessPointSiteMip', [InvApMipController::class, 'index'])->name('accessPointMip.page');
            Route::get('/accessPointSiteMip/create', [InvApMipController::class, 'create'])->name('accessPointMip.create');
            Route::post('/accessPointSiteMip/create', [InvApMipController::class, 'store'])->name('accessPointMip.store');
            Route::post('/accessPointSiteMip/generate', [InvApMipController::class, 'generateCode'])->name('accessPointMip.generate');
            Route::post('/accessPointSiteMip/generate/edit', [InvApMipController::class, 'generateCodeEdit'])->name('accessPointMip.generateEdit');
            Route::get('/accessPointSiteMip/{apId}/edit', [InvApMipController::class, 'edit'])->name('accessPointMip.edit');
            Route::put('/accessPointSiteMip/{apId}/update', [InvApMipController::class, 'update'])->name('accessPointMip.update');
            Route::delete('/accessPointSiteMip/{apId}/delete', [InvApMipController::class, 'destroy'])->name('accessPointMip.delete');
            Route::get('/accessPointSiteMip/{id}/detail', [InvApMipController::class, 'detail'])->name('accessPointMip.detail');
            Route::post('/uploadCsvApMip', [InvApMipController::class, 'uploadCsv'])->name('accessPointMip.import');

            Route::get('/switchMip', [InvSwitchMipController::class, 'index'])->name('switchMip.page');
            Route::get('/switchMip/create', [InvSwitchMipController::class, 'create'])->name('switchMip.create');
            Route::post('/switchMip/create', [InvSwitchMipController::class, 'store'])->name('switchMip.store');
            Route::post('/switchMip/generate', [InvSwitchMipController::class, 'generateCode'])->name('switchMip.generate');
            Route::post('/switchMip/generate/edit', [InvSwitchMipController::class, 'generateCodeEdit'])->name('switchMip.generateEdit');
            Route::get('/switchMip/{swId}/edit', [InvSwitchMipController::class, 'edit'])->name('switchMip.edit');
            Route::put('/switchMip/{swId}/update', [InvSwitchMipController::class, 'update'])->name('switchMip.update');
            Route::delete('/switchMip/{swId}/delete', [InvSwitchMipController::class, 'destroy'])->name('switchMip.delete');
            Route::get('/switchMip/{id}/detail', [InvSwitchMipController::class, 'detail'])->name('switchMip.detail');
            Route::post('/uploadCsvSwMip', [InvSwitchMipController::class, 'uploadCsv'])->name('switchMip.import');

            Route::get('/wirellessMip', [InvWirellessMipController::class, 'index'])->name('wirellessMip.page');
            Route::get('/wirellessMip/create', [InvWirellessMipController::class, 'create'])->name('wirellessMip.create');
            Route::post('/wirellessMip/create', [InvWirellessMipController::class, 'store'])->name('wirellessMip.store');
            Route::get('/wirellessMip/{id}/edit', [InvWirellessMipController::class, 'edit'])->name('wirellessMip.edit');
            Route::put('/wirellessMip/{id}/update', [InvWirellessMipController::class, 'update'])->name('wirellessMip.update');
            Route::delete('/wirellessMip/{id}/delete', [InvWirellessMipController::class, 'destroy'])->name('wirellessMip.delete');
            Route::get('/wirellessMip/{id}/detail', [InvWirellessMipController::class, 'detail'])->name('wirellessMip.detail');
            Route::post('/uploadCsvBbMip', [InvWirellessMipController::class, 'uploadCsv'])->name('wirellessMip.import');

            Route::get('/laptopMip', [InvLaptopMipController::class, 'index'])->name('laptopMip.page');
            Route::post('/laptopMip/generate', [InvLaptopMipController::class, 'generateCode'])->name('laptopMip.generate');
            Route::get('/laptopMip/create', [InvLaptopMipController::class, 'create'])->name('laptopMip.create');
            Route::post('/laptopMip/create', [InvLaptopMipController::class, 'store'])->name('laptopMip.store');
            Route::get('/laptopMip/{id}/edit', [InvLaptopMipController::class, 'edit'])->name('laptopMip.edit');
            Route::delete('/laptopMip/{id}/delete', [InvLaptopMipController::class, 'destroy'])->name('laptopMip.delete');
            Route::post('/laptopMip/update', [InvLaptopMipController::class, 'update'])->name('laptopMip.update');
            Route::get('/laptopMip/{id}/detail', [InvLaptopMipController::class, 'detail'])->name('laptopMip.detail');
            Route::post('/uploadCsvNbMip', [InvLaptopMipController::class, 'uploadCsv'])->name('laptopMip.import');

            Route::get('/komputerMip', [InvComputerMipController::class, 'index'])->name('komputerMip.page');
            Route::post('/komputerMip/generate', [InvComputerMipController::class, 'generateCode'])->name('komputerMip.generate');
            Route::get('/komputerMip/create', [InvComputerMipController::class, 'create'])->name('komputerMip.create');
            Route::post('/komputerMip/create', [InvComputerMipController::class, 'store'])->name('komputerMip.store');
            Route::get('/komputerMip/{id}/edit', [InvComputerMipController::class, 'edit'])->name('komputerMip.edit');
            Route::delete('/komputerMip/{id}/delete', [InvComputerMipController::class, 'destroy'])->name('komputerMip.delete');
            Route::post('/komputerMip/update', [InvComputerMipController::class, 'update'])->name('komputerMip.update');
            Route::get('/komputerMip/{id}/detail', [InvComputerMipController::class, 'detail'])->name('komputerMip.detail');
            Route::post('/uploadCsvCuMip', [InvComputerMipController::class, 'uploadCsv'])->name('komputerMip.import');

            Route::get('/printerMip', [InvPrinterMipController::class, 'index'])->name(name: 'printerMip.page');
            Route::get('/printerMip/create', [InvPrinterMipController::class, 'create'])->name('printerMip.create');
            Route::post('/printerMip/create', [InvPrinterMipController::class, 'store'])->name('printerMip.store');
            Route::get('/printerMip/{id}/edit', [InvPrinterMipController::class, 'edit'])->name('printerMip.edit');
            Route::delete('/printerMip/{id}/delete', [InvPrinterMipController::class, 'destroy'])->name('printerMip.delete');
            Route::post('/printerMip/update', [InvPrinterMipController::class, 'update'])->name('printerMip.update');
            Route::get('/printerMip/{id}/detail', [InvPrinterMipController::class, 'detail'])->name('printerMip.detail');
            Route::post('/uploadCsvPrtMip', [InvPrinterMipController::class, 'uploadCsv'])->name('printerMip.import');

            Route::get('/scannerMip', [InvScannerMipController::class, 'index'])->name('scannerMip.page');
            Route::get('/scannerMip/create', [InvScannerMipController::class, 'create'])->name('scannerMip.create');
            Route::post('/scannerMip/create', [InvScannerMipController::class, 'store'])->name('scannerMip.store');
            Route::get('/scannerMip/{id}/edit', [InvScannerMipController::class, 'edit'])->name('scannerMip.edit');
            Route::delete('/scannerMip/{id}/delete', [InvScannerMipController::class, 'destroy'])->name('scannerMip.delete');
            Route::post('/scannerMip/update', [InvScannerMipController::class, 'update'])->name('scannerMip.update');
            Route::get('/scannerMip/{id}/detail', [InvScannerMipController::class, 'detail'])->name('scannerMip.detail');
            Route::post('/uploadCsvScnMip', [InvScannerMipController::class, 'uploadCsv'])->name('scannerMip.import');

            Route::get('/cctvMip', [InvCctvMipController::class, 'index'])->name('cctvMip.page');
            Route::get('/cctvMip/create', [InvCctvMipController::class, 'create'])->name('cctvMip.create');
            Route::post('/cctvMip/create', [InvCctvMipController::class, 'store'])->name('cctvMip.store');
            Route::get('/cctvMip/{id}/edit', [InvCctvMipController::class, 'edit'])->name('cctvMip.edit');
            Route::delete('/cctvMip/{id}/delete', [InvCctvMipController::class, 'destroy'])->name('cctvMip.delete');
            Route::post('/cctvMip/update', [InvCctvMipController::class, 'update'])->name('cctvMip.update');
            Route::get('/cctvMip/{id}/detail', [InvCctvMipController::class, 'detail'])->name('cctvMip.detail');
            Route::post('/uploadCsvCCTVMip', [InvCctvMipController::class, 'uploadCsv'])->name('cctvMip.import');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:VIB,ict_group_leader:VIB,ict_admin:VIB,ict_ho:HO'], function () {
            Route::get('/dashboardSiteVale', [DashboardValeController::class, 'index'])->name('dashboardVale.page');

            Route::get('/accessPointSiteVale', [InvApValeController::class, 'index'])->name('accessPointVale.page');
            Route::get('/accessPointSiteVale/create', [InvApValeController::class, 'create'])->name('accessPointVale.create');
            Route::post('/accessPointSiteVale/create', [InvApValeController::class, 'store'])->name('accessPointVale.store');
            Route::post('/accessPointSiteVale/generate', [InvApValeController::class, 'generateCode'])->name('accessPointVale.generate');
            Route::post('/accessPointSiteVale/generate/edit', [InvApValeController::class, 'generateCodeEdit'])->name('accessPointVale.generateEdit');
            Route::get('/accessPointSiteVale/{apId}/edit', [InvApValeController::class, 'edit'])->name('accessPointVale.edit');
            Route::put('/accessPointSiteVale/{apId}/update', [InvApValeController::class, 'update'])->name('accessPointVale.update');
            Route::delete('/accessPointSiteVale/{apId}/delete', [InvApValeController::class, 'destroy'])->name('accessPointVale.delete');
            Route::get('/accessPointSiteVale/{id}/detail', [InvApValeController::class, 'detail'])->name('accessPointVale.detail');
            Route::post('/uploadCsvApVale', [InvApValeController::class, 'uploadCsv'])->name('accessPointVale.import');

            Route::get('/switchVale', [InvSwitchValeController::class, 'index'])->name('switchVale.page');
            Route::get('/switchVale/create', [InvSwitchValeController::class, 'create'])->name('switchVale.create');
            Route::post('/switchVale/create', [InvSwitchValeController::class, 'store'])->name('switchVale.store');
            Route::post('/switchVale/generate', [InvSwitchValeController::class, 'generateCode'])->name('switchVale.generate');
            Route::post('/switchVale/generate/edit', [InvSwitchValeController::class, 'generateCodeEdit'])->name('switchVale.generateEdit');
            Route::get('/switchVale/{swId}/edit', [InvSwitchValeController::class, 'edit'])->name('switchVale.edit');
            Route::put('/switchVale/{swId}/update', [InvSwitchValeController::class, 'update'])->name('switchVale.update');
            Route::delete('/switchVale/{swId}/delete', [InvSwitchValeController::class, 'destroy'])->name('switchVale.delete');
            Route::get('/switchVale/{id}/detail', [InvSwitchValeController::class, 'detail'])->name('switchVale.detail');
            Route::post('/uploadCsvSwVale', [InvSwitchValeController::class, 'uploadCsv'])->name('switchVale.import');

            Route::get('/wirellessVale', [InvWirellessValeController::class, 'index'])->name('wirellessVale.page');
            Route::get('/wirellessVale/create', [InvWirellessValeController::class, 'create'])->name('wirellessVale.create');
            Route::post('/wirellessVale/create', [InvWirellessValeController::class, 'store'])->name('wirellessVale.store');
            Route::get('/wirellessVale/{id}/edit', [InvWirellessValeController::class, 'edit'])->name('wirellessVale.edit');
            Route::put('/wirellessVale/{id}/update', [InvWirellessValeController::class, 'update'])->name('wirellessVale.update');
            Route::delete('/wirellessVale/{id}/delete', [InvWirellessValeController::class, 'destroy'])->name('wirellessVale.delete');
            Route::get('/wirellessVale/{id}/detail', [InvWirellessValeController::class, 'detail'])->name('wirellessVale.detail');
            Route::post('/uploadCsvBbVale', [InvWirellessValeController::class, 'uploadCsv'])->name('wirellessVale.import');

            Route::get('/laptopVale', [InvLaptopValeController::class, 'index'])->name('laptopVale.page');
            Route::post('/laptopVale/generate', [InvLaptopValeController::class, 'generateCode'])->name('laptopVale.generate');
            Route::get('/laptopVale/create', [InvLaptopValeController::class, 'create'])->name('laptopVale.create');
            Route::post('/laptopVale/create', [InvLaptopValeController::class, 'store'])->name('laptopVale.store');
            Route::get('/laptopVale/{id}/edit', [InvLaptopValeController::class, 'edit'])->name('laptopVale.edit');
            Route::delete('/laptopVale/{id}/delete', [InvLaptopValeController::class, 'destroy'])->name('laptopVale.delete');
            Route::post('/laptopVale/update', [InvLaptopValeController::class, 'update'])->name('laptopVale.update');
            Route::get('/laptopVale/{id}/detail', [InvLaptopValeController::class, 'detail'])->name('laptopVale.detail');
            Route::post('/uploadCsvNbVale', [InvLaptopValeController::class, 'uploadCsv'])->name('laptopVale.import');

            Route::get('/komputerVale', [InvComputerValeController::class, 'index'])->name('komputerVale.page');
            Route::post('/komputerVale/generate', [InvComputerValeController::class, 'generateCode'])->name('komputerVale.generate');
            Route::get('/komputerVale/create', [InvComputerValeController::class, 'create'])->name('komputerVale.create');
            Route::post('/komputerVale/create', [InvComputerValeController::class, 'store'])->name('komputerVale.store');
            Route::get('/komputerVale/{id}/edit', [InvComputerValeController::class, 'edit'])->name('komputerVale.edit');
            Route::delete('/komputerVale/{id}/delete', [InvComputerValeController::class, 'destroy'])->name('komputerVale.delete');
            Route::post('/komputerVale/update', [InvComputerValeController::class, 'update'])->name('komputerVale.update');
            Route::get('/komputerVale/{id}/detail', [InvComputerValeController::class, 'detail'])->name('komputerVale.detail');
            Route::post('/uploadCsvCuVale', [InvComputerValeController::class, 'uploadCsv'])->name('komputerVale.import');

            Route::get('/printerVale', [InvPrinterValeController::class, 'index'])->name(name: 'printerVale.page');
            Route::get('/printerVale/create', [InvPrinterValeController::class, 'create'])->name('printerVale.create');
            Route::post('/printerVale/create', [InvPrinterValeController::class, 'store'])->name('printerVale.store');
            Route::get('/printerVale/{id}/edit', [InvPrinterValeController::class, 'edit'])->name('printerVale.edit');
            Route::delete('/printerVale/{id}/delete', [InvPrinterValeController::class, 'destroy'])->name('printerVale.delete');
            Route::post('/printerVale/update', [InvPrinterValeController::class, 'update'])->name('printerVale.update');
            Route::get('/printerVale/{id}/detail', [InvPrinterValeController::class, 'detail'])->name('printerVale.detail');
            Route::post('/uploadCsvPrtVale', [InvPrinterValeController::class, 'uploadCsv'])->name('printerVale.import');

            Route::get('/scannerVale', [InvScannerValeController::class, 'index'])->name('scannerVale.page');
            Route::get('/scannerVale/create', [InvScannerValeController::class, 'create'])->name('scannerVale.create');
            Route::post('/scannerVale/create', [InvScannerValeController::class, 'store'])->name('scannerVale.store');
            Route::get('/scannerVale/{id}/edit', [InvScannerValeController::class, 'edit'])->name('scannerVale.edit');
            Route::delete('/scannerVale/{id}/delete', [InvScannerValeController::class, 'destroy'])->name('scannerVale.delete');
            Route::post('/scannerVale/update', [InvScannerValeController::class, 'update'])->name('scannerVale.update');
            Route::get('/scannerVale/{id}/detail', [InvScannerValeController::class, 'detail'])->name('scannerVale.detail');
            Route::post('/uploadCsvScnVale', [InvScannerValeController::class, 'uploadCsv'])->name('scannerVale.import');

            Route::get('/cctvVale', [InvCctvValeController::class, 'index'])->name('cctvVale.page');
            Route::get('/cctvVale/create', [InvCctvValeController::class, 'create'])->name('cctvVale.create');
            Route::post('/cctvVale/create', [InvCctvValeController::class, 'store'])->name('cctvVale.store');
            Route::get('/cctvVale/{id}/edit', [InvCctvValeController::class, 'edit'])->name('cctvVale.edit');
            Route::delete('/cctvVale/{id}/delete', [InvCctvValeController::class, 'destroy'])->name('cctvVale.delete');
            Route::post('/cctvVale/update', [InvCctvValeController::class, 'update'])->name('cctvVale.update');
            Route::get('/cctvVale/{id}/detail', [InvCctvValeController::class, 'detail'])->name('cctvVale.detail');
            Route::post('/uploadCsvCCTVVale', [InvCctvValeController::class, 'uploadCsv'])->name('cctvVale.import');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:SBS,ict_group_leader:SBS,ict_admin:SBS,ict_ho:HO'], function () {
            Route::get('/dashboardSiteSbs', [DashboardSbsController::class, 'index'])->name('dashboardSbs.page');

            Route::get('/accessPointSiteSbs', [InvApSbsController::class, 'index'])->name('accessPointSbs.page');
            Route::get('/accessPointSiteSbs/create', [InvApSbsController::class, 'create'])->name('accessPointSbs.create');
            Route::post('/accessPointSiteSbs/create', [InvApSbsController::class, 'store'])->name('accessPointSbs.store');
            Route::post('/accessPointSiteSbs/generate', [InvApSbsController::class, 'generateCode'])->name('accessPointSbs.generate');
            Route::post('/accessPointSiteSbs/generate/edit', [InvApSbsController::class, 'generateCodeEdit'])->name('accessPointSbs.generateEdit');
            Route::get('/accessPointSiteSbs/{apId}/edit', [InvApSbsController::class, 'edit'])->name('accessPointSbs.edit');
            Route::put('/accessPointSiteSbs/{apId}/update', [InvApSbsController::class, 'update'])->name('accessPointSbs.update');
            Route::delete('/accessPointSiteSbs/{apId}/delete', [InvApSbsController::class, 'destroy'])->name('accessPointSbs.delete');
            Route::get('/accessPointSiteSbs/{id}/detail', [InvApSbsController::class, 'detail'])->name('accessPointSbs.detail');
            Route::post('/uploadCsvApSbs', [InvApSbsController::class, 'uploadCsv'])->name('accessPointSbs.import');

            Route::get('/switchSbs', [InvSwitchSbsController::class, 'index'])->name('switchSbs.page');
            Route::get('/switchSbs/create', [InvSwitchSbsController::class, 'create'])->name('switchSbs.create');
            Route::post('/switchSbs/create', [InvSwitchSbsController::class, 'store'])->name('switchSbs.store');
            Route::post('/switchSbs/generate', [InvSwitchSbsController::class, 'generateCode'])->name('switchSbs.generate');
            Route::post('/switchSbs/generate/edit', [InvSwitchSbsController::class, 'generateCodeEdit'])->name('switchSbs.generateEdit');
            Route::get('/switchSbs/{swId}/edit', [InvSwitchSbsController::class, 'edit'])->name('switchSbs.edit');
            Route::put('/switchSbs/{swId}/update', [InvSwitchSbsController::class, 'update'])->name('switchSbs.update');
            Route::delete('/switchSbs/{swId}/delete', [InvSwitchSbsController::class, 'destroy'])->name('switchSbs.delete');
            Route::get('/switchSbs/{id}/detail', [InvSwitchSbsController::class, 'detail'])->name('switchSbs.detail');
            Route::post('/uploadCsvSwSbs', [InvSwitchSbsController::class, 'uploadCsv'])->name('switchSbs.import');

            Route::get('/wirellessSbs', [InvWirellessSbsController::class, 'index'])->name('wirellessSbs.page');
            Route::get('/wirellessSbs/create', [InvWirellessSbsController::class, 'create'])->name('wirellessSbs.create');
            Route::post('/wirellessSbs/create', [InvWirellessSbsController::class, 'store'])->name('wirellessSbs.store');
            Route::get('/wirellessSbs/{id}/edit', [InvWirellessSbsController::class, 'edit'])->name('wirellessSbs.edit');
            Route::put('/wirellessSbs/{id}/update', [InvWirellessSbsController::class, 'update'])->name('wirellessSbs.update');
            Route::delete('/wirellessSbs/{id}/delete', [InvWirellessSbsController::class, 'destroy'])->name('wirellessSbs.delete');
            Route::get('/wirellessSbs/{id}/detail', [InvWirellessSbsController::class, 'detail'])->name('wirellessSbs.detail');
            Route::post('/uploadCsvBbSbs', [InvWirellessSbsController::class, 'uploadCsv'])->name('wirellessSbs.import');

            Route::get('/laptopSbs', [InvLaptopSbsController::class, 'index'])->name('laptopSbs.page');
            Route::post('/laptopSbs/generate', [InvLaptopSbsController::class, 'generateCode'])->name('laptopSbs.generate');
            Route::get('/laptopSbs/create', [InvLaptopSbsController::class, 'create'])->name('laptopSbs.create');
            Route::post('/laptopSbs/create', [InvLaptopSbsController::class, 'store'])->name('laptopSbs.store');
            Route::get('/laptopSbs/{id}/edit', [InvLaptopSbsController::class, 'edit'])->name('laptopSbs.edit');
            Route::delete('/laptopSbs/{id}/delete', [InvLaptopSbsController::class, 'destroy'])->name('laptopSbs.delete');
            Route::post('/laptopSbs/update', [InvLaptopSbsController::class, 'update'])->name('laptopSbs.update');
            Route::get('/laptopSbs/{id}/detail', [InvLaptopSbsController::class, 'detail'])->name('laptopSbs.detail');
            Route::post('/uploadCsvNbSbs', [InvLaptopSbsController::class, 'uploadCsv'])->name('laptopSbs.import');

            Route::get('/komputerSbs', [InvComputerSbsController::class, 'index'])->name('komputerSbs.page');
            Route::post('/komputerSbs/generate', [InvComputerSbsController::class, 'generateCode'])->name('komputerSbs.generate');
            Route::get('/komputerSbs/create', [InvComputerSbsController::class, 'create'])->name('komputerSbs.create');
            Route::post('/komputerSbs/create', [InvComputerSbsController::class, 'store'])->name('komputerSbs.store');
            Route::get('/komputerSbs/{id}/edit', [InvComputerSbsController::class, 'edit'])->name('komputerSbs.edit');
            Route::delete('/komputerSbs/{id}/delete', [InvComputerSbsController::class, 'destroy'])->name('komputerSbs.delete');
            Route::post('/komputerSbs/update', [InvComputerSbsController::class, 'update'])->name('komputerSbs.update');
            Route::get('/komputerSbs/{id}/detail', [InvComputerSbsController::class, 'detail'])->name('komputerSbs.detail');
            Route::post('/uploadCsvCuSbs', [InvComputerSbsController::class, 'uploadCsv'])->name('komputerSbs.import');

            Route::get('/printerSbs', [InvPrinterSbsController::class, 'index'])->name(name: 'printerSbs.page');
            Route::get('/printerSbs/create', [InvPrinterSbsController::class, 'create'])->name('printerSbs.create');
            Route::post('/printerSbs/create', [InvPrinterSbsController::class, 'store'])->name('printerSbs.store');
            Route::get('/printerSbs/{id}/edit', [InvPrinterSbsController::class, 'edit'])->name('printerSbs.edit');
            Route::delete('/printerSbs/{id}/delete', [InvPrinterSbsController::class, 'destroy'])->name('printerSbs.delete');
            Route::post('/printerSbs/update', [InvPrinterSbsController::class, 'update'])->name('printerSbs.update');
            Route::get('/printerSbs/{id}/detail', [InvPrinterSbsController::class, 'detail'])->name('printerSbs.detail');
            Route::post('/uploadCsvPrtSbs', [InvPrinterSbsController::class, 'uploadCsv'])->name('printerSbs.import');

            Route::get('/scannerSbs', [InvScannerSbsController::class, 'index'])->name('scannerSbs.page');
            Route::get('/scannerSbs/create', [InvScannerSbsController::class, 'create'])->name('scannerSbs.create');
            Route::post('/scannerSbs/create', [InvScannerSbsController::class, 'store'])->name('scannerSbs.store');
            Route::get('/scannerSbs/{id}/edit', [InvScannerSbsController::class, 'edit'])->name('scannerSbs.edit');
            Route::delete('/scannerSbs/{id}/delete', [InvScannerSbsController::class, 'destroy'])->name('scannerSbs.delete');
            Route::post('/scannerSbs/update', [InvScannerSbsController::class, 'update'])->name('scannerSbs.update');
            Route::get('/scannerSbs/{id}/detail', [InvScannerSbsController::class, 'detail'])->name('scannerSbs.detail');
            Route::post('/uploadCsvScnSbs', [InvScannerSbsController::class, 'uploadCsv'])->name('scannerSbs.import');

            Route::get('/cctvSbs', [InvCctvSbsController::class, 'index'])->name('cctvSbs.page');
            Route::get('/cctvSbs/create', [InvCctvSbsController::class, 'create'])->name('cctvSbs.create');
            Route::post('/cctvSbs/create', [InvCctvSbsController::class, 'store'])->name('cctvSbs.store');
            Route::get('/cctvSbs/{id}/edit', [InvCctvSbsController::class, 'edit'])->name('cctvSbs.edit');
            Route::delete('/cctvSbs/{id}/delete', [InvCctvSbsController::class, 'destroy'])->name('cctvSbs.delete');
            Route::post('/cctvSbs/update', [InvCctvSbsController::class, 'update'])->name('cctvSbs.update');
            Route::get('/cctvSbs/{id}/detail', [InvCctvSbsController::class, 'detail'])->name('cctvSbs.detail');
            Route::post('/uploadCsvCCTVSbs', [InvCctvSbsController::class, 'uploadCsv'])->name('cctvSbs.import');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:SKS,ict_group_leader:SKS,ict_admin:SKS,ict_ho:HO'], function () {
            Route::get('/dashboardSiteSks', [DashboardSksController::class, 'index'])->name('dashboardSks.page');

            Route::get('/accessPointSiteSks', [InvApSksController::class, 'index'])->name('accessPointSks.page');
            Route::get('/accessPointSiteSks/create', [InvApSksController::class, 'create'])->name('accessPointSks.create');
            Route::post('/accessPointSiteSks/create', [InvApSksController::class, 'store'])->name('accessPointSks.store');
            Route::post('/accessPointSiteSks/generate', [InvApSksController::class, 'generateCode'])->name('accessPointSks.generate');
            Route::post('/accessPointSiteSks/generate/edit', [InvApSksController::class, 'generateCodeEdit'])->name('accessPointSks.generateEdit');
            Route::get('/accessPointSiteSks/{apId}/edit', [InvApSksController::class, 'edit'])->name('accessPointSks.edit');
            Route::put('/accessPointSiteSks/{apId}/update', [InvApSksController::class, 'update'])->name('accessPointSks.update');
            Route::delete('/accessPointSiteSks/{apId}/delete', [InvApSksController::class, 'destroy'])->name('accessPointSks.delete');
            Route::get('/accessPointSiteSks/{id}/detail', [InvApSksController::class, 'detail'])->name('accessPointSks.detail');
            Route::post('/uploadCsvApSks', [InvApSksController::class, 'uploadCsv'])->name('accessPointSks.import');

            Route::get('/switchSks', [InvSwitchSksController::class, 'index'])->name('switchSks.page');
            Route::get('/switchSks/create', [InvSwitchSksController::class, 'create'])->name('switchSks.create');
            Route::post('/switchSks/create', [InvSwitchSksController::class, 'store'])->name('switchSks.store');
            Route::post('/switchSks/generate', [InvSwitchSksController::class, 'generateCode'])->name('switchSks.generate');
            Route::post('/switchSks/generate/edit', [InvSwitchSksController::class, 'generateCodeEdit'])->name('switchSks.generateEdit');
            Route::get('/switchSks/{swId}/edit', [InvSwitchSksController::class, 'edit'])->name('switchSks.edit');
            Route::put('/switchSks/{swId}/update', [InvSwitchSksController::class, 'update'])->name('switchSks.update');
            Route::delete('/switchSks/{swId}/delete', [InvSwitchSksController::class, 'destroy'])->name('switchSks.delete');
            Route::get('/switchSks/{id}/detail', [InvSwitchSksController::class, 'detail'])->name('switchSks.detail');
            Route::post('/uploadCsvSwSks', [InvSwitchSksController::class, 'uploadCsv'])->name('switchSks.import');

            Route::get('/wirellessSks', [InvWirellessSksController::class, 'index'])->name('wirellessSks.page');
            Route::get('/wirellessSks/create', [InvWirellessSksController::class, 'create'])->name('wirellessSks.create');
            Route::post('/wirellessSks/create', [InvWirellessSksController::class, 'store'])->name('wirellessSks.store');
            Route::get('/wirellessSks/{id}/edit', [InvWirellessSksController::class, 'edit'])->name('wirellessSks.edit');
            Route::put('/wirellessSks/{id}/update', [InvWirellessSksController::class, 'update'])->name('wirellessSks.update');
            Route::delete('/wirellessSks/{id}/delete', [InvWirellessSksController::class, 'destroy'])->name('wirellessSks.delete');
            Route::get('/wirellessSks/{id}/detail', [InvWirellessSksController::class, 'detail'])->name('wirellessSks.detail');
            Route::post('/uploadCsvBbSks', [InvWirellessSksController::class, 'uploadCsv'])->name('wirellessSks.import');

            Route::get('/laptopSks', [InvLaptopSksController::class, 'index'])->name('laptopSks.page');
            Route::post('/laptopSks/generate', [InvLaptopSksController::class, 'generateCode'])->name('laptopSks.generate');
            Route::get('/laptopSks/create', [InvLaptopSksController::class, 'create'])->name('laptopSks.create');
            Route::post('/laptopSks/create', [InvLaptopSksController::class, 'store'])->name('laptopSks.store');
            Route::get('/laptopSks/{id}/edit', [InvLaptopSksController::class, 'edit'])->name('laptopSks.edit');
            Route::delete('/laptopSks/{id}/delete', [InvLaptopSksController::class, 'destroy'])->name('laptopSks.delete');
            Route::post('/laptopSks/update', [InvLaptopSksController::class, 'update'])->name('laptopSks.update');
            Route::get('/laptopSks/{id}/detail', [InvLaptopSksController::class, 'detail'])->name('laptopSks.detail');
            Route::post('/uploadCsvNbSks', [InvLaptopSksController::class, 'uploadCsv'])->name('laptopSks.import');

            Route::get('/komputerSks', [InvComputerSksController::class, 'index'])->name('komputerSks.page');
            Route::post('/komputerSks/generate', [InvComputerSksController::class, 'generateCode'])->name('komputerSks.generate');
            Route::get('/komputerSks/create', [InvComputerSksController::class, 'create'])->name('komputerSks.create');
            Route::post('/komputerSks/create', [InvComputerSksController::class, 'store'])->name('komputerSks.store');
            Route::get('/komputerSks/{id}/edit', [InvComputerSksController::class, 'edit'])->name('komputerSks.edit');
            Route::delete('/komputerSks/{id}/delete', [InvComputerSksController::class, 'destroy'])->name('komputerSks.delete');
            Route::post('/komputerSks/update', [InvComputerSksController::class, 'update'])->name('komputerSks.update');
            Route::get('/komputerSks/{id}/detail', [InvComputerSksController::class, 'detail'])->name('komputerSks.detail');
            Route::post('/uploadCsvCuSks', [InvComputerSksController::class, 'uploadCsv'])->name('komputerSks.import');

            Route::get('/printerSks', [InvPrinterSksController::class, 'index'])->name(name: 'printerSks.page');
            Route::get('/printerSks/create', [InvPrinterSksController::class, 'create'])->name('printerSks.create');
            Route::post('/printerSks/create', [InvPrinterSksController::class, 'store'])->name('printerSks.store');
            Route::get('/printerSks/{id}/edit', [InvPrinterSksController::class, 'edit'])->name('printerSks.edit');
            Route::delete('/printerSks/{id}/delete', [InvPrinterSksController::class, 'destroy'])->name('printerSks.delete');
            Route::post('/printerSks/update', [InvPrinterSksController::class, 'update'])->name('printerSks.update');
            Route::get('/printerSks/{id}/detail', [InvPrinterSksController::class, 'detail'])->name('printerSks.detail');
            Route::post('/uploadCsvPrtSbs', [InvPrinterSksController::class, 'uploadCsv'])->name('printerSks.import');

            Route::get('/scannerSks', [InvScannerSksController::class, 'index'])->name('scannerSks.page');
            Route::get('/scannerSks/create', [InvScannerSksController::class, 'create'])->name('scannerSks.create');
            Route::post('/scannerSks/create', [InvScannerSksController::class, 'store'])->name('scannerSks.store');
            Route::get('/scannerSks/{id}/edit', [InvScannerSksController::class, 'edit'])->name('scannerSks.edit');
            Route::delete('/scannerSks/{id}/delete', [InvScannerSksController::class, 'destroy'])->name('scannerSks.delete');
            Route::post('/scannerSks/update', [InvScannerSksController::class, 'update'])->name('scannerSks.update');
            Route::get('/scannerSks/{id}/detail', [InvScannerSksController::class, 'detail'])->name('scannerSks.detail');
            Route::post('/uploadCsvScnSbs', [InvScannerSksController::class, 'uploadCsv'])->name('scannerSks.import');

            Route::get('/cctvSks', [InvCctvSksController::class, 'index'])->name('cctvSks.page');
            Route::get('/cctvSks/create', [InvCctvSksController::class, 'create'])->name('cctvSks.create');
            Route::post('/cctvSks/create', [InvCctvSksController::class, 'store'])->name('cctvSks.store');
            Route::get('/cctvSks/{id}/edit', [InvCctvSksController::class, 'edit'])->name('cctvSks.edit');
            Route::delete('/cctvSks/{id}/delete', [InvCctvSksController::class, 'destroy'])->name('cctvSks.delete');
            Route::post('/cctvSks/update', [InvCctvSksController::class, 'update'])->name('cctvSks.update');
            Route::get('/cctvSks/{id}/detail', [InvCctvSksController::class, 'detail'])->name('cctvSks.detail');
            Route::post('/uploadCsvCCTVSbs', [InvCctvSksController::class, 'uploadCsv'])->name('cctvSks.import');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:ADW,ict_ho:HO,ict_group_leader:ADW,ict_admin:ADW'], function () {
            Route::get('/dashboardSiteWara', [DashboardWaraController::class, 'index'])->name('dashboardWara.page');

            Route::get('/accessPointSiteWara', [InvApWARAController::class, 'index'])->name('accessPointWARA.page');
            Route::get('/accessPointSiteWara/create', [InvApWARAController::class, 'create'])->name('accessPointWARA.create');
            Route::post('/accessPointSiteWara/create', [InvApWARAController::class, 'store'])->name('accessPointWARA.store');
            Route::post('/accessPointSiteWARA/generate', [InvApWARAController::class, 'generateCode'])->name('accessPointWARA.generate');
            Route::post('/accessPointSiteWARA/generate/edit', [InvApWARAController::class, 'generateCodeEdit'])->name('accessPointWARA.generateEdit');
            Route::get('/accessPointSiteWara/{apId}/edit', [InvApWARAController::class, 'edit'])->name('accessPointWARA.edit');
            Route::put('/accessPointSiteWara/{apId}/update', [InvApWARAController::class, 'update'])->name('accessPointWARA.update');
            Route::delete('/accessPointSiteWara/{apId}/delete', [InvApWARAController::class, 'destroy'])->name('accessPointWARA.delete');
            Route::get('/accessPointSiteWara/{id}/detail', [InvApWARAController::class, 'detail'])->name('accessPointWARA.detail');
            Route::post('/uploadCsvApWara', [InvApWARAController::class, 'uploadCsv'])->name('accessPointWARA.import');

            Route::get('/switchWara', [InvSwitchWARAController::class, 'index'])->name('switchWARA.page');
            Route::get('/switchWara/create', [InvSwitchWARAController::class, 'create'])->name('switchWARA.create');
            Route::post('/switchWara/create', [InvSwitchWARAController::class, 'store'])->name('switchWARA.store');
            Route::post('/switchWara/generate', [InvSwitchWARAController::class, 'generateCode'])->name('switchWARA.generate');
            Route::post('/switchWara/generate/edit', [InvSwitchWARAController::class, 'generateCodeEdit'])->name('switchWARA.generateEdit');
            Route::get('/switchWara/{swId}/edit', [InvSwitchWARAController::class, 'edit'])->name('switchWARA.edit');
            Route::put('/switchWara/{swId}/update', [InvSwitchWARAController::class, 'update'])->name('switchWARA.update');
            Route::delete('/switchWara/{swId}/delete', [InvSwitchWARAController::class, 'destroy'])->name('switchWARA.delete');
            Route::get('/switchWara/{id}/detail', [InvSwitchWARAController::class, 'detail'])->name('switchWARA.detail');
            Route::post('/uploadCsvSwWara', [InvSwitchWARAController::class, 'uploadCsv'])->name('switchWARA.import');

            Route::get('/wirellessWara', [InvWirellessWARAController::class, 'index'])->name('wirellessWARA.page');
            Route::get('/wirellessWara/create', [InvWirellessWARAController::class, 'create'])->name('wirellessWARA.create');
            Route::post('/wirellessWara/create', [InvWirellessWARAController::class, 'store'])->name('wirellessWARA.store');
            Route::get('/wirellessWara/{id}/edit', [InvWirellessWARAController::class, 'edit'])->name('wirellessWARA.edit');
            Route::put('/wirellessWara/{id}/update', [InvWirellessWARAController::class, 'update'])->name('wirellessWARA.update');
            Route::delete('/wirellessWara/{id}/delete', [InvWirellessWARAController::class, 'destroy'])->name('wirellessWARA.delete');
            Route::get('/wirellessWara/{id}/detail', [InvWirellessWARAController::class, 'detail'])->name('wirellessWARA.detail');
            Route::post('/uploadCsvBbWara', [InvWirellessWARAController::class, 'uploadCsv'])->name('wirellessWARA.import');

            Route::get('/laptopWara', [InvLaptopWARAController::class, 'index'])->name('laptopWARA.page');
            Route::post('/laptopWara/generate', [InvLaptopWARAController::class, 'generateCode'])->name('laptopWARA.generate');
            Route::get('/laptopWara/create', [InvLaptopWARAController::class, 'create'])->name('laptopWARA.create');
            Route::post('/laptopWara/create', [InvLaptopWARAController::class, 'store'])->name('laptopWARA.store');
            Route::get('/laptopWara/{id}/edit', [InvLaptopWARAController::class, 'edit'])->name('laptopWARA.edit');
            Route::delete('/laptopWara/{id}/delete', [InvLaptopWARAController::class, 'destroy'])->name('laptopWARA.delete');
            Route::post('/laptopWara/update', [InvLaptopWARAController::class, 'update'])->name('laptopWARA.update');
            Route::get('/laptopWara/{id}/detail', [InvLaptopWARAController::class, 'detail'])->name('laptopWARA.detail');
            Route::post('/uploadCsvNbWara', [InvLaptopWARAController::class, 'uploadCsv'])->name('laptopWARA.import');

            Route::get('/komputerWara', [InvComputerWARAController::class, 'index'])->name('komputerWARA.page');
            Route::post('/komputerWara/generate', [InvComputerWARAController::class, 'generateCode'])->name('komputerWARA.generate');
            Route::get('/komputerWara/create', [InvComputerWARAController::class, 'create'])->name('komputerWARA.create');
            Route::post('/komputerWara/create', [InvComputerWARAController::class, 'store'])->name('komputerWARA.store');
            Route::get('/komputerWara/{id}/edit', [InvComputerWARAController::class, 'edit'])->name('komputerWARA.edit');
            Route::delete('/komputerWara/{id}/delete', [InvComputerWARAController::class, 'destroy'])->name('komputerWARA.delete');
            Route::post('/komputerWara/update', [InvComputerWARAController::class, 'update'])->name('komputerWARA.update');
            Route::get('/komputerWara/{id}/detail', [InvComputerWARAController::class, 'detail'])->name('komputerWARA.detail');
            Route::post('/uploadCsvCuWara', [InvComputerWARAController::class, 'uploadCsv'])->name('komputerWARA.import');

            Route::get('/printerWara', [InvPrinterWARAController::class, 'index'])->name(name: 'printerWARA.page');
            Route::get('/printerWara/create', [InvPrinterWARAController::class, 'create'])->name('printerWARA.create');
            Route::post('/printerWara/create', [InvPrinterWARAController::class, 'store'])->name('printerWARA.store');
            Route::get('/printerWara/{id}/edit', [InvPrinterWARAController::class, 'edit'])->name('printerWARA.edit');
            Route::delete('/printerWara/{id}/delete', [InvPrinterWARAController::class, 'destroy'])->name('printerWARA.delete');
            Route::post('/printerWara/update', [InvPrinterWARAController::class, 'update'])->name('printerWARA.update');
            Route::get('/printerWara/{id}/detail', [InvPrinterWARAController::class, 'detail'])->name('printerWARA.detail');
            Route::post('/uploadCsvPrtWara', [InvPrinterWARAController::class, 'uploadCsv'])->name('printerWARA.import');

            Route::get('/scannerWara', [InvScannerWARAController::class, 'index'])->name('scannerWARA.page');
            Route::get('/scannerWara/create', [InvScannerWARAController::class, 'create'])->name('scannerWARA.create');
            Route::post('/scannerWara/create', [InvScannerWARAController::class, 'store'])->name('scannerWARA.store');
            Route::get('/scannerWara/{id}/edit', [InvScannerWARAController::class, 'edit'])->name('scannerWARA.edit');
            Route::delete('/scannerWara/{id}/delete', [InvScannerWARAController::class, 'destroy'])->name('scannerWARA.delete');
            Route::post('/scannerWara/update', [InvScannerWARAController::class, 'update'])->name('scannerWARA.update');
            Route::get('/scannerWara/{id}/detail', [InvScannerWARAController::class, 'detail'])->name('scannerWARA.detail');
            Route::post('/uploadCsvScnWara', [InvScannerWARAController::class, 'uploadCsv'])->name('scannerWARA.import');

            Route::get('/cctvWara', [InvCctvWARAController::class, 'index'])->name('cctvWARA.page');
            Route::get('/cctvWara/create', [InvCctvWARAController::class, 'create'])->name('cctvWARA.create');
            Route::post('/cctvWara/create', [InvCctvWARAController::class, 'store'])->name('cctvWARA.store');
            Route::get('/cctvWara/{id}/edit', [InvCctvWARAController::class, 'edit'])->name('cctvWARA.edit');
            Route::delete('/cctvWara/{id}/delete', [InvCctvWARAController::class, 'destroy'])->name('cctvWARA.delete');
            Route::post('/cctvWara/update', [InvCctvWARAController::class, 'update'])->name('cctvWARA.update');
            Route::get('/cctvWara/{id}/detail', [InvCctvWARAController::class, 'detail'])->name('cctvWARA.detail');
            Route::post('/uploadCsvCCTVWara', [InvCctvWARAController::class, 'uploadCsv'])->name('cctvWARA.import');
        });

        Route::prefix('itportal')->group(function () {
            Route::group(['middleware' => 'checkRole:ict_developer:BIB'], function () {
                Route::get('/Management-User-Ict', [UserController::class, 'index'])->name('managementUserIct.page');
                Route::get('/Management-User-Ict/{id}/edit', [UserController::class, 'edit'])->name('managementUserIct.edit');
                Route::post('/Management-User-Ict/update', [UserController::class, 'update'])->name('managementUserIct.update');
                Route::delete('/Management-User-Ict/{id}/delete', [UserController::class, 'destroy'])->name('managementUserIct.delete');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_ho:HO,ict_bod:HO'], function () {
                Route::get('/pengguna', [UserAllController::class, 'index'])->name('pengguna.page');
                Route::get('/pengguna/create', [UserAllController::class, 'create'])->name('pengguna.create');
                Route::post('/pengguna/create', [UserAllController::class, 'store'])->name('pengguna.store');
                Route::get('/pengguna/{id}/edit', [UserAllController::class, 'edit'])->name('pengguna.edit');
                Route::put('/pengguna/{id}/update', [UserAllController::class, 'update'])->name('pengguna.update');
                Route::delete('/pengguna/{id}/delete', [UserAllController::class, 'destroy'])->name('pengguna.delete');
                Route::post('/uploadCsvPengguna', [UserAllController::class, 'uploadCsv'])->name('pengguna.import');

                Route::get('departement', [DepartmentController::class, 'index'])->name('department.page');
                Route::get('departement/create', [DepartmentController::class, 'create'])->name('department.create');
                Route::post('departement/create', [DepartmentController::class, 'store'])->name('department.store');
                Route::get('departement/{id}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
                Route::put('departement/{id}/update', [DepartmentController::class, 'update'])->name('department.update');
                Route::delete('departement/{id}/delete', [DepartmentController::class, 'destroy'])->name('department.delete');

                Route::get('akses', [AdminPengajuanRoleController::class, 'index'])->name('akses.page');
                Route::get('akses/{id}/edit', [AdminPengajuanRoleController::class, 'edit'])->name('akses.edit');
                Route::post('akses/update', [AdminPengajuanRoleController::class, 'update'])->name('akses.update');
                Route::delete('akses/{id}/delete', [AdminPengajuanRoleController::class, 'destroy'])->name('akses.delete');

                Route::get('inspeksi-komputer', [InspeksiComputerController::class, 'index'])->name('inspeksiKomputer.page');
                Route::get('inspeksi-komputer/{id}/inspection', [InspeksiComputerController::class, 'doInspection'])->name('inspeksiKomputer.inspection');
                Route::post('inspeksi-komputer/inspection', [InspeksiComputerController::class, 'store'])->name('inspeksiKomputer.store');
                Route::get('inspeksi-komputer/{id}/edit', [InspeksiComputerController::class, 'edit'])->name('inspeksiKomputer.edit');
                Route::put('inspeksi-komputer/{id}/update', [InspeksiComputerController::class, 'update'])->name('inspeksiKomputer.update');
                Route::get('/inspeksi-komputer/{id}/detail', [InspeksiComputerController::class, 'detail'])->name('inspeksiKomputer.detail');
                Route::delete('inspeksi-komputer/{id}/delete', [InspeksiComputerController::class, 'destroy'])->name('inspeksiKomputer.delete');

                Route::get('inspeksi-laptop', [InspeksiLaptopController::class, 'index'])->name('inspeksiLaptop.page');
                Route::get('inspeksi-laptop/{id}/process', [InspeksiLaptopController::class, 'process'])->name('inspeksiLaptop.process');
                Route::post('inspeksi-laptop/process', [InspeksiLaptopController::class, 'store'])->name('inspeksiLaptop.store');
                Route::get('inspeksi-laptop/{id}/edit', [InspeksiLaptopController::class, 'edit'])->name('inspeksiLaptop.edit');
                Route::post('inspeksi-laptop/update', [InspeksiLaptopController::class, 'update'])->name('inspeksiLaptop.update');
                Route::get('/inspeksi-laptop/{id}/detail', [InspeksiLaptopController::class, 'detail'])->name('inspeksiLaptop.detail');
                Route::delete('inspeksi-laptop/{id}/delete', [InspeksiLaptopController::class, 'destroy'])->name('inspeksiLaptop.delete');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:BA,ict_group_leader:BA,ict_admin:BA,ict_ho:HO'], function () {
                Route::get('inspeksi-laptop-ba', [InspeksiLaptopBaController::class, 'index'])->name('inspeksiLaptopBa.page');
                Route::get('inspeksi-laptop-ba/{id}/process', [InspeksiLaptopBaController::class, 'process'])->name('inspeksiLaptopBa.process');
                Route::post('inspeksi-laptop-ba/process', [InspeksiLaptopBaController::class, 'store'])->name('inspeksiLaptopBa.store');
                Route::get('inspeksi-laptop-ba/{id}/edit', [InspeksiLaptopBaController::class, 'edit'])->name('inspeksiLaptopBa.edit');
                Route::post('inspeksi-laptop-ba/update', [InspeksiLaptopBaController::class, 'update'])->name('inspeksiLaptopBa.update');
                Route::get('/inspeksi-laptop-ba/{id}/detail', [InspeksiLaptopBaController::class, 'detail'])->name('inspeksiLaptopBa.detail');
                Route::delete('inspeksi-laptop-ba/{id}/delete', [InspeksiLaptopBaController::class, 'destroy'])->name('inspeksiLaptopBa.delete');

                Route::get('inspeksi-komputer-ba', [InspeksiComputerBaController::class, 'index'])->name('inspeksiKomputerBa.page');
                Route::get('inspeksi-komputer-ba/{id}/inspection', [InspeksiComputerBaController::class, 'doInspection'])->name('inspeksiKomputerBa.inspection');
                Route::post('inspeksi-komputer-ba/inspection', [InspeksiComputerBaController::class, 'store'])->name('inspeksiKomputerBa.store');
                Route::get('inspeksi-komputer-ba/{id}/edit', [InspeksiComputerBaController::class, 'edit'])->name('inspeksiKomputerBa.edit');
                Route::put('inspeksi-komputer-ba/{id}/update', [InspeksiComputerBaController::class, 'update'])->name('inspeksiKomputerBa.update');
                Route::get('/inspeksi-komputer-ba/{id}/detail', [InspeksiComputerBaController::class, 'detail'])->name('inspeksiKomputerBa.detail');
                Route::delete('inspeksi-komputer-ba/{id}/delete', [InspeksiComputerBaController::class, 'destroy'])->name('inspeksiKomputerBa.delete');

                Route::get('/pengguna-ba', [UserAllBaController::class, 'index'])->name('penggunaBa.page');
                Route::get('/pengguna-ba/create', [UserAllBaController::class, 'create'])->name('penggunaBa.create');
                Route::post('/pengguna-ba/create', [UserAllBaController::class, 'store'])->name('penggunaBa.store');
                Route::get('/pengguna-ba/{id}/edit', [UserAllBaController::class, 'edit'])->name('penggunaBa.edit');
                Route::put('/pengguna-ba/{id}/update', [UserAllBaController::class, 'update'])->name('penggunaBa.update');
                Route::delete('/pengguna-ba/{id}/delete', [UserAllBaController::class, 'destroy'])->name('penggunaBa.delete');
                Route::post('/uploadCsvPenggunaBa', [UserAllBaController::class, 'uploadCsv'])->name('penggunaBa.import');

                Route::get('department-ba', [DepartmentController::class, 'index'])->name('departmentBa.page');
                Route::get('department-ba/create', [DepartmentController::class, 'create'])->name('departmentBa.create');
                Route::post('department-ba/create', [DepartmentController::class, 'store'])->name('departmentBa.store');
                Route::get('department-ba/{id}/edit', [DepartmentController::class, 'edit'])->name('departmentBa.edit');
                Route::put('department-ba/{id}/update', [DepartmentController::class, 'update'])->name('departmentBa.update');
                Route::delete('department-ba/{id}/delete', [DepartmentController::class, 'destroy'])->name('departmentBa.delete');

                Route::get('akses-ba', [AdminPengajuanRoleBaController::class, 'index'])->name('aksesBa.page');
                Route::get('akses-ba/{id}/edit', [AdminPengajuanRoleBaController::class, 'edit'])->name('aksesBa.edit');
                Route::post('akses-ba/update', [AdminPengajuanRoleBaController::class, 'update'])->name('aksesBa.update');
                Route::delete('akses-ba/{id}/delete', [AdminPengajuanRoleBaController::class, 'destroy'])->name('aksesBa.delete');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:MIFA,ict_group_leader:MIFA,ict_admin:MIFA,ict_ho:HO'], function () {
                Route::get('inspeksi-laptop-mifa', [InspeksiLaptopMifaController::class, 'index'])->name('inspeksiLaptopMifa.page');
                Route::get('inspeksi-laptop-mifa/{id}/process', [InspeksiLaptopMifaController::class, 'process'])->name('inspeksiLaptopMifa.process');
                Route::post('inspeksi-laptop-mifa/process', [InspeksiLaptopMifaController::class, 'store'])->name('inspeksiLaptopMifa.store');
                Route::get('inspeksi-laptop-mifa/{id}/edit', [InspeksiLaptopMifaController::class, 'edit'])->name('inspeksiLaptopMifa.edit');
                Route::post('inspeksi-laptop-mifa/update', [InspeksiLaptopMifaController::class, 'update'])->name('inspeksiLaptopMifa.update');
                Route::get('/inspeksi-laptop-mifa/{id}/detail', [InspeksiLaptopMifaController::class, 'detail'])->name('inspeksiLaptopMifa.detail');
                Route::delete('inspeksi-laptop-mifa/{id}/delete', [InspeksiLaptopMifaController::class, 'destroy'])->name('inspeksiLaptopMifa.delete');

                Route::get('inspeksi-komputer-mifa', [InspeksiComputerMifaController::class, 'index'])->name('inspeksiKomputerMifa.page');
                Route::get('inspeksi-komputer-mifa/{id}/inspection', [InspeksiComputerMifaController::class, 'doInspection'])->name('inspeksiKomputerMifa.inspection');
                Route::post('inspeksi-komputer-mifa/inspection', [InspeksiComputerMifaController::class, 'store'])->name('inspeksiKomputerMifa.store');
                Route::get('inspeksi-komputer-mifa/{id}/edit', [InspeksiComputerMifaController::class, 'edit'])->name('inspeksiKomputerMifa.edit');
                Route::put('inspeksi-komputer-mifa/{id}/update', [InspeksiComputerMifaController::class, 'update'])->name('inspeksiKomputerMifa.update');
                Route::get('/inspeksi-komputer-mifa/{id}/detail', [InspeksiComputerMifaController::class, 'detail'])->name('inspeksiKomputerMifa.detail');
                Route::delete('inspeksi-komputer-mifa/{id}/delete', [InspeksiComputerMifaController::class, 'destroy'])->name('inspeksiKomputerMifa.delete');

                Route::get('/pengguna-mifa', [UserAllMifaController::class, 'index'])->name('penggunaMifa.page');
                Route::get('/pengguna-mifa/create', [UserAllMifaController::class, 'create'])->name('penggunaMifa.create');
                Route::post('/pengguna-mifa/create', [UserAllMifaController::class, 'store'])->name('penggunaMifa.store');
                Route::get('/pengguna-mifa/{id}/edit', [UserAllMifaController::class, 'edit'])->name('penggunaMifa.edit');
                Route::put('/pengguna-mifa/{id}/update', [UserAllMifaController::class, 'update'])->name('penggunaMifa.update');
                Route::delete('/pengguna-mifa/{id}/delete', [UserAllMifaController::class, 'destroy'])->name('penggunaMifa.delete');
                Route::post('/uploadCsvPenggunaBa', [UserAllMifaController::class, 'uploadCsv'])->name('penggunaMifa.import');

                Route::get('department-mifa', [DepartmentController::class, 'index'])->name('departmentMifa.page');
                Route::get('department-mifa/create', [DepartmentController::class, 'create'])->name('departmentMifa.create');
                Route::post('department-mifa/create', [DepartmentController::class, 'store'])->name('departmentMifa.store');
                Route::get('department-mifa/{id}/edit', [DepartmentController::class, 'edit'])->name('departmentMifa.edit');
                Route::put('department-mifa/{id}/update', [DepartmentController::class, 'update'])->name('departmentMifa.update');
                Route::delete('department-mifa/{id}/delete', [DepartmentController::class, 'destroy'])->name('departmentMifa.delete');

                Route::get('akses-mifa', [AdminPengajuanRoleMifaController::class, 'index'])->name('aksesMifa.page');
                Route::get('akses-mifa/{id}/edit', [AdminPengajuanRoleMifaController::class, 'edit'])->name('aksesMifa.edit');
                Route::post('akses-mifa/update', [AdminPengajuanRoleMifaController::class, 'update'])->name('aksesMifa.update');
                Route::delete('akses-mifa/{id}/delete', [AdminPengajuanRoleMifaController::class, 'destroy'])->name('aksesMifa.delete');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:MHU,ict_group_leader:MHU,ict_admin:MHU,ict_ho:HO'], function () {
                Route::get('inspeksi-laptop-mhu', [InspeksiLaptopMhuController::class, 'index'])->name('inspeksiLaptopMhu.page');
                Route::get('inspeksi-laptop-mhu/{id}/process', [InspeksiLaptopMhuController::class, 'process'])->name('inspeksiLaptopMhu.process');
                Route::post('inspeksi-laptop-mhu/process', [InspeksiLaptopMhuController::class, 'store'])->name('inspeksiLaptopMhu.store');
                Route::get('inspeksi-laptop-mhu/{id}/edit', [InspeksiLaptopMhuController::class, 'edit'])->name('inspeksiLaptopMhu.edit');
                Route::post('inspeksi-laptop-mhu/update', [InspeksiLaptopMhuController::class, 'update'])->name('inspeksiLaptopMhu.update');
                Route::get('/inspeksi-laptop-mhu/{id}/detail', [InspeksiLaptopMhuController::class, 'detail'])->name('inspeksiLaptopMhu.detail');
                Route::delete('inspeksi-laptop-mhu/{id}/delete', [InspeksiLaptopMhuController::class, 'destroy'])->name('inspeksiLaptopMhu.delete');

                Route::get('inspeksi-komputer-mhu', [InspeksiComputerMhuController::class, 'index'])->name('inspeksiKomputerMhu.page');
                Route::get('inspeksi-komputer-mhu/{id}/inspection', [InspeksiComputerMhuController::class, 'doInspection'])->name('inspeksiKomputerMhu.inspection');
                Route::post('inspeksi-komputer-mhu/inspection', [InspeksiComputerMhuController::class, 'store'])->name('inspeksiKomputerMhu.store');
                Route::get('inspeksi-komputer-mhu/{id}/edit', [InspeksiComputerMhuController::class, 'edit'])->name('inspeksiKomputerMhu.edit');
                Route::put('inspeksi-komputer-mhu/{id}/update', [InspeksiComputerMhuController::class, 'update'])->name('inspeksiKomputerMhu.update');
                Route::get('/inspeksi-komputer-mhu/{id}/detail', [InspeksiComputerMhuController::class, 'detail'])->name('inspeksiKomputerMhu.detail');
                Route::delete('inspeksi-komputer-mhu/{id}/delete', [InspeksiComputerMhuController::class, 'destroy'])->name('inspeksiKomputerMhu.delete');

                Route::get('/pengguna-mhu', [UserAllMhuController::class, 'index'])->name('penggunaMhu.page');
                Route::get('/pengguna-mhu/create', [UserAllMhuController::class, 'create'])->name('penggunaMhu.create');
                Route::post('/pengguna-mhu/create', [UserAllMhuController::class, 'store'])->name('penggunaMhu.store');
                Route::get('/pengguna-mhu/{id}/edit', [UserAllMhuController::class, 'edit'])->name('penggunaMhu.edit');
                Route::put('/pengguna-mhu/{id}/update', [UserAllMhuController::class, 'update'])->name('penggunaMhu.update');
                Route::delete('/pengguna-mhu/{id}/delete', [UserAllMhuController::class, 'destroy'])->name('penggunaMhu.delete');
                Route::post('/uploadCsvPenggunaBa', [UserAllMhuController::class, 'uploadCsv'])->name('penggunaMhu.import');

                // Route::get('department-mhu', [DepartmentMifaController::class, 'index'])->name('departmentMifa.page');
                // Route::get('department-mhu/create', [DepartmentMifaController::class, 'create'])->name('departmentMifa.create');
                // Route::post('department-mhu/create', [DepartmentMifaController::class, 'store'])->name('departmentMifa.store');
                // Route::get('department-mhu/{id}/edit', [DepartmentMifaController::class, 'edit'])->name('departmentMifa.edit');
                // Route::put('department-mhu/{id}/update', [DepartmentMifaController::class, 'update'])->name('departmentMifa.update');
                // Route::delete('department-mhu/{id}/delete', [DepartmentMifaController::class, 'destroy'])->name('departmentMifa.delete');

                // Route::get('akses-mhu', [AdminPengajuanRoleMifaController::class, 'index'])->name('aksesMifa.page');
                // Route::get('akses-mhu/{id}/edit', [AdminPengajuanRoleMifaController::class, 'edit'])->name('aksesMifa.edit');
                // Route::post('akses-mhu/update', [AdminPengajuanRoleMifaController::class, 'update'])->name('aksesMifa.update');
                // Route::delete('akses-mhu/{id}/delete', [AdminPengajuanRoleMifaController::class, 'destroy'])->name('aksesMifa.delete');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:ADW,ict_group_leader:ADW,ict_admin:ADW,ict_ho:HO'], function () {
                Route::get('inspeksi-laptop-Wara', [InspeksiLaptopWARAController::class, 'index'])->name('inspeksiLaptopWARA.page');
                Route::get('inspeksi-laptop-Wara/{id}/process', [InspeksiLaptopWARAController::class, 'process'])->name('inspeksiLaptopWARA.process');
                Route::post('inspeksi-laptop-Wara/process', [InspeksiLaptopWARAController::class, 'store'])->name('inspeksiLaptopWARA.store');
                Route::get('inspeksi-laptop-Wara/{id}/edit', [InspeksiLaptopWARAController::class, 'edit'])->name('inspeksiLaptopWARA.edit');
                Route::post('inspeksi-laptop-Wara/update', [InspeksiLaptopWARAController::class, 'update'])->name('inspeksiLaptopWARA.update');
                Route::get('/inspeksi-laptop-Wara/{id}/detail', [InspeksiLaptopWARAController::class, 'detail'])->name('inspeksiLaptopWARA.detail');
                Route::delete('inspeksi-laptop-Wara/{id}/delete', [InspeksiLaptopWARAController::class, 'destroy'])->name('inspeksiLaptopWARA.delete');

                Route::get('inspeksi-komputer-Wara', [InspeksiComputerWARAController::class, 'index'])->name('inspeksiKomputerWARA.page');
                Route::get('inspeksi-komputer-Wara/{id}/inspection', [InspeksiComputerWARAController::class, 'doInspection'])->name('inspeksiKomputerWARA.inspection');
                Route::post('inspeksi-komputer-Wara/inspection', [InspeksiComputerWARAController::class, 'store'])->name('inspeksiKomputerWARA.store');
                Route::get('inspeksi-komputer-Wara/{id}/edit', [InspeksiComputerWARAController::class, 'edit'])->name('inspeksiKomputerWARA.edit');
                Route::put('inspeksi-komputer-Wara/{id}/update', [InspeksiComputerWARAController::class, 'update'])->name('inspeksiKomputerWARA.update');
                Route::get('/inspeksi-komputer-Wara/{id}/detail', [InspeksiComputerWARAController::class, 'detail'])->name('inspeksiKomputerWARA.detail');
                Route::delete('inspeksi-komputer-Wara/{id}/delete', [InspeksiComputerWARAController::class, 'destroy'])->name('inspeksiKomputerWARA.delete');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:AMI,ict_group_leader:AMI,ict_admin:AMI,ict_ho:HO'], function () {
                Route::get('inspeksi-laptop-ami', [InspeksiLaptopAmiController::class, 'index'])->name('inspeksiLaptopAmi.page');
                Route::get('inspeksi-laptop-ami/{id}/process', [InspeksiLaptopAmiController::class, 'process'])->name('inspeksiLaptopAmi.process');
                Route::post('inspeksi-laptop-ami/process', [InspeksiLaptopAmiController::class, 'store'])->name('inspeksiLaptopAmi.store');
                Route::get('inspeksi-laptop-ami/{id}/edit', [InspeksiLaptopAmiController::class, 'edit'])->name('inspeksiLaptopAmi.edit');
                Route::post('inspeksi-laptop-ami/update', [InspeksiLaptopAmiController::class, 'update'])->name('inspeksiLaptopAmi.update');
                Route::get('/inspeksi-laptop-ami/{id}/detail', [InspeksiLaptopAmiController::class, 'detail'])->name('inspeksiLaptopAmi.detail');
                Route::delete('inspeksi-laptop-ami/{id}/delete', [InspeksiLaptopAmiController::class, 'destroy'])->name('inspeksiLaptopAmi.delete');

                Route::get('inspeksi-komputer-ami', [InspeksiComputerAmiController::class, 'index'])->name('inspeksiKomputerAmi.page');
                Route::get('inspeksi-komputer-ami/{id}/inspection', [InspeksiComputerAmiController::class, 'doInspection'])->name('inspeksiKomputerAmi.inspection');
                Route::post('inspeksi-komputer-ami/inspection', [InspeksiComputerAmiController::class, 'store'])->name('inspeksiKomputerAmi.store');
                Route::get('inspeksi-komputer-ami/{id}/edit', [InspeksiComputerAmiController::class, 'edit'])->name('inspeksiKomputerAmi.edit');
                Route::put('inspeksi-komputer-ami/{id}/update', [InspeksiComputerAmiController::class, 'update'])->name('inspeksiKomputerAmi.update');
                Route::get('/inspeksi-komputer-ami/{id}/detail', [InspeksiComputerAmiController::class, 'detail'])->name('inspeksiKomputerAmi.detail');
                Route::delete('inspeksi-komputer-ami/{id}/delete', [InspeksiComputerAmiController::class, 'destroy'])->name('inspeksiKomputerAmi.delete');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:PIK,ict_group_leader:PIK,ict_admin:PIK,ict_ho:HO'], function () {
                Route::get('inspeksi-laptop-pik', [InspeksiLaptopPikController::class, 'index'])->name('inspeksiLaptopPik.page');
                Route::get('inspeksi-laptop-pik/{id}/process', [InspeksiLaptopPikController::class, 'process'])->name('inspeksiLaptopPik.process');
                Route::post('inspeksi-laptop-pik/process', [InspeksiLaptopPikController::class, 'store'])->name('inspeksiLaptopPik.store');
                Route::get('inspeksi-laptop-pik/{id}/edit', [InspeksiLaptopPikController::class, 'edit'])->name('inspeksiLaptopPik.edit');
                Route::post('inspeksi-laptop-pik/update', [InspeksiLaptopPikController::class, 'update'])->name('inspeksiLaptopPik.update');
                Route::get('/inspeksi-laptop-pik/{id}/detail', [InspeksiLaptopPikController::class, 'detail'])->name('inspeksiLaptopPik.detail');
                Route::delete('inspeksi-laptop-pik/{id}/delete', [InspeksiLaptopPikController::class, 'destroy'])->name('inspeksiLaptopPik.delete');

                Route::get('inspeksi-komputer-pik', [InspeksiComputerPikController::class, 'index'])->name('inspeksiKomputerPik.page');
                Route::get('inspeksi-komputer-pik/{id}/inspection', [InspeksiComputerPikController::class, 'doInspection'])->name('inspeksiKomputerPik.inspection');
                Route::post('inspeksi-komputer-pik/inspection', [InspeksiComputerPikController::class, 'store'])->name('inspeksiKomputerPik.store');
                Route::get('inspeksi-komputer-pik/{id}/edit', [InspeksiComputerPikController::class, 'edit'])->name('inspeksiKomputerPik.edit');
                Route::put('inspeksi-komputer-pik/{id}/update', [InspeksiComputerPikController::class, 'update'])->name('inspeksiKomputerPik.update');
                Route::get('/inspeksi-komputer-pik/{id}/detail', [InspeksiComputerPikController::class, 'detail'])->name('inspeksiKomputerPik.detail');
                Route::delete('inspeksi-komputer-pik/{id}/delete', [InspeksiComputerPikController::class, 'destroy'])->name('inspeksiKomputerPik.delete');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_group_leader:BGE,ict_ho:HO'], function () {
                Route::get('inspeksi-laptop-Bge', [InspeksiLaptopBgeController::class, 'index'])->name('inspeksiLaptopBge.page');
                Route::get('inspeksi-laptop-Bge/{id}/process', [InspeksiLaptopBgeController::class, 'process'])->name('inspeksiLaptopBge.process');
                Route::post('inspeksi-laptop-Bge/process', [InspeksiLaptopBgeController::class, 'store'])->name('inspeksiLaptopBge.store');
                Route::get('inspeksi-laptop-Bge/{id}/edit', [InspeksiLaptopBgeController::class, 'edit'])->name('inspeksiLaptopBge.edit');
                Route::post('inspeksi-laptop-Bge/update', [InspeksiLaptopBgeController::class, 'update'])->name('inspeksiLaptopBge.update');
                Route::get('/inspeksi-laptop-Bge/{id}/detail', [InspeksiLaptopBgeController::class, 'detail'])->name('inspeksiLaptopBge.detail');
                Route::delete('inspeksi-laptop-Bge/{id}/delete', [InspeksiLaptopBgeController::class, 'destroy'])->name('inspeksiLaptopBge.delete');

                Route::get('inspeksi-komputer-Bge', [InspeksiComputerBgeController::class, 'index'])->name('inspeksiKomputerBge.page');
                Route::get('inspeksi-komputer-Bge/{id}/inspection', [InspeksiComputerBgeController::class, 'doInspection'])->name('inspeksiKomputerBge.inspection');
                Route::post('inspeksi-komputer-Bge/inspection', [InspeksiComputerBgeController::class, 'store'])->name('inspeksiKomputerBge.store');
                Route::get('inspeksi-komputer-Bge/{id}/edit', [InspeksiComputerBgeController::class, 'edit'])->name('inspeksiKomputerBge.edit');
                Route::put('inspeksi-komputer-Bge/{id}/update', [InspeksiComputerBgeController::class, 'update'])->name('inspeksiKomputerBge.update');
                Route::get('/inspeksi-komputer-Bge/{id}/detail', [InspeksiComputerBgeController::class, 'detail'])->name('inspeksiKomputerBge.detail');
                Route::delete('inspeksi-komputer-Bge/{id}/delete', [InspeksiComputerBgeController::class, 'destroy'])->name('inspeksiKomputerBge.delete');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:BIB,ict_group_leader:BIB,ict_admin:BIB,ict_ho:HO'], function () {
                Route::get('inspeksi-laptop-bib', [InspeksiLaptopBibController::class, 'index'])->name('inspeksiLaptopBib.page');
                Route::get('inspeksi-laptop-bib/{id}/process', [InspeksiLaptopBibController::class, 'process'])->name('inspeksiLaptopBib.process');
                Route::post('inspeksi-laptop-bib/process', [InspeksiLaptopBibController::class, 'store'])->name('inspeksiLaptopBib.store');
                Route::get('inspeksi-laptop-bib/{id}/edit', [InspeksiLaptopBibController::class, 'edit'])->name('inspeksiLaptopBib.edit');
                Route::post('inspeksi-laptop-bib/update', [InspeksiLaptopBibController::class, 'update'])->name('inspeksiLaptopBib.update');
                Route::get('/inspeksi-laptop-bib/{id}/detail', [InspeksiLaptopBibController::class, 'detail'])->name('inspeksiLaptopBib.detail');
                Route::delete('inspeksi-laptop-bib/{id}/delete', [InspeksiLaptopBibController::class, 'destroy'])->name('inspeksiLaptopBib.delete');

                Route::get('inspeksi-komputer-bib', [InspeksiComputerBibController::class, 'index'])->name('inspeksiKomputerBib.page');
                Route::get('inspeksi-komputer-bib/{id}/inspection', [InspeksiComputerBibController::class, 'doInspection'])->name('inspeksiKomputerBib.inspection');
                Route::post('inspeksi-komputer-bib/inspection', [InspeksiComputerBibController::class, 'store'])->name('inspeksiKomputerBib.store');
                Route::get('inspeksi-komputer-bib/{id}/edit', [InspeksiComputerBibController::class, 'edit'])->name('inspeksiKomputerBib.edit');
                Route::put('inspeksi-komputer-bib/{id}/update', [InspeksiComputerBibController::class, 'update'])->name('inspeksiKomputerBib.update');
                Route::get('/inspeksi-komputer-bib/{id}/detail', [InspeksiComputerBibController::class, 'detail'])->name('inspeksiKomputerBib.detail');
                Route::delete('inspeksi-komputer-bib/{id}/delete', [InspeksiComputerBibController::class, 'destroy'])->name('inspeksiKomputerBib.delete');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:IPT,ict_group_leader:IPT,ict_admin:IPT,ict_ho:HO'], function () {
                Route::get('inspeksi-laptop-ipt', [InspeksiLaptopIptController::class, 'index'])->name('inspeksiLaptopIpt.page');
                Route::get('inspeksi-laptop-ipt/{id}/process', [InspeksiLaptopIptController::class, 'process'])->name('inspeksiLaptopIpt.process');
                Route::post('inspeksi-laptop-ipt/process', [InspeksiLaptopIptController::class, 'store'])->name('inspeksiLaptopIpt.store');
                Route::get('inspeksi-laptop-ipt/{id}/edit', [InspeksiLaptopIptController::class, 'edit'])->name('inspeksiLaptopIpt.edit');
                Route::post('inspeksi-laptop-ipt/update', [InspeksiLaptopIptController::class, 'update'])->name('inspeksiLaptopIpt.update');
                Route::get('/inspeksi-laptop-ipt/{id}/detail', [InspeksiLaptopIptController::class, 'detail'])->name('inspeksiLaptopIpt.detail');
                Route::delete('inspeksi-laptop-ipt/{id}/delete', [InspeksiLaptopIptController::class, 'destroy'])->name('inspeksiLaptopIpt.delete');

                Route::get('inspeksi-komputer-ipt', [InspeksiComputerIptController::class, 'index'])->name('inspeksiKomputerIpt.page');
                Route::get('inspeksi-komputer-ipt/{id}/inspection', [InspeksiComputerIptController::class, 'doInspection'])->name('inspeksiKomputerIpt.inspection');
                Route::post('inspeksi-komputer-ipt/inspection', [InspeksiComputerIptController::class, 'store'])->name('inspeksiKomputerIpt.store');
                Route::get('inspeksi-komputer-ipt/{id}/edit', [InspeksiComputerIptController::class, 'edit'])->name('inspeksiKomputerIpt.edit');
                Route::put('inspeksi-komputer-ipt/{id}/update', [InspeksiComputerIptController::class, 'update'])->name('inspeksiKomputerIpt.update');
                Route::get('/inspeksi-komputer-ipt/{id}/detail', [InspeksiComputerIptController::class, 'detail'])->name('inspeksiKomputerIpt.detail');
                Route::delete('inspeksi-komputer-ipt/{id}/delete', [InspeksiComputerIptController::class, 'destroy'])->name('inspeksiKomputerIpt.delete');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:MLP,ict_group_leader:MLP,ict_admin:MLP,ict_ho:HO'], function () {
                Route::get('inspeksi-laptop-mlp', [InspeksiLaptopMlpController::class, 'index'])->name('inspeksiLaptopMlp.page');
                Route::get('inspeksi-laptop-mlp/{id}/process', [InspeksiLaptopMlpController::class, 'process'])->name('inspeksiLaptopMlp.process');
                Route::post('inspeksi-laptop-mlp/process', [InspeksiLaptopMlpController::class, 'store'])->name('inspeksiLaptopMlp.store');
                Route::get('inspeksi-laptop-mlp/{id}/edit', [InspeksiLaptopMlpController::class, 'edit'])->name('inspeksiLaptopMlp.edit');
                Route::post('inspeksi-laptop-mlp/update', [InspeksiLaptopMlpController::class, 'update'])->name('inspeksiLaptopMlp.update');
                Route::get('/inspeksi-laptop-mlp/{id}/detail', [InspeksiLaptopMlpController::class, 'detail'])->name('inspeksiLaptopMlp.detail');
                Route::delete('inspeksi-laptop-mlp/{id}/delete', [InspeksiLaptopMlpController::class, 'destroy'])->name('inspeksiLaptopMlp.delete');

                Route::get('inspeksi-komputer-mlp', [InspeksiComputerMlpController::class, 'index'])->name('inspeksiKomputerMlp.page');
                Route::get('inspeksi-komputer-mlp/{id}/inspection', [InspeksiComputerMlpController::class, 'doInspection'])->name('inspeksiKomputerMlp.inspection');
                Route::post('inspeksi-komputer-mlp/inspection', [InspeksiComputerMlpController::class, 'store'])->name('inspeksiKomputerMlp.store');
                Route::get('inspeksi-komputer-mlp/{id}/edit', [InspeksiComputerMlpController::class, 'edit'])->name('inspeksiKomputerMlp.edit');
                Route::put('inspeksi-komputer-mlp/{id}/update', [InspeksiComputerMlpController::class, 'update'])->name('inspeksiKomputerMlp.update');
                Route::get('/inspeksi-komputer-mlp/{id}/detail', [InspeksiComputerMlpController::class, 'detail'])->name('inspeksiKomputerMlp.detail');
                Route::delete('inspeksi-komputer-mlp/{id}/delete', [InspeksiComputerMlpController::class, 'destroy'])->name('inspeksiKomputerMlp.delete');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:MIP,ict_group_leader:MIP,ict_admin:MIP,ict_ho:HO'], function () {
                Route::get('inspeksi-laptop-mip', [InspeksiLaptopMipController::class, 'index'])->name('inspeksiLaptopMip.page');
                Route::get('inspeksi-laptop-mip/{id}/process', [InspeksiLaptopMipController::class, 'process'])->name('inspeksiLaptopMip.process');
                Route::post('inspeksi-laptop-mip/process', [InspeksiLaptopMipController::class, 'store'])->name('inspeksiLaptopMip.store');
                Route::get('inspeksi-laptop-mip/{id}/edit', [InspeksiLaptopMipController::class, 'edit'])->name('inspeksiLaptopMip.edit');
                Route::post('inspeksi-laptop-mip/update', [InspeksiLaptopMipController::class, 'update'])->name('inspeksiLaptopMip.update');
                Route::get('/inspeksi-laptop-mip/{id}/detail', [InspeksiLaptopMipController::class, 'detail'])->name('inspeksiLaptopMip.detail');
                Route::delete('inspeksi-laptop-mip/{id}/delete', [InspeksiLaptopMipController::class, 'destroy'])->name('inspeksiLaptopMip.delete');

                Route::get('inspeksi-komputer-mip', [InspeksiComputerMipController::class, 'index'])->name('inspeksiKomputerMip.page');
                Route::get('inspeksi-komputer-mip/{id}/inspection', [InspeksiComputerMipController::class, 'doInspection'])->name('inspeksiKomputerMip.inspection');
                Route::post('inspeksi-komputer-mip/inspection', [InspeksiComputerMipController::class, 'store'])->name('inspeksiKomputerMip.store');
                Route::get('inspeksi-komputer-mip/{id}/edit', [InspeksiComputerMipController::class, 'edit'])->name('inspeksiKomputerMip.edit');
                Route::put('inspeksi-komputer-mip/{id}/update', [InspeksiComputerMipController::class, 'update'])->name('inspeksiKomputerMip.update');
                Route::get('/inspeksi-komputer-mip/{id}/detail', [InspeksiComputerMipController::class, 'detail'])->name('inspeksiKomputerMip.detail');
                Route::delete('inspeksi-komputer-mip/{id}/delete', [InspeksiComputerMipController::class, 'destroy'])->name('inspeksiKomputerMip.delete');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:VIB,ict_group_leader:VIB,ict_admin:VIB,ict_ho:HO'], function () {
                Route::get('inspeksi-laptop-vale', [InspeksiLaptopValeController::class, 'index'])->name('inspeksiLaptopVale.page');
                Route::get('inspeksi-laptop-vale/{id}/process', [InspeksiLaptopValeController::class, 'process'])->name('inspeksiLaptopVale.process');
                Route::post('inspeksi-laptop-vale/process', [InspeksiLaptopValeController::class, 'store'])->name('inspeksiLaptopVale.store');
                Route::get('inspeksi-laptop-vale/{id}/edit', [InspeksiLaptopValeController::class, 'edit'])->name('inspeksiLaptopVale.edit');
                Route::post('inspeksi-laptop-vale/update', [InspeksiLaptopValeController::class, 'update'])->name('inspeksiLaptopVale.update');
                Route::get('/inspeksi-laptop-vale/{id}/detail', [InspeksiLaptopValeController::class, 'detail'])->name('inspeksiLaptopVale.detail');
                Route::delete('inspeksi-laptop-vale/{id}/delete', [InspeksiLaptopValeController::class, 'destroy'])->name('inspeksiLaptopVale.delete');

                Route::get('inspeksi-komputer-vale', [InspeksiComputerValeController::class, 'index'])->name('inspeksiKomputerVale.page');
                Route::get('inspeksi-komputer-vale/{id}/inspection', [InspeksiComputerValeController::class, 'doInspection'])->name('inspeksiKomputerVale.inspection');
                Route::post('inspeksi-komputer-vale/inspection', [InspeksiComputerValeController::class, 'store'])->name('inspeksiKomputerVale.store');
                Route::get('inspeksi-komputer-vale/{id}/edit', [InspeksiComputerValeController::class, 'edit'])->name('inspeksiKomputerVale.edit');
                Route::put('inspeksi-komputer-vale/{id}/update', [InspeksiComputerValeController::class, 'update'])->name('inspeksiKomputerVale.update');
                Route::get('/inspeksi-komputer-vale/{id}/detail', [InspeksiComputerValeController::class, 'detail'])->name('inspeksiKomputerVale.detail');
                Route::delete('inspeksi-komputer-vale/{id}/delete', [InspeksiComputerValeController::class, 'destroy'])->name('inspeksiKomputerVale.delete');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:SBS,ict_group_leader:SBS,ict_admin:SBS,ict_ho:HO'], function () {
                Route::get('inspeksi-laptop-sbs', [InspeksiLaptopSbsController::class, 'index'])->name('inspeksiLaptopSbs.page');
                Route::get('inspeksi-laptop-sbs/{id}/process', [InspeksiLaptopSbsController::class, 'process'])->name('inspeksiLaptopSbs.process');
                Route::post('inspeksi-laptop-sbs/process', [InspeksiLaptopSbsController::class, 'store'])->name('inspeksiLaptopSbs.store');
                Route::get('inspeksi-laptop-sbs/{id}/edit', [InspeksiLaptopSbsController::class, 'edit'])->name('inspeksiLaptopSbs.edit');
                Route::post('inspeksi-laptop-sbs/update', [InspeksiLaptopSbsController::class, 'update'])->name('inspeksiLaptopSbs.update');
                Route::get('/inspeksi-laptop-sbs/{id}/detail', [InspeksiLaptopSbsController::class, 'detail'])->name('inspeksiLaptopSbs.detail');
                Route::delete('inspeksi-laptop-sbs/{id}/delete', [InspeksiLaptopSbsController::class, 'destroy'])->name('inspeksiLaptopSbs.delete');

                Route::get('inspeksi-komputer-sbs', [InspeksiComputerSbsController::class, 'index'])->name('inspeksiKomputerSbs.page');
                Route::get('inspeksi-komputer-sbs/{id}/inspection', [InspeksiComputerSbsController::class, 'doInspection'])->name('inspeksiKomputerSbs.inspection');
                Route::post('inspeksi-komputer-sbs/inspection', [InspeksiComputerSbsController::class, 'store'])->name('inspeksiKomputerSbs.store');
                Route::get('inspeksi-komputer-sbs/{id}/edit', [InspeksiComputerSbsController::class, 'edit'])->name('inspeksiKomputerSbs.edit');
                Route::put('inspeksi-komputer-sbs/{id}/update', [InspeksiComputerSbsController::class, 'update'])->name('inspeksiKomputerSbs.update');
                Route::get('/inspeksi-komputer-sbs/{id}/detail', [InspeksiComputerSbsController::class, 'detail'])->name('inspeksiKomputerSbs.detail');
                Route::delete('inspeksi-komputer-sbs/{id}/delete', [InspeksiComputerSbsController::class, 'destroy'])->name('inspeksiKomputerSbs.delete');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:SKS,ict_group_leader:SKS,ict_admin:SKS,ict_ho:HO'], function () {
                Route::get('inspeksi-laptop-sks', [InspeksiLaptopSksController::class, 'index'])->name('inspeksiLaptopSks.page');
                Route::get('inspeksi-laptop-sks/{id}/process', [InspeksiLaptopSksController::class, 'process'])->name('inspeksiLaptopSks.process');
                Route::post('inspeksi-laptop-sks/process', [InspeksiLaptopSksController::class, 'store'])->name('inspeksiLaptopSks.store');
                Route::get('inspeksi-laptop-sks/{id}/edit', [InspeksiLaptopSksController::class, 'edit'])->name('inspeksiLaptopSks.edit');
                Route::post('inspeksi-laptop-sks/update', [InspeksiLaptopSksController::class, 'update'])->name('inspeksiLaptopSks.update');
                Route::get('/inspeksi-laptop-sks/{id}/detail', [InspeksiLaptopSksController::class, 'detail'])->name('inspeksiLaptopSks.detail');
                Route::delete('inspeksi-laptop-sks/{id}/delete', [InspeksiLaptopSksController::class, 'destroy'])->name('inspeksiLaptopSks.delete');

                Route::get('inspeksi-komputer-sks', [InspeksiComputerSksController::class, 'index'])->name('inspeksiKomputerSks.page');
                Route::get('inspeksi-komputer-sks/{id}/inspection', [InspeksiComputerSksController::class, 'doInspection'])->name('inspeksiKomputerSks.inspection');
                Route::post('inspeksi-komputer-sks/inspection', [InspeksiComputerSksController::class, 'store'])->name('inspeksiKomputerSks.store');
                Route::get('inspeksi-komputer-sks/{id}/edit', [InspeksiComputerSksController::class, 'edit'])->name('inspeksiKomputerSks.edit');
                Route::put('inspeksi-komputer-sks/{id}/update', [InspeksiComputerSksController::class, 'update'])->name('inspeksiKomputerSks.update');
                Route::get('/inspeksi-komputer-sks/{id}/detail', [InspeksiComputerSksController::class, 'detail'])->name('inspeksiKomputerSks.detail');
                Route::delete('inspeksi-komputer-sks/{id}/delete', [InspeksiComputerSksController::class, 'destroy'])->name('inspeksiKomputerSks.delete');
            });
        });
    });

    Route::prefix('itportal')->group(function () {
        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_ho:HO,ict_bod:HO,soc_ho:HO'], function () {
            Route::get('/aduan', [AduanController::class, 'index'])->name('aduan.page');
            Route::get('/aduan/create', [AduanController::class, 'create'])->name('aduan.create');
            Route::post('/aduan/create', [AduanController::class, 'store'])->name('aduan.store');
            Route::post('/aduan/updateProgress', [AduanController::class, 'update_aduan_progress'])->name('aduan.updateProgress');
            Route::get('/aduan/{id}/edit', [AduanController::class, 'edit'])->name('aduan.edit');
            Route::get('/aduan/{id}/progress', [AduanController::class, 'progress'])->name('aduan.progress');
            Route::delete('/aduan/{id}/delete', [AduanController::class, 'destroy'])->name('aduan.delete');
            Route::post('/aduan/update', [AduanController::class, 'update_aduan'])->name('aduan.update');
            Route::get('/aduan/{id}/detail', [AduanController::class, 'detail'])->name('aduan.detail');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:BA,ict_ho:HO,ict_group_leader:BA,ict_admin:BA'], function () {
            Route::get('/aduanBa', [AduanBaController::class, 'index'])->name('aduanBa.page');
            Route::get('/aduanBa/create', [AduanBaController::class, 'create'])->name('aduanBa.create');
            Route::post('/aduanBa/create', [AduanBaController::class, 'store'])->name('aduanBa.store');
            Route::get('/aduanBa/{id}/edit', [AduanBaController::class, 'edit'])->name('aduanBa.edit');
            Route::post('/aduanBa/updateProgress', [AduanBaController::class, 'update_aduan_progress'])->name('aduanBa.updateProgress');
            Route::get('/aduanBa/{id}/progress', [AduanBaController::class, 'progress'])->name('aduanBa.progress');
            Route::delete('/aduanBa/{id}/delete', [AduanBaController::class, 'destroy'])->name('aduanBa.delete');
            Route::post('/aduanBa/update', [AduanBaController::class, 'update_aduan'])->name('aduanBa.update');
            Route::get('/aduanBa/{id}/detail', [AduanBaController::class, 'detail'])->name('aduanBa.detail');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:MIFA,ict_group_leader:MIFA,ict_ho:HO,ict_group_leader:MIFA,ict_admin:MIFA'], function () {
            Route::get('/aduanMifa', [AduanMifaController::class, 'index'])->name('aduanMifa.page');
            Route::get('/aduanMifa/create', [AduanMifaController::class, 'create'])->name('aduanMifa.create');
            Route::post('/aduanMifa/create', [AduanMifaController::class, 'store'])->name('aduanMifa.store');
            Route::get('/aduanMifa/{id}/edit', [AduanMifaController::class, 'edit'])->name('aduanMifa.edit');
            Route::post('/aduanMifa/updateProgress', [AduanMifaController::class, 'update_aduan_progress'])->name('aduanMifa.updateProgress');
            Route::get('/aduanMifa/{id}/progress', [AduanMifaController::class, 'progress'])->name('aduanMifa.progress');
            Route::delete('/aduanMifa/{id}/delete', [AduanMifaController::class, 'destroy'])->name('aduanMifa.delete');
            Route::post('/aduanMifa/update', [AduanMifaController::class, 'update_aduan'])->name('aduanMifa.update');
            Route::get('/aduanMifa/{id}/detail', [AduanMifaController::class, 'detail'])->name('aduanMifa.detail');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:MHU,ict_ho:HO,ict_group_leader:MHU,ict_admin:MHU'], function () {
            Route::get('/aduanMhu', [AduanMhuController::class, 'index'])->name('aduanMhu.page');
            Route::get('/aduanMhu/create', [AduanMhuController::class, 'create'])->name('aduanMhu.create');
            Route::post('/aduanMhu/create', [AduanMhuController::class, 'store'])->name('aduanMhu.store');
            Route::get('/aduanMhu/{id}/edit', [AduanMhuController::class, 'edit'])->name('aduanMhu.edit');
            Route::post('/aduanMhu/updateProgress', [AduanMhuController::class, 'update_aduan_progress'])->name('aduanMhu.updateProgress');
            Route::get('/aduanMhu/{id}/progress', [AduanMhuController::class, 'progress'])->name('aduanMhu.progress');
            Route::delete('/aduanMhu/{id}/delete', [AduanMhuController::class, 'destroy'])->name('aduanMhu.delete');
            Route::post('/aduanMhu/update', [AduanMhuController::class, 'update_aduan'])->name('aduanMhu.update');
            Route::get('/aduanMhu/{id}/detail', [AduanMhuController::class, 'detail'])->name('aduanMhu.detail');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:ADW,ict_ho:HO,ict_group_leader:ADW,ict_admin:ADW'], function () {
            Route::get('/aduanWara', [AduanWARAController::class, 'index'])->name('aduanWARA.page');
            Route::get('/aduanWara/create', [AduanWARAController::class, 'create'])->name('aduanWARA.create');
            Route::post('/aduanWara/create', [AduanWARAController::class, 'store'])->name('aduanWARA.store');
            Route::get('/aduanWara/{id}/edit', [AduanWARAController::class, 'edit'])->name('aduanWARA.edit');
            Route::post('/aduanWara/updateProgress', [AduanWARAController::class, 'update_aduan_progress'])->name('aduanWARA.updateProgress');
            Route::get('/aduanWara/{id}/progress', [AduanWARAController::class, 'progress'])->name('aduanWARA.progress');
            Route::delete('/aduanWara/{id}/delete', [AduanWARAController::class, 'destroy'])->name('aduanWARA.delete');
            Route::post('/aduanWara/update', [AduanWARAController::class, 'update_aduan'])->name('aduanWARA.update');
            Route::get('/aduanWara/{id}/detail', [AduanWARAController::class, 'detail'])->name('aduanWARA.detail');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:AMI,ict_ho:HO,ict_group_leader:AMI,ict_admin:AMI'], function () {
            Route::get('/aduanAmi', [AduanAmiController::class, 'index'])->name('aduanAmi.page');
            Route::get('/aduanAmi/create', [AduanAmiController::class, 'create'])->name('aduanAmi.create');
            Route::post('/aduanAmi/create', [AduanAmiController::class, 'store'])->name('aduanAmi.store');
            Route::get('/aduanAmi/{id}/edit', [AduanAmiController::class, 'edit'])->name('aduanAmi.edit');
            Route::post('/aduanAmi/updateProgress', [AduanAmiController::class, 'update_aduan_progress'])->name('aduanAmi.updateProgress');
            Route::get('/aduanAmi/{id}/progress', [AduanAmiController::class, 'progress'])->name('aduanAmi.progress');
            Route::delete('/aduanAmi/{id}/delete', [AduanAmiController::class, 'destroy'])->name('aduanAmi.delete');
            Route::post('/aduanAmi/update', [AduanAmiController::class, 'update_aduan'])->name('aduanAmi.update');
            Route::get('/aduanAmi/{id}/detail', [AduanAmiController::class, 'detail'])->name('aduanAmi.detail');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:BIB,ict_ho:HO,ict_group_leader:BIB,ict_admin:BIB'], function () {
            Route::get('/aduanBib', [AduanBibController::class, 'index'])->name('aduanBib.page');
            Route::get('/aduanBib/create', [AduanBibController::class, 'create'])->name('aduanBib.create');
            Route::post('/aduanBib/create', [AduanBibController::class, 'store'])->name('aduanBib.store');
            Route::get('/aduanBib/{id}/edit', [AduanBibController::class, 'edit'])->name('aduanBib.edit');
            Route::post('/aduanBib/updateProgress', [AduanBibController::class, 'update_aduan_progress'])->name('aduanBib.updateProgress');
            Route::get('/aduanBib/{id}/progress', [AduanBibController::class, 'progress'])->name('aduanBib.progress');
            Route::delete('/aduanBib/{id}/delete', [AduanBibController::class, 'destroy'])->name('aduanBib.delete');
            Route::post('/aduanBib/update', [AduanBibController::class, 'update_aduan'])->name('aduanBib.update');
            Route::get('/aduanBib/{id}/detail', [AduanBibController::class, 'detail'])->name('aduanBib.detail');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:IPT,ict_ho:HO,ict_group_leader:IPT,ict_admin:IPT'], function () {
            Route::get('/aduanIpt', [AduanIptController::class, 'index'])->name('aduanIpt.page');
            Route::get('/aduanIpt/create', [AduanIptController::class, 'create'])->name('aduanIpt.create');
            Route::post('/aduanIpt/create', [AduanIptController::class, 'store'])->name('aduanIpt.store');
            Route::get('/aduanIpt/{id}/edit', [AduanIptController::class, 'edit'])->name('aduanIpt.edit');
            Route::post('/aduanIpt/updateProgress', [AduanIptController::class, 'update_aduan_progress'])->name('aduanIpt.updateProgress');
            Route::get('/aduanIpt/{id}/progress', [AduanIptController::class, 'progress'])->name('aduanIpt.progress');
            Route::delete('/aduanIpt/{id}/delete', [AduanIptController::class, 'destroy'])->name('aduanIpt.delete');
            Route::post('/aduanIpt/update', [AduanIptController::class, 'update_aduan'])->name('aduanIpt.update');
            Route::get('/aduanIpt/{id}/detail', [AduanIptController::class, 'detail'])->name('aduanIpt.detail');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:MLP,ict_ho:HO,ict_group_leader:MLP,ict_admin:MLP'], function () {
            Route::get('/aduanMlp', [AduanMlpController::class, 'index'])->name('aduanMlp.page');
            Route::get('/aduanMlp/create', [AduanMlpController::class, 'create'])->name('aduanMlp.create');
            Route::post('/aduanMlp/create', [AduanMlpController::class, 'store'])->name('aduanMlp.store');
            Route::get('/aduanMlp/{id}/edit', [AduanMlpController::class, 'edit'])->name('aduanMlp.edit');
            Route::post('/aduanMlp/updateProgress', [AduanMlpController::class, 'update_aduan_progress'])->name('aduanMlp.updateProgress');
            Route::get('/aduanMlp/{id}/progress', [AduanMlpController::class, 'progress'])->name('aduanMlp.progress');
            Route::delete('/aduanMlp/{id}/delete', [AduanMlpController::class, 'destroy'])->name('aduanMlp.delete');
            Route::post('/aduanMlp/update', [AduanMlpController::class, 'update_aduan'])->name('aduanMlp.update');
            Route::get('/aduanMlp/{id}/detail', [AduanMlpController::class, 'detail'])->name('aduanMlp.detail');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:MIP,ict_ho:HO,ict_group_leader:MIP,ict_admin:MIP'], function () {
            Route::get('/aduanMip', [AduanMipController::class, 'index'])->name('aduanMip.page');
            Route::get('/aduanMip/create', [AduanMipController::class, 'create'])->name('aduanMip.create');
            Route::post('/aduanMip/create', [AduanMipController::class, 'store'])->name('aduanMip.store');
            Route::get('/aduanMip/{id}/edit', [AduanMipController::class, 'edit'])->name('aduanMip.edit');
            Route::post('/aduanMip/updateProgress', [AduanMipController::class, 'update_aduan_progress'])->name('aduanMip.updateProgress');
            Route::get('/aduanMip/{id}/progress', [AduanMipController::class, 'progress'])->name('aduanMip.progress');
            Route::delete('/aduanMip/{id}/delete', [AduanMipController::class, 'destroy'])->name('aduanMip.delete');
            Route::post('/aduanMip/update', [AduanMipController::class, 'update_aduan'])->name('aduanMip.update');
            Route::get('/aduanMip/{id}/detail', [AduanMipController::class, 'detail'])->name('aduanMip.detail');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:VIB,ict_ho:HO,ict_group_leader:VIB,ict_admin:VIB'], function () {
            Route::get('/aduanVale', [AduanValeController::class, 'index'])->name('aduanVale.page');
            Route::get('/aduanVale/create', [AduanValeController::class, 'create'])->name('aduanVale.create');
            Route::post('/aduanVale/create', [AduanValeController::class, 'store'])->name('aduanVale.store');
            Route::get('/aduanVale/{id}/edit', [AduanValeController::class, 'edit'])->name('aduanVale.edit');
            Route::post('/aduanVale/updateProgress', [AduanValeController::class, 'update_aduan_progress'])->name('aduanVale.updateProgress');
            Route::get('/aduanVale/{id}/progress', [AduanValeController::class, 'progress'])->name('aduanVale.progress');
            Route::delete('/aduanVale/{id}/delete', [AduanValeController::class, 'destroy'])->name('aduanVale.delete');
            Route::post('/aduanVale/update', [AduanValeController::class, 'update_aduan'])->name('aduanVale.update');
            Route::get('/aduanVale/{id}/detail', [AduanValeController::class, 'detail'])->name('aduanVale.detail');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:SBS,ict_ho:HO,ict_group_leader:SBS,ict_admin:SBS'], function () {
            Route::get('/aduanSbs', [AduanSbsController::class, 'index'])->name('aduanSbs.page');
            Route::get('/aduanSbs/create', [AduanSbsController::class, 'create'])->name('aduanSbs.create');
            Route::post('/aduanSbs/create', [AduanSbsController::class, 'store'])->name('aduanSbs.store');
            Route::get('/aduanSbs/{id}/edit', [AduanSbsController::class, 'edit'])->name('aduanSbs.edit');
            Route::post('/aduanSbs/updateProgress', [AduanSbsController::class, 'update_aduan_progress'])->name('aduanSbs.updateProgress');
            Route::get('/aduanSbs/{id}/progress', [AduanSbsController::class, 'progress'])->name('aduanSbs.progress');
            Route::delete('/aduanSbs/{id}/delete', [AduanSbsController::class, 'destroy'])->name('aduanSbs.delete');
            Route::post('/aduanSbs/update', [AduanSbsController::class, 'update_aduan'])->name('aduanSbs.update');
            Route::get('/aduanSbs/{id}/detail', [AduanSbsController::class, 'detail'])->name('aduanSbs.detail');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:SKS,ict_ho:HO,ict_group_leader:SKS,ict_admin:SKS'], function () {
            Route::get('/aduanSks', [AduanSksController::class, 'index'])->name('aduanSks.page');
            Route::get('/aduanSks/create', [AduanSksController::class, 'create'])->name('aduanSks.create');
            Route::post('/aduanSks/create', [AduanSksController::class, 'store'])->name('aduanSks.store');
            Route::get('/aduanSks/{id}/edit', [AduanSksController::class, 'edit'])->name('aduanSks.edit');
            Route::post('/aduanSks/updateProgress', [AduanSksController::class, 'update_aduan_progress'])->name('aduanSks.updateProgress');
            Route::get('/aduanSks/{id}/progress', [AduanSksController::class, 'progress'])->name('aduanSks.progress');
            Route::delete('/aduanSks/{id}/delete', [AduanSksController::class, 'destroy'])->name('aduanSks.delete');
            Route::post('/aduanSks/update', [AduanSksController::class, 'update_aduan'])->name('aduanSks.update');
            Route::get('/aduanSks/{id}/detail', [AduanSksController::class, 'detail'])->name('aduanSks.detail');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:PIK,ict_ho:HO,ict_group_leader:PIK,ict_admin:PIK'], function () {
            Route::get('/aduanPik', [AduanPikController::class, 'index'])->name('aduanPik.page');
            Route::get('/aduanPik/create', [AduanPikController::class, 'create'])->name('aduanPik.create');
            Route::post('/aduanPik/create', [AduanPikController::class, 'store'])->name('aduanPik.store');
            Route::get('/aduanPik/{id}/edit', [AduanPikController::class, 'edit'])->name('aduanPik.edit');
            Route::post('/aduanPik/updateProgress', [AduanPikController::class, 'update_aduan_progress'])->name('aduanPik.updateProgress');
            Route::get('/aduanPik/{id}/progress', [AduanPikController::class, 'progress'])->name('aduanPik.progress');
            Route::delete('/aduanPik/{id}/delete', [AduanPikController::class, 'destroy'])->name('aduanPik.delete');
            Route::post('/aduanPik/update', [AduanPikController::class, 'update_aduan'])->name('aduanPik.update');
            Route::get('/aduanPik/{id}/detail', [AduanPikController::class, 'detail'])->name('aduanPik.detail');
        });

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_ho:HO,ict_group_leader:BGE'], function () {
            Route::get('/aduanBge', [AduanBgeController::class, 'index'])->name('aduanBge.page');
            Route::get('/aduanBge/create', [AduanBgeController::class, 'create'])->name('aduanBge.create');
            Route::post('/aduanBge/create', [AduanBgeController::class, 'store'])->name('aduanBge.store');
            Route::get('/aduanBge/{id}/edit', [AduanBgeController::class, 'edit'])->name('aduanBge.edit');
            Route::post('/aduanBge/updateProgress', [AduanBgeController::class, 'update_aduan_progress'])->name('aduanBge.updateProgress');
            Route::get('/aduanBge/{id}/progress', [AduanBgeController::class, 'progress'])->name('aduanBge.progress');
            Route::delete('/aduanBge/{id}/delete', [AduanBgeController::class, 'destroy'])->name('aduanBge.delete');
            Route::post('/aduanBge/update', [AduanBgeController::class, 'update_aduan'])->name('aduanBge.update');
            Route::get('/aduanBge/{id}/detail', [AduanBgeController::class, 'detail'])->name('aduanBge.detail');
        });

        Route::prefix('/recycleBin')->group(function () {
            Route::group(['middleware' => 'checkRole:ict_developer:BIB'], function () {
                Route::get('/aduanRcBin', [AduanRcbinController::class, 'index'])->name('aduanRcBin.page');
                Route::patch('/aduanRcBin/{id}/restore', [AduanRcbinController::class, 'restore'])->name('aduanRcBin.restore');
                Route::delete('/aduanRcBin/{id}/delete', [AduanRcbinController::class, 'destroy'])->name('aduanRcBin.delete');
                Route::delete('/aduanRcbBin/{id}/force-delete', [AduanRcbinController::class, 'forceDelete'])->name('aduanRcBin.forceDelete');
                Route::get('/aduanRcBin/{id}/detail', [AduanRcbinController::class, 'detail'])->name('aduanRcBin.detail');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB'], function () {
                Route::get('/invApRcBin', [InvApRcbinController::class, 'index'])->name('accessPointRcBin.page');
                Route::patch('/invApRcBin/{id}/restore', [InvApRcbinController::class, 'restore'])->name('accessPointRcBin.restore');
                Route::delete('/invApRcBin/{id}/delete', [InvApRcbinController::class, 'destroy'])->name('accessPointRcBin.delete');
                Route::delete('/invApRcbBin/{id}/force-delete', [InvApRcbinController::class, 'forceDelete'])->name('accessPointRcBin.forceDelete');
                Route::get('/invApRcBin/{id}/detail', [InvApRcbinController::class, 'detail'])->name('accessPointRcBin.detail');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB'], function () {
                Route::get('/invSwitchRcBin', [InvSwitchRcbinController::class, 'index'])->name('switchRcBin.page');
                Route::patch('/invSwitchRcBin/{id}/restore', [InvSwitchRcbinController::class, 'restore'])->name('switchRcBin.restore');
                Route::delete('/invSwitchRcBin/{id}/delete', [InvSwitchRcbinController::class, 'destroy'])->name('switchRcBin.delete');
                Route::delete('/invSwitchRcbBin/{id}/force-delete', [InvSwitchRcbinController::class, 'forceDelete'])->name('switchRcBin.forceDelete');
                Route::get('/invSwitchRcBin/{id}/detail', [InvSwitchRcbinController::class, 'detail'])->name('switchRcBin.detail');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB'], function () {
                Route::get('/invWirellessRcBin', [InvWirellessRcbinController::class, 'index'])->name('wirellessRcBin.page');
                Route::patch('/invWirellessRcBin/{id}/restore', [InvWirellessRcbinController::class, 'restore'])->name('wirellessRcBin.restore');
                Route::delete('/invWirellessRcBin/{id}/delete', [InvWirellessRcbinController::class, 'destroy'])->name('wirellessRcBin.delete');
                Route::delete('/invWirellessRcbBin/{id}/force-delete', [InvWirellessRcbinController::class, 'forceDelete'])->name('wirellessRcBin.forceDelete');
                Route::get('/invWirellessRcBin/{id}/detail', [InvWirellessRcbinController::class, 'detail'])->name('wirellessRcBin.detail');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB'], function () {
                Route::get('/invLaptopRcBin', [InvLaptopRcBinController::class, 'index'])->name('laptopRcBin.page');
                Route::patch('/invLaptopRcBin/{id}/restore', [InvLaptopRcBinController::class, 'restore'])->name('laptopRcBin.restore');
                Route::delete('/invLaptopRcBin/{id}/delete', [InvLaptopRcBinController::class, 'destroy'])->name('laptopRcBin.delete');
                Route::delete('/invLaptopRcbBin/{id}/force-delete', [InvLaptopRcBinController::class, 'forceDelete'])->name('laptopRcBin.forceDelete');
                Route::get('/invLaptopRcBin/{id}/detail', [InvLaptopRcBinController::class, 'detail'])->name('laptopRcBin.detail');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB'], function () {
                Route::get('/invComputerRcBin', [InvComputerRcBinController::class, 'index'])->name('komputerRcBin.page');
                Route::patch('/invComputerRcBin/{id}/restore', [InvComputerRcBinController::class, 'restore'])->name('komputerRcBin.restore');
                Route::delete('/invComputerRcBin/{id}/delete', [InvComputerRcBinController::class, 'destroy'])->name('komputerRcBin.delete');
                Route::delete('/invComputerRcbBin/{id}/force-delete', [InvComputerRcBinController::class, 'forceDelete'])->name('komputerRcBin.forceDelete');
                Route::get('/invComputerRcBin/{id}/detail', [InvComputerRcBinController::class, 'detail'])->name('komputerRcBin.detail');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB'], function () {
                Route::get('/invPrinterRcBin', [InvPrinterRcBinController::class, 'index'])->name('printerRcBin.page');
                Route::patch('/invPrinterRcBin/{id}/restore', [InvPrinterRcBinController::class, 'restore'])->name('printerRcBin.restore');
                Route::delete('/invPrinterRcBin/{id}/delete', [InvPrinterRcBinController::class, 'destroy'])->name('printerRcBin.delete');
                Route::delete('/invPrinterRcbBin/{id}/force-delete', [InvPrinterRcBinController::class, 'forceDelete'])->name('printerRcBin.forceDelete');
                Route::get('/invPrinterRcBin/{id}/detail', [InvPrinterRcBinController::class, 'detail'])->name('printerRcBin.detail');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB'], function () {
                Route::get('/invScannerRcBin', [InvScannerRcBinController::class, 'index'])->name('scannerRcBin.page');
                Route::patch('/invScannerRcBin/{id}/restore', [InvScannerRcBinController::class, 'restore'])->name('scannerRcBin.restore');
                Route::delete('/invScannerRcBin/{id}/delete', [InvScannerRcBinController::class, 'destroy'])->name('scannerRcBin.delete');
                Route::delete('/invScannerRcbBin/{id}/force-delete', [InvScannerRcBinController::class, 'forceDelete'])->name('scannerRcBin.forceDelete');
                Route::get('/invScannerRcBin/{id}/detail', [InvScannerRcBinController::class, 'detail'])->name('scannerRcBin.detail');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB'], function () {
                Route::get('/invCctvRcBin', [InvCctvRcBinController::class, 'index'])->name('cctvRcBin.page');
                Route::patch('/invCctvRcBin/{id}/restore', [InvCctvRcBinController::class, 'restore'])->name('cctvRcBin.restore');
                Route::delete('/invCctvRcBin/{id}/delete', [InvCctvRcBinController::class, 'destroy'])->name('cctvRcBin.delete');
                Route::delete('/invCctvRcbBin/{id}/force-delete', [InvCctvRcBinController::class, 'forceDelete'])->name('cctvRcBin.forceDelete');
                Route::get('/invCctvRcBin/{id}/detail', [InvCctvRcBinController::class, 'detail'])->name('cctvRcBin.detail');
            });

            Route::group(['middleware' => 'checkRole:ict_developer:BIB'], function () {
                Route::get('/penggunaRcBin', [UserAllRcBinController::class, 'index'])->name('penggunaRcBin.page');
                Route::patch('/penggunaRcBin/{id}/restore', [UserAllRcBinController::class, 'restore'])->name('penggunaRcBin.restore');
                Route::delete('/penggunaRcBin/{id}/delete', [UserAllRcBinController::class, 'destroy'])->name('penggunaRcBin.delete');
                Route::delete('/penggunaRcbBin/{id}/force-delete', [UserAllRcBinController::class, 'forceDelete'])->name('penggunaRcBin.forceDelete');
                Route::get('/penggunaRcBin/{id}/detail', [UserAllRcBinController::class, 'detail'])->name('penggunaRcBin.detail');
            });
        });
    });
});
Route::get('/redirectAuthenticatedUsers', [RedirectAuthenticatedUsersController::class, 'home'])->name('home');
Route::get('login-bge', [AuthController::class, 'index'])->name('auth.bge');
Route::post('login-handling', [TestingAuthApiController::class, 'index'])->name('auth.loginHandling');

require __DIR__ . '/auth.php';
