<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::group(['middleware' => 'auth'], function (){
    Route::prefix('master')->group(function () {
        Route::group(['middleware' => ['can:superAdmin']], function () {
            Route::get('admin-manager', [AdminController::class, 'manageAdmin'])->name('master.person-admin-manager');
            Route::get('admin-add', [AdminController::class, 'adminAdd'])->name('master.person-admin-add');
            Route::get('admin-edit/{id}', [AdminController::class, 'adminEdit'])->name('master.person-admin-edit');
            Route::post('admin-save', [AdminController::class, 'adminSave'])->name('master.person-admin-save');
            Route::post('admin-delete', [AdminController::class, 'adminDelete'])->name('master.person-admin-delete');
            Route::get('user-manager', [AdminController::class, 'userManage'])->name('master.user-manager');
            Route::get('user-add', [AdminController::class, 'userAdd'])->name('master.user-add');
            Route::get('qualify-manager', [AdminController::class, 'qualifyManage'])->name('master.qualify-manager');
            Route::get('user-summary', [AdminController::class, 'userSummary'])->name('master.user-summary');
            Route::get('office-manager', [OfficeController::class, 'officeManage'])->name('master.office-manager');
            Route::get('office-add', [OfficeController::class, 'officeAdd'])->name('master.office-add');
            Route::get('team-manager', [TeamController::class, 'teamManage'])->name('master.team-manager');
            Route::get('team-add', [TeamController::class, 'teamAdd'])->name('master.team-add');
            Route::get('team-manager', [TeamController::class, 'teamManage'])->name('master.team-manager');
            Route::get('company-add', [CompanyController::class, 'companyAdd'])->name('master.company-add');
            Route::get('company-manager', [CompanyController::class, 'companyManage'])->name('master.company-manager');
            Route::get('site-add', [SiteController::class, 'siteAdd'])->name('master.site-add');
            Route::get('site-manager', [SiteController::class, 'siteManage'])->name('master.site-manager');
            Route::get('pay-total-manager', [PayController::class, 'payTotalManage'])->name('master.pay-total-manager');
            Route::get('pay-request-manager', [PayController::class, 'payRequestManage'])->name('master.pay-request-manager');
            Route::get('pay-sum-manager', [PayController::class, 'paySumManage'])->name('master.pay-sum-manager');

            Route::get('work-report-manager', [WorkReportController::class, 'workReportManage'])->name('master.work-report-manager');
            Route::post('work-report-table', [WorkReportController::class, 'workReportTable'])->name('master.work-report-table');
            Route::post('work-report-detail-table', [WorkReportController::class, 'workReportDetailTable'])->name('master.work-report-detail-table');
            Route::get('work-report-export-excel/{id}', [WorkReportController::class, 'workReportExportExcel'])->name('master.work-report-export-excel');
        });
    });

    Route::group(['middleware' => ['can:user']], function () {
        Route::get('pay-request', [UserController::class, 'payRequest'])->name('pay-request');
        Route::get('daily-report', [UserController::class, 'dailyReport'])->name('daily-report');
        Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::post('shift-post', [UserController::class, 'shiftPost'])->name('shift-post');
        Route::post('daily-report', [UserController::class, 'dailyReportPost'])->name('daily-report-post');
        Route::post('pay-request', [UserController::class, 'payRequestPost'])->name('pay-request-post');
    });
});


require __DIR__.'/auth.php';
