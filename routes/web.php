<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

Route::get('/mail-test', function () {
    try {
        Mail::raw('Tes kirim email dari Astra Isuzu', function ($message) {
            $message->to('rifkhisiddo@gmail.com')
                    ->subject('Tes Email Laravel di Railway');
        });
        return 'Email berhasil dikirim!';
    } catch (Exception $e) {
        return 'Gagal kirim email: ' . $e->getMessage();
    }
});

// Route cronjob (rahasia, biar tidak bisa diakses sembarang orang)
Route::get('/cron/rahasiabanget123', function () {
    Artisan::call('schedule:run');
    return response()->json(['status' => 'ok', 'message' => 'Cron executed successfully']);
});

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
