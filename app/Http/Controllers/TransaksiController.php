<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    // public function review()
    // {
    //     $transaksis = Transaksi::with('pendaftaran')->get();
    //     return view('transaksi_review', compact('transaksis'));
    // }

    // public function updateStatus(Request $request, Transaksi $transaksi)
    // {
    //     // $transaksis = Transaksi::with('pendaftaran')->get();
    //     $request->validate([
    //         'status_bayar' => 'required|in:pending,completed',
    //     ]);

    //     if ($request->status_bayar === 'completed') {
    //         $peserta = new \App\Models\Peserta();
    //         // new \App\Models\Transaksi();
    //         $peserta->transaksi_id = $transaksi->id;
    //         // $peserta->nama = $transaksi->pendaftaran->nama;
    //         // $peserta->nama_skema = $transaksi->pendaftaran->jadwal->skema->nama_skema;
    //         $peserta->save();
    //     }

    //     $transaksi->status_bayar = $request->status_bayar;
    //     $transaksi->save();
        
    //     // sintak api message wa
    //     $msg = "Halo Kak" . $transaksi->pendaftaran->nama . ",\n\n" .
    //     "Selamat pembayaran Anda untuk ujian sertifikasi BNSP sudah completed, dengan rincian sebagai berikut:\n\n" .
    //     "```" . // Awal format monospaced
    //     sprintf("%-15s: %s\n", "Nama", $transaksi->pendaftaran->nama) .
    //     sprintf("%-15s: %s\n", "Nama Skema", $transaksi->pendaftaran->jadwal->skema->nama_skema) .
    //     sprintf("%-15s: %s\n", "Tanggal Ujian", $transaksi->pendaftaran->jadwal->tgl_ujian) .
    //     "\n" .
    //     sprintf("%-15s: Rp %s\n", "Nominal", number_format($transaksi->pendaftaran->jadwal->skema->harga, 0, ',', '.')) .
    //     "\n" .
    //     "```" . // Akhir format monospaced
    //     "Silahkan Anda bisa melanjutkan ujian dengan melakukan pengecekan di peserta pada dashboard eExamp nya yaa." .
    //     "Terima kasih atas pendaftaran dan pembayaranya Anda.";
        
    //     $response = Http::withHeaders([
    //         'Content-Type' => 'application/json'
    //     ])->withOptions([
    //         'debug' => false,
    //         'connect_timeout' => false,
    //         'timeout' => false,
    //         'verify' => false,
    //     ])->post('https://crm.woo-wa.com/send/message-text', [
    //         'deviceId' => 'd_ID@undefined_qhshRmlGcImwSWKyY',
    //         'number' => $transaksi->pendaftaran->no_hp,
    //         'message' => $msg
    //     ]);
    //     // end sintak api

    //     flash('Status pembayaran berhasil diperbarui!')->success();
    //     return redirect()->back();
    //     // return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui!');
    // }


    public function uploadBuktiBayar(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // dd('bukti_bayar');

        $transaksi = Transaksi::findOrFail($id);
        if ($request->hasFile('bukti_bayar')) {
            $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');
            $transaksi->bukti_bayar = $path;
            $transaksi->save();
        }

        return redirect()->route('transaksi.index')->with('success', 'Bukti bayar berhasil diunggah.');
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
    // public function update(Request $request, Transaksi $transaksi)
    // {
    //     //
    // }
    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'status_bayar' => 'required|in:pending,completed',
            'bukti_bayar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('bukti_bayar')) {
            $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');
            $transaksi->bukti_bayar = $path;
        }

        $transaksi->status_bayar = $request->input('status_bayar');
        $transaksi->save();

        if ($transaksi->status_bayar === 'completed') {
            Peserta::create([
                'transaksi_id' => $transaksi->id,
                // 'nama' => $transaksi->pendaftaran->nama,
                // 'nama_skema' => $transaksi->pendaftaran->jadwal->skema->nama_skema,
            ]);
        }

        // sintak api message wa
        $msg = "Halo Kak " . $transaksi->pendaftaran->nama . ",\n\n" .
        "Selamat pembayaran Anda untuk ujian sertifikasi BNSP sudah completed, dengan rincian sebagai berikut:\n\n" .
        "```" . // Awal format monospaced
        sprintf("%-15s: %s\n", "Nama", $transaksi->pendaftaran->nama) .
        sprintf("%-15s: %s\n", "Nama Skema", $transaksi->pendaftaran->jadwal->skema->nama_skema) .
        sprintf("%-15s: %s\n", "Tanggal Ujian", $transaksi->pendaftaran->jadwal->tgl_ujian) .
        sprintf("%-15s: Rp %s\n", "Nominal", number_format($transaksi->pendaftaran->jadwal->skema->harga, 0, ',', '.')) .
        "\n" .
        "```" . // Akhir format monospaced
        "Silahkan Anda bisa melanjutkan ujian dengan melakukan pengecekan di *Menu Peserta* pada dashboard eExam nya yaa.\n" .
        "Terima kasih atas pendaftaran dan pembayaranya.";
        
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->withOptions([
            'debug' => false,
            'connect_timeout' => false,
            'timeout' => false,
            'verify' => false,
        ])->post('https://crm.woo-wa.com/send/message-text', [
            'deviceId' => 'd_ID@undefined_qhshRmlGcImwSWKyY',
            'number' => $transaksi->pendaftaran->no_hp,
            'message' => $msg
        ]);
        // end sintak api

        flash('Status pembayaran berhasil diperbarui!')->success();
        return redirect()->back();
        // return redirect()->back()->with('success', 'Transaksi updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
