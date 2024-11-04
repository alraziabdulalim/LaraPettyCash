<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\AccountNameController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('account-names', AccountNameController::class);
    Route::resource('vouchers', VoucherController::class);

    // Transaction
    Route::resource('transactions', TransactionController::class)->only('index','show');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    Route::post('/reports/show-date-range', [ReportController::class, 'showDateRange'])->name('reports.dateRangeReport');
    Route::post('/reports/show-account-wise', [ReportController::class, 'showAccountWise'])->name('reports.accountWiseReport');
});

require __DIR__.'/auth.php';
