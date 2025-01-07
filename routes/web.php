<?php

use App\Http\Controllers\AdminPengajuanRoleBaController;
use App\Http\Controllers\AdminPengajuanRoleController;
use App\Http\Controllers\AdminPengajuanRoleMifaController;
use App\Http\Controllers\AduanBaController;
use App\Http\Controllers\AduanController;
use App\Http\Controllers\AduanHoController;
use App\Http\Controllers\AduanMhuController;
use App\Http\Controllers\AduanMifaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;
use App\Http\Controllers\DepartmentBaController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentMifaController;
use App\Http\Controllers\GuestAllController;
use App\Http\Controllers\GuestReportController;
use App\Http\Controllers\InspeksiComputerBaController;
use App\Http\Controllers\InspeksiComputerController;
use App\Http\Controllers\InspeksiComputerMhuController;
use App\Http\Controllers\InspeksiComputerMifaController;
use App\Http\Controllers\InspeksiLaptopBaController;
use App\Http\Controllers\InspeksiLaptopController;
use App\Http\Controllers\InspeksiLaptopMhuController;
use App\Http\Controllers\InspeksiLaptopMifaController;
use App\Http\Controllers\InvApBaController;
use App\Http\Controllers\InvApController;
use App\Http\Controllers\InvApMhuController;
use App\Http\Controllers\InvApMifaController;
use App\Http\Controllers\InvCctvBaController;
use App\Http\Controllers\InvCctvController;
use App\Http\Controllers\InvCctvMhuController;
use App\Http\Controllers\InvCctvMifaController;
use App\Http\Controllers\InvComputerBaController;
use App\Http\Controllers\InvComputerController;
use App\Http\Controllers\InvComputerMhuController;
use App\Http\Controllers\InvComputerMifaController;
use App\Http\Controllers\InvLaptopBaController;
use App\Http\Controllers\InvLaptopController;
use App\Http\Controllers\InvLaptopMhuController;
use App\Http\Controllers\InvLaptopMifaController;
use App\Http\Controllers\InvLaptopReUtilizeController;
use App\Http\Controllers\InvPrinterBaController;
use App\Http\Controllers\InvPrinterController;
use App\Http\Controllers\InvPrinterMhuController;
use App\Http\Controllers\InvPrinterMifaController;
use App\Http\Controllers\InvScannerBaController;
use App\Http\Controllers\InvScannerController;
use App\Http\Controllers\InvScannerMhuController;
use App\Http\Controllers\InvScannerMifaController;
use App\Http\Controllers\InvSwitchController;
use App\Http\Controllers\InvSwitchBaController;
use App\Http\Controllers\InvSwitchMhuController;
use App\Http\Controllers\InvSwitchMifaController;
use App\Http\Controllers\InvWirellessBaController;
use App\Http\Controllers\InvWirellessController;
use App\Http\Controllers\InvWirellessMhuController;
use App\Http\Controllers\InvWirellessMifaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestingAuthApiController;
use App\Http\Controllers\UserAllBaController;
use App\Http\Controllers\UserAllController;
use App\Http\Controllers\UserAllMhuController;
use App\Http\Controllers\UserAllMifaController;
use App\Models\Aduan;
use App\Models\InvAp;
use App\Models\InvCctv;
use App\Models\InvComputer;
use App\Models\InvLaptop;
use App\Models\InvPrinter;
use App\Models\InvSwitch;
use App\Models\InvWirelless;
use App\Models\UserAll;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Foundation\Application;


