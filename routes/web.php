<?php

use App\Http\Controllers\DataTestController;
use App\Http\Controllers\OldReportController;
use App\Http\Controllers\OldTransactionController;
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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Old Transaction
Route::get('/oldTransactions', [OldTransactionController::class, 'index'])->name('oldTransactions');
Route::get('/oldTransactions/create', [OldTransactionController::class, 'create'])->name('oldTransactions.create');
Route::post('/oldTransactions', [OldTransactionController::class, 'store'])->name('oldTransactions.store');
Route::get('/oldTransactions/{transaction}/edit', [OldTransactionController::class, 'edit'])->name('oldTransactions.edit');
Route::patch('/oldTransactions/{transaction}/update', [OldTransactionController::class, 'update'])->name('oldTransactions.update');
Route::delete('/oldTransactions/{transaction}', [OldTransactionController::class, 'destroy'])->name('oldTransactions.destroy');
Route::get('/oldTransactions/{transaction}/show', [OldTransactionController::class, 'show'])->name('oldTransactions.show');


// Old Reports
Route::get('/oldReports', [OldReportController::class, 'index'])->name('oldReports');
Route::get('/oldReports/show', [OldReportController::class, 'show'])->name('oldReports.show');

Route::get('/dataTests', [DataTestController::class, 'index'])->name('dataTests');

require __DIR__.'/auth.php';
