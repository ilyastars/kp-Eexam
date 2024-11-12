<?php

namespace App\Http\Controllers;

// use App\Models\Skema;
use App\Models\Jadwal;
use App\Http\Requests\StoreJadwalRequest;
use App\Http\Requests\UpdateJadwalRequest;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = \App\Models\Jadwal::with('skema')->latest()->paginate(20);
        return view('jadwal_index', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['listSkema'] = \App\Models\Skema::orderBy('nama_skema', 'asc')->get();
        return view('jadwal_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'kd_jadwal' => 'required|unique:jadwals,kd_jadwal',
            'skema_id' => 'required',
            'tgl_ujian' => 'required',
            'tempat_ujian' => 'required',
        ]);
        $jadwal = new \App\Models\Jadwal();
        $jadwal->fill($requestData);
        $jadwal->save();
        flash('Data berhasi di simpan')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        //
    }
}
