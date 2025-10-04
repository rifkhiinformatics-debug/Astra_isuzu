<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// Route cronjob (rahasia, biar tidak bisa diakses sembarang orang)
Route::get('/cron/rahasiabanget123', function () {
    Artisan::call('schedule:run');
    return response()->json(['status' => 'ok', 'message' => 'Cron executed successfully']);
});

// Halaman awal (tidak perlu login)
Route::get('/', function () {
    return view('welcome');
});

// Resource CRUD untuk transaksi + Dashboard + Profile (butuh login)
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Transaksi (CRUD)
    Route::resource('transaksis', TransaksiController::class);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk login/register dsb. dari Breeze/Fortify
require __DIR__.'/auth.php';
