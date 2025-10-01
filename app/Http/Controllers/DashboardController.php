<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua transaksi dari tabel
        $totalTransaksi = Transaksi::count();
        $belumBayar = Transaksi::where('status', 'Belum Bayar')->count();
        $sudahBayar = Transaksi::where('status', 'Sudah Bayar')->count();
        $pengingatTerkirim = Transaksi::where('reminder_sent', true)->count();

        // Ambil daftar transaksi terbaru
        $transaksis = Transaksi::latest()->get();

        return view('dashboard', compact(
            'totalTransaksi',
            'belumBayar',
            'sudahBayar',
            'pengingatTerkirim',
            'transaksis'
        ));
    }
}
