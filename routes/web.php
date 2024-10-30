<?php

use App\Http\Controllers\AduanController;
use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\InvApController;
use App\Http\Controllers\InvCctvController;
use App\Http\Controllers\InvComputerController;
use App\Http\Controllers\InvLaptopController;
use App\Http\Controllers\InvLaptopReUtilizeController;
use App\Http\Controllers\InvPrinterController;
use App\Http\Controllers\InvSwitchController;
use App\Http\Controllers\InvWirellessController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserAllController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Foundation\Application;

Route::middleware('auth')->group(function () {

    // Route::get('/redirectAuthenticatedUsers', [RedirectAuthenticatedUsersController::class, 'home']);

    Route::group(['middleware' => 'checkRole:ict_developer,ict_ho,ict_bod,ict_section_head'], function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Inventory/Dashboard');
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
        Route::post('/uploadCsvAp', [InvApController::class, 'uploadCsv'])->name('accessPoint.import');

        Route::get('/switch', [InvSwitchController::class, 'index'])->name('switch.page');
        Route::get('/switch/create', [InvSwitchController::class, 'create'])->name('switch.create');
        Route::post('/switch/create', [InvSwitchController::class, 'store'])->name('switch.store');
        Route::get('/switch/{swId}/edit', [InvSwitchController::class, 'edit'])->name('switch.edit');
        Route::put('/switch/{swId}/update', [InvSwitchController::class, 'update'])->name('switch.update');
        Route::delete('/switch/{swId}/delete', [InvSwitchController::class, 'destroy'])->name('switch.delete');
        Route::post('/uploadCsvSw', [InvSwitchController::class, 'uploadCsv'])->name('switch.import');

        Route::get('/wirelless', [InvWirellessController::class, 'index'])->name('wirelless.page');
        Route::get('/wirelless/create', [InvWirellessController::class, 'create'])->name('wirelless.create');
        Route::post('/wirelless/create', [InvWirellessController::class, 'store'])->name('wirelless.store');
        Route::get('/wirelless/{id}/edit', [InvWirellessController::class, 'edit'])->name('wirelless.edit');
        Route::put('/wirelless/{id}/update', [InvWirellessController::class, 'update'])->name('wirelless.update');
        Route::delete('/wirelless/{id}/delete', [InvWirellessController::class, 'destroy'])->name('wirelless.delete');
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

        Route::get('/printer', [InvPrinterController::class, 'index'])->name('printer.page');
        Route::get('/printer/create', [InvPrinterController::class, 'create'])->name('printer.create');
        Route::post('/printer/create', [InvPrinterController::class, 'store'])->name('printer.store');
        Route::get('/printer/{id}/edit', [InvPrinterController::class, 'edit'])->name('printer.edit');
        Route::delete('/printer/{id}/delete', [InvPrinterController::class, 'destroy'])->name('printer.delete');
        Route::post('/printer/update', [InvPrinterController::class, 'update'])->name('printer.update');
        Route::get('/printer/{id}/detail', [InvPrinterController::class, 'detail'])->name('printer.detail');
        Route::post('/uploadCsvPrt', [InvPrinterController::class, 'uploadCsv'])->name('printer.import');

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

        Route::get('department', [DepartmentController::class, 'index'])->name('department.page');
        Route::get('department/create', [DepartmentController::class, 'create'])->name('department.create');
        Route::post('department/create', [DepartmentController::class, 'store'])->name('department.store');
        Route::get('department/{id}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
        Route::put('department/{id}/update', [DepartmentController::class, 'update'])->name('department.update');
        Route::delete('department/{id}/delete', [DepartmentController::class, 'destroy'])->name('department.delete');
    });
});
Route::get('/redirectAuthenticatedUsers', [RedirectAuthenticatedUsersController::class, 'home'])->name('home');

require __DIR__ . '/auth.php';
