<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Halaman awal (tidak perlu login)
Route::get('/', function () {
    return view('welcome');
});

// Resource CRUD untuk transaksi (butuh login)
// Resource CRUD untuk transaksi (butuh login)
Route::middleware(['auth'])->group(function () {
    Route::resource('transaksis', TransaksiController::class);

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('transaksis', TransaksiController::class);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route untuk login/register dsb. dari Breeze/Fortify
require __DIR__.'/auth.php';
