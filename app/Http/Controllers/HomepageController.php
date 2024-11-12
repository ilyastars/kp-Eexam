<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use App\Models\Jadwal;
use App\Models\Homepage;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $data['listJadwal'] = Jadwal::with('skema')->orderBy('tgl_ujian', 'asc')->get();
        return view('app_homepage', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'kd_skema' => 'required|unique:skemas,kd_skema',
            'nama_skema' => 'required',
            'level' => 'required|in:junior,senior',
            'harga' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5000',
        ]);
        $skema = new \App\Models\Skema(); //membuat objjek kosong di variable model
        $skema->fill($requestData); //mengisi var model dgn data yg sudah di validasi request
        // dd($request->file());
        $skema->foto = $request->file('foto')->store('public');
        // dd($skema);
        $skema->save(); //menyimpan data ke database
        flash('Data sudah di simpan')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    // public function show(Homepage $homepage)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Homepage $homepage)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Homepage $homepage)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Homepage $homepage)
    // {
    //     //
    // }
}
