<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use App\Models\Jadwal;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if ($request->hasFile('bukti_bayar')) {
            $fileName = time() . '_' . $request->file('bukti_bayar')->getClientOriginalName();
            $path = $request->file('bukti_bayar')->storeAs('bukti_bayar', $fileName, 'public');
            $transaksi->bukti_bayar = $path;
        }
        
        $transaksi->save();
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
