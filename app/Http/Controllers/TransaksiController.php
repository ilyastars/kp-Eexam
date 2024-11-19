<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $transaksi = \App\Models\Transaksi::with('pendaftaran.user')->latest()->paginate(20);
        // return view('transaksi_index', compact('transaksi'));
        $transaksis = Transaksi::with('pendaftaran')->get(); // Pastikan relasi 'pendaftaran' ada di model Transaksi
        return view('transaksi_index', compact('transaksis'));
    }

    public function updateStatus(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'status_bayar' => 'required|in:pending,completed',
        ]);

        if ($request->status_bayar === 'completed') {
            $peserta = new Peserta();
            $peserta->transaksi_id = $transaksi->id;
            $peserta->nama = $transaksi->pendaftaran->nama;
            $peserta->nama_skema = $transaksi->pendaftaran->jadwal->skema->nama_skema;
            $peserta->save();
        }

        $transaksi->status_bayar = $request->status_bayar;
        $transaksi->save();

        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui!');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
