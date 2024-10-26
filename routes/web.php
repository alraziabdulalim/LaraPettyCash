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

    // Voucher
    Route::get('/vouchers', [VoucherController::class, 'index'])->name('vouchers');
    Route::get('/vouchers/create', [VoucherController::class, 'create'])->name('vouchers.create');
    Route::post('/vouchers', [VoucherController::class, 'store'])->name('vouchers.store');
    Route::get('/vouchers/{transaction}/edit', [VoucherController::class, 'edit'])->name('vouchers.edit');
    Route::patch('/vouchers/{transaction}/update', [VoucherController::class, 'update'])->name('vouchers.update');
    Route::delete('/vouchers/{transaction}', [VoucherController::class, 'destroy'])->name('vouchers.destroy');
    Route::get('/vouchers/{transaction}/show', [VoucherController::class, 'show'])->name('vouchers.show');

    // Transaction
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
    Route::post('/transactions/show', [TransactionController::class, 'show'])->name('transactions.show');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    Route::post('/reports/show', [ReportController::class, 'show'])->name('reports.show');
});

require __DIR__.'/auth.php';
