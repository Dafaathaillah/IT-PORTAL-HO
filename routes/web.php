<?php

use App\Http\Controllers\AduanController;
use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GuestReportController;
use App\Http\Controllers\InspeksiComputerController;
use App\Http\Controllers\InspeksiLaptopController;
use App\Http\Controllers\InvApController;
use App\Http\Controllers\InvCctvController;
use App\Http\Controllers\InvComputerController;
use App\Http\Controllers\InvLaptopController;
use App\Http\Controllers\InvLaptopReUtilizeController;
use App\Http\Controllers\InvPrinterController;
use App\Http\Controllers\InvScannerController;
use App\Http\Controllers\InvSwitchController;
use App\Http\Controllers\InvWirellessController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserAllController;
use App\Models\Aduan;
use App\Models\InvAp;
use App\Models\InvCctv;
use App\Models\InvComputer;
use App\Models\InvLaptop;
use App\Models\InvPrinter;
use App\Models\InvSwitch;
use App\Models\InvWirelless;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Foundation\Application;


Route::get('/complaint/dashboard', [GuestReportController::class, 'index'])->name('guestAduan.page');
Route::get('/complaint', [GuestReportController::class, 'create'])->name('guestAduan.create');
Route::post('/complaint', [GuestReportController::class, 'store'])->name('guestAduan.store');
Route::delete('/complaint/{id}/delete', [GuestReportController::class, 'destroy'])->name('guestAduan.delete');

Route::middleware('auth')->group(function () {

    // Route::get('/redirectAuthenticatedUsers', [RedirectAuthenticatedUsersController::class, 'home']);

    Route::group(['middleware' => 'checkRole:ict_developer,ict_ho,ict_bod,ict_section_head'], function () {
        Route::get('/dashboard', function () {

            $aduan = Aduan::orderBy('date_of_complaint', 'desc')->get();
            $countOpen = Aduan::where('status', 'OPEN')->count();
            $countClosed = Aduan::where('status', 'CLOSED')->count();
            $countProgress = Aduan::where('status', 'PROGRESS')->count();
            $countCancel = Aduan::where('status', 'CANCEL')->count();

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
                ]
            );
        })->name('developerDashboard');
    });

    // Route::group(['middleware' => 'checkRole:ict_section'], function () {
    //     Route::get('/sectionDashboard', function () {
    //         return Inertia::render('Inventory/DashboardSection');
    //     })->name('sectionDashboard');
    // });

    Route::group(['middleware' => 'checkRole:ict_group_leader'], function () {
        Route::get('/groupLeaderDashboard', function () {
            return Inertia::render('Inventory/DashboardGroupLeader');
        })->name('groupLeaderDashboard');
    });

    Route::group(['middleware' => 'checkRole:ict_technician'], function () {
        Route::get('/technicianDashboard', function () {
            return Inertia::render('Inventory/DashboardTechnician');
        })->name('technicianDashboard');
    });

    Route::prefix('inventory')->group(function () {
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

    Route::prefix('itportal')->group(function () {
        Route::get('/aduan', [AduanController::class, 'index'])->name('aduan.page');
        Route::get('/aduan/create', [AduanController::class, 'create'])->name('aduan.create');
        Route::post('/aduan/create', [AduanController::class, 'store'])->name('aduan.store');
        Route::post('/aduan/updateProgress', [AduanController::class, 'update_aduan_progress'])->name('aduan.updateProgress');
        Route::get('/aduan/{id}/edit', [AduanController::class, 'edit'])->name('aduan.edit');
        Route::get('/aduan/{id}/progress', [AduanController::class, 'progress'])->name('aduan.progress');
        Route::delete('/aduan/{id}/delete', [AduanController::class, 'destroy'])->name('aduan.delete');
        Route::post('/aduan/update', [AduanController::class, 'update_aduan'])->name('aduan.update');
        Route::get('/aduan/{id}/detail', [AduanController::class, 'detail'])->name('aduan.detail');

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
        
        Route::get('inspeksi-komputer', [InspeksiComputerController::class, 'index'])->name('inspeksiKomputer.page');
        Route::get('inspeksi-komputer/{id}/inspection', [InspeksiComputerController::class, 'doInspection'])->name('inspeksiKomputer.inspection');
        Route::post('inspeksi-komputer/inspection', [InspeksiComputerController::class, 'store'])->name('inspeksiKomputer.store');
        Route::get('inspeksi-komputer/{id}/edit', [InspeksiComputerController::class, 'edit'])->name('inspeksiKomputer.edit');
        Route::put('inspeksi-komputer/{id}/update', [InspeksiComputerController::class, 'update'])->name('inspeksiKomputer.update');
        Route::delete('inspeksi-komputer/{id}/delete', [InspeksiComputerController::class, 'destroy'])->name('inspeksiKomputer.delete');

        Route::get('inspeksi-laptop', [InspeksiLaptopController::class, 'index'])->name('inspeksiLaptop.page');
        Route::get('inspeksi-laptop/{id}/process', [InspeksiLaptopController::class, 'process'])->name('inspeksiLaptop.process');
        Route::post('inspeksi-laptop/process', [InspeksiLaptopController::class, 'store'])->name('inspeksiLaptop.store');
        Route::get('inspeksi-laptop/{id}/edit', [InspeksiLaptopController::class, 'edit'])->name('inspeksiLaptop.edit');
        Route::post('inspeksi-laptop/update', [InspeksiLaptopController::class, 'update'])->name('inspeksiLaptop.update');
        Route::get('/inspeksi-laptop/{id}/detail', [InspeksiLaptopController::class, 'detail'])->name('inspeksiLaptop.detail');
        Route::delete('inspeksi-laptop/{id}/delete', [InspeksiLaptopController::class, 'destroy'])->name('inspeksiLaptop.delete');
    });
});
Route::get('/redirectAuthenticatedUsers', [RedirectAuthenticatedUsersController::class, 'home'])->name('home');

require __DIR__ . '/auth.php';
