<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrahariController;
use App\Http\Controllers\CasesController;
use App\Http\Controllers\ChallanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('loginCode', [AuthController::class, 'loginCode'])->name('loginCode');

Route::group(['prefix' => 'account', 'middleware' => 'auth'], function() {
    Route::get('dashboard',[DashboardController::class, 'dashboardAdmin'])->name('dashboardAdmin');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');


    Route::get('prahari/{id}/view', [PrahariController::class, 'view'])->name('prahari.view');
    Route::resource('prahari', PrahariController::class);
    Route::resource('cases', CasesController::class);
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::resource('challans', ChallanController::class);
    Route::put('payments/{payment}/approve', [PaymentController::class, 'approve'])->name('payments.approve');
    Route::resource('payments', PaymentController::class);
   Route::prefix('reports')->name('reports.')->group(function () {

    Route::get('/', [ReportController::class, 'index'])
        ->name('index');

    Route::get('/export/csv', [ReportController::class, 'exportCSV'])
        ->name('export.csv');

    Route::get('/export/pdf',[ReportController::class, 'exportPDF'])
    ->name('export.pdf');
});
    Route::resource('admins', AdminController::class)->except(['create', 'show']);
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::post('settings/system-config', [SettingController::class, 'updateSystemConfig'])->name('settings.updateSystemConfig');
});
