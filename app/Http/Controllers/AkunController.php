<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendaftaran = \App\Models\Pendaftaran::with('jadwal.skema')->latest()->paginate(20);
        return view('akun_index', compact('pendaftaran'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Akun $akun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Akun $akun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Akun $akun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Akun $akun)
    {
        //
    }
}
