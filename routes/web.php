<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\WorkReportController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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
    $users = User::all();
    return view('auth.login', compact('users'));
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

            Route::get('business-manager', [AdminController::class, 'businessManager'])->name('master.user-business-manager');
            Route::post('business-manager-table', [AdminController::class, 'businessManagerTable'])->name('master.business-manager-table');
            Route::get('employee-manager', [AdminController::class, 'employeeManager'])->name('master.user-employee-manager');
            Route::post('employee-manager-table', [AdminController::class, 'employeeManagerTable'])->name('master.employee-manager-table');

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
            Route::get('invoice-manager', [CompanyController::class, 'invoiceManage'])->name('master.invoice-manager');

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
            Route::post('pay-sum-table', [PayController::class, 'paySumTable'])->name('master.pay-sum-table');
            Route::post('pay-person-table', [PayController::class, 'payPersonTable'])->name('master.pay-person-table');
            Route::post('pay-month-table', [PayController::class, 'payMonthTable'])->name('master.pay-month-table');
            Route::get('pay-sum-personal', [PayController::class, 'paySumPersonal'])->name('master.pay-sum-person');
            Route::get('pay-sum-month', [PayController::class, 'paySumMonth'])->name('master.pay-sum-month');

            Route::get('work-report-manager', [WorkReportController::class, 'workReportManage'])->name('master.work-report-manager');
            Route::post('work-report-status', [WorkReportController::class, 'workReportStatus'])->name('master.work-report-status');
            Route::post('work-report-table', [WorkReportController::class, 'workReportTable'])->name('master.work-report-table');
            Route::post('work-report-detail-table', [WorkReportController::class, 'workReportDetailTable'])->name('master.work-report-detail-table');
            Route::post('work-report-detail-edit', [WorkReportController::class, 'workReportDetailEdit'])->name('master.work-report-detail-edit');
            Route::get('work-report-export-excel/{id}', [WorkReportController::class, 'workReportExportExcel'])->name('master.work-report-export-excel');
            Route::get('work-report-export-down', [WorkReportController::class, 'workReportExportDown'])->name('master.work-report-export-down');
            Route::get('work-report-down-list', [WorkReportController::class, 'workReportDownList'])->name('master.work-report-down-list');

            Route::get('work-shift-manager', [WorkReportController::class, 'workShiftManage'])->name('master.work-shift-manager');
            Route::post('work-shift-table', [WorkReportController::class, 'workShiftTable'])->name('master.work-shift-table');
            Route::post('work-shift-change', [WorkReportController::class, 'workShiftChange'])->name('master.work-shift-change');
            Route::post('work-shift-person', [WorkReportController::class, 'workShiftPerson'])->name('master.work-shift-personal');
            Route::get('work-total-shift', [WorkReportController::class, 'workShiftTotal'])->name('master.work-total-shift');
            Route::post('work-shift-total-table', [WorkReportController::class, 'workShiftTotalTable'])->name('master.work-shift-total-table');

            Route::get('travel-manager', [TravelController::class, 'travelManager'])->name('master.travel-manager');
            Route::post('travel-save', [TravelController::class, 'travelSave'])->name('master.travel-save');
            Route::post('travel-delete', [TravelController::class, 'travelDelete'])->name('master.travel-delete');
            Route::get('vehicle-manager', [VehicleController::class, 'vehicleManager'])->name('master.vehicle-manager');
            Route::post('vehicle-save', [VehicleController::class, 'vehicleSave'])->name('master.vehicle-save');
            Route::post('vehicle-delete', [VehicleController::class, 'vehicleDelete'])->name('master.vehicle-delete');

            Route::get('borrow-manager', [BorrowController::class, 'borrowManager'])->name('master.borrow-manager');
            Route::post('borrow-save', [BorrowController::class, 'borrowSave'])->name('master.borrow-save');
            Route::post('borrow-delete', [BorrowController::class, 'borrowDelete'])->name('master.borrow-delete');
            Route::get('borrow-balance-manager', [BorrowController::class, 'borrowBalanceManager'])->name('master.borrow-balance-manager');
        });
    });

    Route::group(['middleware' => ['can:user']], function () {
        Route::get('pay-request', [UserController::class, 'payRequest'])->name('pay-request');
        Route::get('daily-report', [UserController::class, 'dailyReport'])->name('daily-report');
        Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::post('shift-post', [UserController::class, 'shiftPost'])->name('shift-post');
        Route::post('daily-report', [UserController::class, 'dailyReportPost'])->name('daily-report-post');
        Route::get('vehicle-report', [UserController::class, 'vehicleReport'])->name('vehicle-report');
        Route::post('vehicle-report', [UserController::class, 'vehicleReportPost'])->name('vehicle-report-post');
        Route::post('pay-request', [UserController::class, 'payRequestPost'])->name('pay-request-post');
    });
});


require __DIR__.'/auth.php';
