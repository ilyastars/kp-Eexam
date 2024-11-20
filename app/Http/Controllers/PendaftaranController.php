<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use App\Models\Jadwal;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendaftaran = \App\Models\Pendaftaran::with('jadwal.skema')->latest()->paginate(20);
        return view('pendaftaran_index', compact('pendaftaran'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($jadwal_id)
    {
        // $data['listUser'] = \App\Models\User::orderBy('nama', 'asc')->get();
        // $data['listJadwal'] = \App\Models\Jadwal::with('skema')->orderBy('tgl_ujian', 'asc')->get();
        // return view('pendaftaran_create', $data);
        
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }
        
        $existingPendaftaran = Pendaftaran::where('user_id', $user->id)->where('jadwal_id', $jadwal_id)->first();
        $jadwal = Jadwal::with('skema')->findOrFail($jadwal_id);

        // Hitung urutan pendaftaran untuk kode pendaftaran
        $pendaftaranCount = Pendaftaran::where('jadwal_id', $jadwal_id)->count();

        return view('pendaftaran_create', [
            'user' => $user,
            'jadwal' => $jadwal,
            'existingPendaftaran' => $existingPendaftaran,
            'pendaftaranCount' => $pendaftaranCount,
        ]);
        
   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $requestData = $request->validate([
            'kd_pendaftaran' => 'required',
            'nama' => 'required',
            'jadwal_id' => 'required',
            'nik' => 'required|numeric|digits:16',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jns_kelamin' => 'required|in:laki-laki,perempuan',
            'kebangsaan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|numeric|min:12',
            'pendidikan' => 'required|in:SMA/SMK,S1,S2',
        ]);

        // dd($requestData);
        $pendaftaran = new \App\Models\Pendaftaran(); 
        $pendaftaran->fill($requestData);
        $pendaftaran->user_id = Auth::user()->id; 
        // dd(Auth::user()->id);
        $pendaftaran->save(); 
        // flash('Anda berhasil mendaftar')->success();
        // return back();
        // redirect('pendaftaran');

        // Buat data transaksi otomatis
        $transaksi = new \App\Models\Transaksi();
        $transaksi->kd_transaksi = 'T' . $pendaftaran->kd_pendaftaran;
        $transaksi->status_bayar = 'pending';
        $transaksi->pendaftaran_id = $pendaftaran->id;

        //buat bukti bayar
        if ($request->hasFile('bukti_bayar')) {
            $fileName = time() . '_' . $request->file('bukti_bayar')->getClientOriginalName();
            $path = $request->file('bukti_bayar')->storeAs('bukti_bayar', $fileName, 'public');
            $transaksi->bukti_bayar = $path;
        }
        
        $transaksi->save();

        // sintak api message wa
        $msg = "Halo Kak $pendaftaran->nama,\n\n" .
        "Selamat, pendaftaran Anda untuk ujian sertifikasi BNSP telah berhasil dengan rincian sebagai berikut:\n\n" .
        "```" . // Awal format monospaced
        sprintf("%-15s: %s\n", "Nama", $pendaftaran->nama) .
        sprintf("%-15s: %s\n", "Nama Skema", $pendaftaran->jadwal->skema->nama_skema) .
        sprintf("%-15s: %s\n", "Tanggal Ujian", $pendaftaran->jadwal->tgl_ujian) .
        "\n" .
        sprintf("%-15s: Rp %s\n", "Nominal", number_format($pendaftaran->jadwal->skema->harga, 0, ',', '.')) .
        "\n" .
        sprintf("%-15s: %s\n", "Bank", "BCA") .
        sprintf("%-15s: %s\n", "Atas Nama", "PT Anugerah Komputer Indonesia") .
        sprintf("%-15s: %s\n", "No Rek", "111-222-3333") .
        "```" . // Akhir format monospaced
        "\nTerima kasih atas pendaftaranya.";
        
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->withOptions([
            'debug' => false,
            'connect_timeout' => false,
            'timeout' => false,
            'verify' => false,
        ])->post('https://crm.woo-wa.com/send/message-text', [
            'deviceId' => 'd_ID@undefined_qhshRmlGcImwSWKyY',
            'number' => $pendaftaran->no_hp,
            'message' => $msg
        ]);
        // end sintak api


        flash('Pendaftaran berhasil, silahkan lanjut melakukan pembayaran.')->success();
        return redirect()->route('transaksi.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        //
    }
}
