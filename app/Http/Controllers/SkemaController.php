<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['skema'] = \App\Models\Skema::latest()->paginate(10);
        return view('skema_index', $data);
        // return view('skema_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('skema_create');
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
        $skema->foto = $request->file('foto')->store('foto','public');
        // dd($skema);
        $skema->save(); //menyimpan data ke database
        flash('Data sudah di simpan')->success();
        return back();
        // return back()->with('pesan', 'Horee.. Data sudah di simpan'); //tanpa laracasts/flash
            //mengarahkan user ke url sebelumya yaitu /skema/create dgn membawa variabel pesan
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['skema'] = \App\Models\Skema::findOrFail($id);
        return view('skema_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = $request->validate([
            'kd_skema' => 'required|unique:skemas,kd_skema,' . $id,
            'nama_skema' => 'required',
            'level' => 'required|in:junior,senior',
            'harga' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
        ]);
        $skema = \App\Models\Skema::findOrFail($id); 
        $skema->fill($requestData); 
        if ($request->hasFile('foto')){
            Storage::delete($skema->foto);
            $skema->foto = $request->file('foto')->store('foto','public');
        }
        $skema->save(); 
        flash('Data sudah di update')->success();
        return redirect('/skema');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $skema = \App\Models\Skema::findOrFail($id);

        if ($skema->pendaftaran->count() >= 1) { //data skema tidak di hapus apabila sudah ada di data tabel lainya
            flash('Ops.. Data tidak bisa di hapus karena terkait dengan data pendaftaran')->error();
            return back();
        }

        if ($skema->foto != null && Storage::exists($skema->foto)) {
            Storage::delete($skema->foto);
        }
        $skema->delete();
        flash('Data sudah di hapus')->success();
        return back();
    }
}
