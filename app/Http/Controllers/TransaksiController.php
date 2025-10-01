<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::latest()->paginate(10);
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        return view('transaksi.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'nomor_customer' => 'nullable|string',
            'email' => 'nullable|email',
            'tanggal_bayar' => 'nullable|date',
            'status' => 'required|in:Belum Bayar,Sudah Bayar'
        ]);

        Transaksi::create($data);

        return redirect()->route('dashboard')->with('success','Transaksi ditambahkan');
    }

    public function edit(Transaksi $transaksi)
    {
        return view('transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'nomor_customer' => 'nullable|string',
            'email' => 'nullable|email',
            'tanggal_bayar' => 'nullable|date',
            'status' => 'required|in:Belum Bayar,Sudah Bayar'
        ]);

        $transaksi->update($data);

        return redirect()->route('dashboard')->with('success','Transaksi diperbarui');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return back()->with('success','Transaksi dihapus');
    }
}
