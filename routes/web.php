<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\Admin\FeeController;
use App\Http\Controllers\Admin\PaymentController;

/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTH PROFILE ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |-------------------------
        | Dashboard
        |-------------------------
        */
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |-------------------------
        | CRUD MODULES
        |-------------------------
        */
        Route::resource('students', StudentController::class);
        Route::resource('teachers', TeacherController::class);
        Route::resource('classes', ClassController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource('fees', FeeController::class);
        Route::resource('payments', PaymentController::class);

        /*
        |-------------------------
        | FINANCE MODULE
        |-------------------------
        */
        Route::prefix('finance')->name('finance.')->group(function () {

            // Finance dashboard page
            Route::get('/', [FinanceController::class, 'index'])
                ->name('index');

            // Invoice view
            Route::get('/invoice/{student}', [FinanceController::class, 'invoice'])
                ->name('invoice');

            // PDF invoice
            Route::get('/invoice/pdf/{id}', [FinanceController::class, 'invoicePdf'])
                ->name('invoice.pdf');

        });

    });

require __DIR__.'/auth.php';