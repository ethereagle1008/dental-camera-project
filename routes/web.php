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

            Route::get('user-manager', [AdminController::class, 'userManage'])->name('master.person-user-manager');
            Route::get('user-add', [AdminController::class, 'userAdd'])->name('master.person-user-add');
            Route::get('user-edit/{id}', [AdminController::class, 'userEdit'])->name('master.person-user-edit');
            Route::post('user-save', [AdminController::class, 'userSave'])->name('master.person-user-save');
            Route::post('user-delete', [AdminController::class, 'userDelete'])->name('master.person-user-delete');
            Route::get('user-summary', [AdminController::class, 'userSummary'])->name('master.person-user-summary');

            Route::get('qualify-manager', [AdminController::class, 'qualifyManage'])->name('master.person-qualify-manager');
            Route::post('qualify-save', [AdminController::class, 'qualifySave'])->name('master.person-qualify-save');
            Route::post('qualify-delete', [AdminController::class, 'qualifyDelete'])->name('master.person-qualify-delete');

            Route::get('office-manager', [OfficeController::class, 'officeManage'])->name('master.office-manager');
            Route::post('office-save', [OfficeController::class, 'officeSave'])->name('master.office-save');
            Route::post('office-delete', [OfficeController::class, 'officeDelete'])->name('master.office-delete');
            Route::get('office-add', [OfficeController::class, 'officeAdd'])->name('master.office-add');

            Route::get('team-manager', [TeamController::class, 'teamManage'])->name('master.team-manager');
            Route::get('team-add', [TeamController::class, 'teamAdd'])->name('master.team-add');
            Route::post('team-save', [TeamController::class, 'teamSave'])->name('master.team-save');
            Route::post('team-delete', [TeamController::class, 'teamDelete'])->name('master.team-delete');

            Route::get('company-add', [CompanyController::class, 'companyAdd'])->name('master.company-add');
            Route::post('company-save', [CompanyController::class, 'companySave'])->name('master.company-save');
            Route::post('company-delete', [CompanyController::class, 'companyDelete'])->name('master.company-delete');
            Route::get('company-manager', [CompanyController::class, 'companyManage'])->name('master.company-manager');

            Route::get('site-add', [SiteController::class, 'siteAdd'])->name('master.site-add');
            Route::get('site-edit/{id}', [SiteController::class, 'siteEdit'])->name('master.site-edit');
            Route::post('site-save', [SiteController::class, 'siteSave'])->name('master.site-save');
            Route::post('site-delete', [SiteController::class, 'siteDelete'])->name('master.site-delete');
            Route::get('site-manager', [SiteController::class, 'siteManage'])->name('master.site-manager');

            Route::get('pay-total-manager', [PayController::class, 'payTotalManage'])->name('master.pay-total-manager');
            Route::get('pay-request-manager', [PayController::class, 'payRequestManage'])->name('master.pay-request-manager');
            Route::post('pay-request-table', [PayController::class, 'payRequestTable'])->name('master.pay-request-table');
            Route::post('pay-request-status', [PayController::class, 'payRequestStatus'])->name('master.pay-request-status');
            Route::get('pay-sum-manager', [PayController::class, 'paySumManage'])->name('master.pay-sum-manager');
            Route::get('pay-sum-person', [PayController::class, 'paySumPerson'])->name('master.pay-sum-person');
            Route::get('pay-sum-month', [PayController::class, 'paySumMonth'])->name('master.pay-sum-month');

            Route::get('work-report-manager', [WorkReportController::class, 'workReportManage'])->name('master.work-report-manager');
            Route::post('work-report-table', [WorkReportController::class, 'workReportTable'])->name('master.work-report-table');
            Route::post('work-report-detail-table', [WorkReportController::class, 'workReportDetailTable'])->name('master.work-report-detail-table');
            Route::get('work-report-export-excel/{id}', [WorkReportController::class, 'workReportExportExcel'])->name('master.work-report-export-excel');

            Route::get('work-shift-manager', [WorkReportController::class, 'workShiftManage'])->name('master.work-shift-manager');
            Route::post('work-shift-table', [WorkReportController::class, 'workShiftTable'])->name('master.work-shift-table');
            Route::get('work-person-shift', [WorkReportController::class, 'workShiftPerson'])->name('master.work-person-shift');
            Route::get('work-total-shift', [WorkReportController::class, 'workShiftTotal'])->name('master.work-total-shift');
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
