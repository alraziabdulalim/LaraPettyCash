<?php

use App\Http\Controllers\DataTestController;
use App\Http\Controllers\OldReportController;
use App\Http\Controllers\OldTransactionController;
use App\Http\Controllers\OldVoucherController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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

    // Old Voucher
    Route::get('/oldVouchers', [OldVoucherController::class, 'index'])->name('oldVouchers');
    Route::get('/oldVouchers/create', [OldVoucherController::class, 'create'])->name('oldVouchers.create');
    Route::post('/oldVouchers', [OldVoucherController::class, 'store'])->name('oldVouchers.store');
    Route::get('/oldVouchers/{transaction}/edit', [OldVoucherController::class, 'edit'])->name('oldVouchers.edit');
    Route::patch('/oldVouchers/{transaction}/update', [OldVoucherController::class, 'update'])->name('oldVouchers.update');
    Route::delete('/oldVouchers/{transaction}', [OldVoucherController::class, 'destroy'])->name('oldVouchers.destroy');
    Route::get('/oldVouchers/{transaction}/show', [OldVoucherController::class, 'show'])->name('oldVouchers.show');
    
    // Old Transaction
    Route::get('/oldTransactions', [OldTransactionController::class, 'index'])->name('oldTransactions');
    Route::get('/oldTransactions/show', [OldTransactionController::class, 'show'])->name('oldTransactions.show');
        
    // Old Reports
    Route::get('/oldReports', [OldReportController::class, 'index'])->name('oldReports');
    Route::get('/oldReports/show', [OldReportController::class, 'show'])->name('oldReports.show');
    
    Route::get('/dataTests', [DataTestController::class, 'index'])->name('dataTests');
});

require __DIR__.'/auth.php';