Route::middleware('auth')->group(function () {

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

    Route::group(['middleware' => 'checkRole:ict_group_leader:BIB'], function () {
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

    Route::group(['middleware' => 'checkRole:guest'], function () {
        Route::get('/asetDashboard', [GuestAllController::class, 'index'])->name('asetDashboard');
        Route::get('/asetDashboard/pengajuanAkses', [GuestAllController::class, 'pengajuanAkses'])->name('pengajuanAkses');
    });

    Route::group(['middleware' => 'checkRole:guest:BIB,guest:BA,guest:HO,guest:MIFA'], function () {
        Route::get('/complaint/dashboard', [GuestReportController::class, 'index'])->name('guestAduan.page');
        Route::get('/complaint', [GuestReportController::class, 'create'])->name('guestAduan.create');
        Route::post('/complaint-store', [GuestReportController::class, 'store'])->name('guestAduan.store');
        Route::delete('/complaint/{id}/delete', [GuestReportController::class, 'destroy'])->name('guestAduan.delete');
    });

    Route::group(['middleware' => 'checkRole:ict_technician:BIB'], function () {
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

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_bo:HO,ict_ho:HO,soc_ho:HO'], function () {
            Route::get('/accessPoint', [InvApController::class, 'index'])->name('accessPoint.page');
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
            Route::get('/switch/{swId}/edit', [InvSwitchController::class, 'edit'])->name('switch.edit');
            Route::put('/switch/{swId}/update', [InvSwitchController::class, 'update'])->name('switch.update');
            Route::delete('/switch/{swId}/delete', [InvSwitchController::class, 'destroy'])->name('switch.delete');
            Route::get('/switch/{id}/detail', [InvSwitchController::class, 'detail'])->name('switch.detail');
            Route::post('/uploadCsvSw', [InvSwitchController::class, 'uploadCsv'])->name('switch.import');

            Route::get('/wirelless', [InvWirellessController::class, 'index'])->name('wirelless.page');
            Route::get('/wirelless/create', [InvWirellessController::class, 'create'])->name('wirelless.create');
            Route::post('/wirelless/create', [InvWirellessController::class, 'store'])->name('wirelless.store');
            Route::get('/wirelless/{id}/edit', [InvWirellessController::class, 'edit'])->name('wirelless.edit');
            Route::put('/wirelless/{id}/update', [InvWirellessController::class, 'update'])->name('wirelless.update');
            Route::delete('/wirelless/{id}/delete', [InvWirellessController::class, 'destroy'])->name('wirelless.delete');
            Route::get('/wirelless/{id}/detail', [InvWirellessController::class, 'detail'])->name('wirelless.detail');
            Route::post('/uploadCsvBb', [InvWirellessController::class, 'uploadCsv'])->name('wirelless.import');

            Route::get('/laptop', [InvLaptopController::class, 'index'])->name('laptop.page');
            Route::get('/laptop/create', [InvLaptopController::class, 'create'])->name('laptop.create');
            Route::post('/laptop/create', [InvLaptopController::class, 'store'])->name('laptop.store');
            Route::get('/laptop/{id}/edit', [InvLaptopController::class, 'edit'])->name('laptop.edit');
            Route::delete('/laptop/{id}/delete', [InvLaptopController::class, 'destroy'])->name('laptop.delete');
            Route::post('/laptop/update', [InvLaptopController::class, 'update'])->name('laptop.update');
            Route::get('/laptop/{id}/detail', [InvLaptopController::class, 'detail'])->name('laptop.detail');
            Route::post('/uploadCsvNb', [InvLaptopController::class, 'uploadCsv'])->name('laptop.import');

            Route::get('/komputer', [InvComputerController::class, 'index'])->name('komputer.page');
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

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:BA,ict_ho:HO'], function () {
            Route::get('/accessPointSiteBa', [InvApBaController::class, 'index'])->name('accessPointBa.page');
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
            Route::get('/switchBa/{swId}/edit', [InvSwitchBaController::class, 'edit'])->name('switchBa.edit');
            Route::put('/switchBa/{swId}/update', [InvSwitchBaController::class, 'update'])->name('switchBa.update');
            Route::delete('/switchBa/{swId}/delete', [InvSwitchBaController::class, 'destroy'])->name('switchBa.delete');
            Route::get('/switchBa/{id}/detail', [InvSwitchBaController::class, 'detail'])->name('switchBa.detail');
            Route::post('/uploadCsvSwBa', [InvSwitchBaController::class, 'uploadCsv'])->name('switchBa.import');

            Route::get('/wirellessBa', [InvWirellessBaController::class, 'index'])->name('wirellessBa.page');
            Route::get('/wirellessBa/create', [InvWirellessBaController::class, 'create'])->name('wirellessBa.create');
            Route::post('/wirellessBa/create', [InvWirellessBaController::class, 'store'])->name('wirellessBa.store');
            Route::get('/wirellessBa/{id}/edit', [InvWirellessBaController::class, 'edit'])->name('wirellessBa.edit');
            Route::put('/wirellessBa/{id}/update', [InvWirellessBaController::class, 'update'])->name('wirellessBa.update');
            Route::delete('/wirellessBa/{id}/delete', [InvWirellessBaController::class, 'destroy'])->name('wirellessBa.delete');
            Route::get('/wirellessBa/{id}/detail', [InvWirellessBaController::class, 'detail'])->name('wirellessBa.detail');
            Route::post('/uploadCsvBbBa', [InvWirellessBaController::class, 'uploadCsv'])->name('wirellessBa.import');

            Route::get('/laptopBa', [InvLaptopBaController::class, 'index'])->name('laptopBa.page');
            Route::get('/laptopBa/create', [InvLaptopBaController::class, 'create'])->name('laptopBa.create');
            Route::post('/laptopBa/create', [InvLaptopBaController::class, 'store'])->name('laptopBa.store');
            Route::get('/laptopBa/{id}/edit', [InvLaptopBaController::class, 'edit'])->name('laptopBa.edit');
            Route::delete('/laptopBa/{id}/delete', [InvLaptopBaController::class, 'destroy'])->name('laptopBa.delete');
            Route::post('/laptopBa/update', [InvLaptopBaController::class, 'update'])->name('laptopBa.update');
            Route::get('/laptopBa/{id}/detail', [InvLaptopBaController::class, 'detail'])->name('laptopBa.detail');
            Route::post('/uploadCsvNbBa', [InvLaptopBaController::class, 'uploadCsv'])->name('laptopBa.import');

            Route::get('/komputerBa', [InvComputerBaController::class, 'index'])->name('komputerBa.page');
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

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:MIFA,ict_group_leader:MIFA,ict_ho:HO'], function () {
            Route::get('/accessPointSiteMifa', [InvApMifaController::class, 'index'])->name('accessPointMifa.page');
            Route::get('/accessPointSiteMifa/create', [InvApMifaController::class, 'create'])->name('accessPointMifa.create');
            Route::post('/accessPointSiteMifa/create', [InvApMifaController::class, 'store'])->name('accessPointMifa.store');
            Route::get('/accessPointSiteMifa/{apId}/edit', [InvApMifaController::class, 'edit'])->name('accessPointMifa.edit');
            Route::put('/accessPointSiteMifa/{apId}/update', [InvApMifaController::class, 'update'])->name('accessPointMifa.update');
            Route::delete('/accessPointSiteMifa/{apId}/delete', [InvApMifaController::class, 'destroy'])->name('accessPointMifa.delete');
            Route::get('/accessPointSiteMifa/{id}/detail', [InvApMifaController::class, 'detail'])->name('accessPointMifa.detail');
            Route::post('/uploadCsvApMifa', [InvApMifaController::class, 'uploadCsv'])->name('accessPointMifa.import');

            Route::get('/switchMifa', [InvSwitchMifaController::class, 'index'])->name('switchMifa.page');
            Route::get('/switchMifa/create', [InvSwitchMifaController::class, 'create'])->name('switchMifa.create');
            Route::post('/switchMifa/create', [InvSwitchMifaController::class, 'store'])->name('switchMifa.store');
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
            Route::get('/laptopMifa/create', [InvLaptopMifaController::class, 'create'])->name('laptopMifa.create');
            Route::post('/laptopMifa/create', [InvLaptopMifaController::class, 'store'])->name('laptopMifa.store');
            Route::get('/laptopMifa/{id}/edit', [InvLaptopMifaController::class, 'edit'])->name('laptopMifa.edit');
            Route::delete('/laptopMifa/{id}/delete', [InvLaptopMifaController::class, 'destroy'])->name('laptopMifa.delete');
            Route::post('/laptopMifa/update', [InvLaptopMifaController::class, 'update'])->name('laptopMifa.update');
            Route::get('/laptopMifa/{id}/detail', [InvLaptopMifaController::class, 'detail'])->name('laptopMifa.detail');
            Route::post('/uploadCsvNbMifa', [InvLaptopMifaController::class, 'uploadCsv'])->name('laptopMifa.import');

            Route::get('/komputerMifa', [InvComputerMifaController::class, 'index'])->name('komputerMifa.page');
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

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:MHU,ict_ho:HO'], function () {
            Route::get('/accessPointSiteMHU', [InvApMhuController::class, 'index'])->name('accessPointMhu.page');
            Route::get('/accessPointSiteMHU/create', [InvApMhuController::class, 'create'])->name('accessPointMhu.create');
            Route::post('/accessPointSiteMHU/create', [InvApMhuController::class, 'store'])->name('accessPointMhu.store');
            Route::get('/accessPointSiteMHU/{apId}/edit', [InvApMhuController::class, 'edit'])->name('accessPointMhu.edit');
            Route::put('/accessPointSiteMHU/{apId}/update', [InvApMhuController::class, 'update'])->name('accessPointMhu.update');
            Route::delete('/accessPointSiteMHU/{apId}/delete', [InvApMhuController::class, 'destroy'])->name('accessPointMhu.delete');
            Route::get('/accessPointSiteMHU/{id}/detail', [InvApMhuController::class, 'detail'])->name('accessPointMhu.detail');
            Route::post('/uploadCsvApMHU', [InvApMhuController::class, 'uploadCsv'])->name('accessPointMhu.import');

            Route::get('/switchMhu', [InvSwitchMhuController::class, 'index'])->name('switchMhu.page');
            Route::get('/switchMhu/create', [InvSwitchMhuController::class, 'create'])->name('switchMhu.create');
            Route::post('/switchMhu/create', [InvSwitchMhuController::class, 'store'])->name('switchMhu.store');
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
            Route::get('/laptopMhu/create', [InvLaptopMhuController::class, 'create'])->name('laptopMhu.create');
            Route::post('/laptopMhu/create', [InvLaptopMhuController::class, 'store'])->name('laptopMhu.store');
            Route::get('/laptopMhu/{id}/edit', [InvLaptopMhuController::class, 'edit'])->name('laptopMhu.edit');
            Route::delete('/laptopMhu/{id}/delete', [InvLaptopMhuController::class, 'destroy'])->name('laptopMhu.delete');
            Route::post('/laptopMhu/update', [InvLaptopMhuController::class, 'update'])->name('laptopMhu.update');
            Route::get('/laptopMhu/{id}/detail', [InvLaptopMhuController::class, 'detail'])->name('laptopMhu.detail');
            Route::post('/uploadCsvNbMhu', [InvLaptopMhuController::class, 'uploadCsv'])->name('laptopMhu.import');

            Route::get('/komputerMhu', [InvComputerMhuController::class, 'index'])->name('komputerMhu.page');
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

        Route::prefix('itportal')->group(function () {
            Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_ho:HO,ict_bod:HO,soc_ho:HO'], function () {
                Route::get('/pengguna', [UserAllController::class, 'index'])->name('pengguna.page');
                Route::get('/pengguna/create', [UserAllController::class, 'create'])->name('pengguna.create');
                Route::post('/pengguna/create', [UserAllController::class, 'store'])->name('pengguna.store');
                Route::get('/pengguna/{id}/edit', [UserAllController::class, 'edit'])->name('pengguna.edit');
                Route::put('/pengguna/{id}/update', [UserAllController::class, 'update'])->name('pengguna.update');
                Route::delete('/pengguna/{id}/delete', [UserAllController::class, 'destroy'])->name('pengguna.delete');
                Route::post('/uploadCsvPengguna', [UserAllController::class, 'uploadCsv'])->name('pengguna.import');

                Route::get('department', [DepartmentController::class, 'index'])->name('department.page');
                Route::get('department/create', [DepartmentController::class, 'create'])->name('department.create');
                Route::post('department/create', [DepartmentController::class, 'store'])->name('department.store');
                Route::get('department/{id}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
                Route::put('department/{id}/update', [DepartmentController::class, 'update'])->name('department.update');
                Route::delete('department/{id}/delete', [DepartmentController::class, 'destroy'])->name('department.delete');

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

            Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:BA'], function () {
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

            Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:MIFA,ict_group_leader:MIFA'], function () {
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

            Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:MHU'], function () {
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

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:BA,ict_ho:HO'], function () {
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

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:MIFA,ict_group_leader:MIFA,ict_ho:HO'], function () {
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

        Route::group(['middleware' => 'checkRole:ict_developer:BIB,ict_technician:MHU,ict_ho:HO'], function () {
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

        Route::group(['middleware' => 'checkRole:ict_technician:BA'], function () {
            Route::post('/aduanBa/updateProgress', [AduanBaController::class, 'update_aduan_progress'])->name('aduanBa.updateProgress');
            Route::get('/aduanBa/{id}/progress', [AduanBaController::class, 'progress'])->name('aduanBa.progress');
        });
    });
});
Route::get('/redirectAuthenticatedUsers', [RedirectAuthenticatedUsersController::class, 'home'])->name('home');
Route::post('login-handling', [TestingAuthApiController::class, 'index'])->name('auth.loginHandling');

require __DIR__ . '/auth.php';
