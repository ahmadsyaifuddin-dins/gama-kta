<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::resource('users', UserController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('members', MemberController::class);
    Route::get('members/{member}/print-card', [MemberController::class, 'printCard'])->name('members.print_card');
    Route::get('members/{member}/print-receipt', [MemberController::class, 'printReceipt'])->name('members.print_receipt');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');

    Route::get('/cek-anggota/{id}', [ValidationController::class, 'check'])->name('members.check');
});

require __DIR__.'/auth.php';
