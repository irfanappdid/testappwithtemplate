<?php

namespace App;

use App\Http\Controllers\Admin\AssignprojectController;
use App\Http\Controllers\Admin\BusinessSettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeesController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\EmpdashboardController;
use App\Http\Controllers\Misc\SendReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.home.index');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout-admin');
});

Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
    Route::name('home.')->controller(DashboardController::class)->group(function () {
        Route::get('/', 'home')->name('index');
        Route::get('invoice-download', 'downloadPdf')->name('invoice-download');
    });

    Route::controller(SendReportController::class)->name('miscellaneous.')->prefix('miscellaneous')->group(function () {
        Route::post('send-report', 'send')->name('send-report');
    });

    Route::name('business-settings.')
        ->prefix('business-settings')
        ->controller(BusinessSettingController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('store', 'store')->name('store');
        });

    Route::name('users.')
        ->prefix('users')
        ->controller(UserController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::get('{id}/edit', "edit")->name('edit');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('update', 'update')->name('update');
            Route::put('status', 'status')->name('status');
        });

    // Route::name('students.')
    //     ->prefix('students')
    //     ->controller(StudentController::class)->group(function () {
    //     Route::get('/', 'index')->name('index');
    //     Route::get('blocked', 'index')->name('blocked');
    //     Route::get('deleted', 'index')->name('deleted');
    //     Route::post('store', 'store')->name('store');
    //     Route::get('{id}/edit', "edit")->name('edit');
    //     Route::delete('/{id}', 'destroy')->name('destroy');
    //     Route::post('update', 'update')->name('update');
    //     Route::put('status', 'status')->name('status');
    // });
    // Route::name('subjects.')
    //     ->prefix('subjects')
    //     ->controller(SubjectController::class)->group(function () {
    //     Route::get('/', 'index')->name('index');
    //     Route::get('blocked', 'index')->name('blocked');
    //     Route::get('deleted', 'index')->name('deleted');
    //     Route::post('store', 'store')->name('store');
    //     Route::get('{id}/edit', "edit")->name('edit');
    //     Route::delete('/{id}', 'destroy')->name('destroy');
    //     Route::post('update', 'update')->name('update');
    //     Route::put('status', 'status')->name('status');
    // });

    // Route::name('sliders.')
    //     ->prefix('sliders')
    //     ->controller(SliderController::class)->group(function () {
    //     Route::get('/', 'index')->name('index');
    //     Route::get('blocked', 'index')->name('blocked');
    //     Route::get('deleted', 'index')->name('deleted');
    //     Route::post('store', 'store')->name('store');
    //     Route::get('{id}/edit', "edit")->name('edit');
    //     Route::get('{id}/restore', "restoreDeletedValue")->name('restoreDeletedValue');
    //     Route::delete('/{id}', 'destroy')->name('destroy');
    //     Route::post('update', 'update')->name('update');
    //     Route::put('status', 'status')->name('status');
    // });


    Route::name('projects.')
        ->prefix('projects')
        ->controller(ProjectController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::get('{id}/edit', "edit")->name('edit');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('update', 'update')->name('update');
            Route::put('status', 'status')->name('status');
        });


    Route::name('employees.')
        ->prefix('employees')
        ->controller(EmployeesController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::get('{id}/edit', "edit")->name('edit');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('update', 'update')->name('update');
            Route::put('status', 'status')->name('status');
        });

    Route::name('assignprojects.')
        ->prefix('assignprojects')
        ->controller(AssignprojectController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::get('{id}/edit', "edit")->name('edit');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('update', 'update')->name('update');
            Route::put('status', 'status')->name('status');
        });

    Route::resource('employee', ProjectController::class);
    Route::get('export-csv', [ProjectController::class, 'exportCSV'])->name('export');
    Route::get('generate-pdf', [ProjectController::class, 'generatePDF']);
});
// route::prefix('employee')->group(function () {
//     Route::get('/login', [EmpdashboardController::class, 'index'])->name('employee.login');
//     Route::post('/login', [EmpdashboardController::class, 'store'])->name('employee.store');
//     Route::get('/employee_dashboard', [EmpdashboardController::class, 'employee_dashboard'])->name('employee.employee_dashboard');
//     Route::get('/logout', [EmpdashboardController::class, 'logout'])->name('logout-employee');
// });

Route::prefix('employee')->name('employee.')->group(function () {

    Route::middleware('guest')->group(function () {

        Route::get('/login', [EmpdashboardController::class, 'index'])->name('login');
        Route::post('/login', [EmpdashboardController::class, 'store'])->name('store');
    });

    Route::middleware('employee')->group(function () {

        Route::get('/employee_dashboard', [EmpdashboardController::class, 'employee_dashboard'])->name('employee_dashboard');
        Route::get('/logout', [EmpdashboardController::class, 'logout'])->name('logout-employee');
    });
});
