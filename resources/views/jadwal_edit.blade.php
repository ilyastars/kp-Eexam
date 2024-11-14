@if (auth()->user()->hasRole('admin'))
    
@extends('layouts.app_modern', ['title' => 'Data jadwal']) 
@section('content') 
<div class="card">
    <h5 class="card-header">Edit Data <b>{{ $jadwal->skema->nama_skema }}</b></h5>
    <div class="card-body">
      <form action="/jadwal" method="POST" enctype="multipart/form-data"> 
        @csrf 
        <div class="form-group mt-1 mb-3">
          <label for="kd_jadwal">Kode jadwal</label>
          <input type="text" class="form-control @error('kd_jadwal') is-invalid @enderror" id="kd_jadwal" name="kd_jadwal" value="{{ old('kd_jadwal') ?? $jadwal->kd_jadwal }}">
          <span class="text-danger">{{ $errors->first('kd_jadwal') }}</span>
        </div>
        <div class="form-group  mt-1  mt-3">
          <label for="skema_id">Nama Skema</label>
            <select name="skema_id" class="form-control">
              <option value="">-- Pilih Skema --</option>
                @foreach ($listSkema as $item)
                <option value="{{ $item->id ?? $jadwal->skema->nama_skema }}" @selected(old('skema_id') == $item->id)>
                {{ $item->nama_skema }}
              </option>
            @endforeach
            </select>
           <span class="text-danger">{{ $errors->first('skema_id') }}</span>
        </div>
        <div class="form-group  mt-1  mt-3">
          <label for="tgl_ujian">Tanggal Ujian</label>
          <input type="date" name="tgl_ujian" class="form-control"
          value="{{ old('tgl_ujian') ?? date('Y-m-d') ?? $skema->kd_skema}}">
          <span class="text-danger">{{ $errors->first('tgl_ujian') }}</span>
          </div>
        <div class="form-group mt-1 mb-3">
          <label for="tempat_ujian">Tempat Ujian</label>
          <input type="text" class="form-control @error('tempat_ujian') is-invalid @enderror" id="tempat_ujian" name="tempat_ujian" value="{{ old('tempat_ujian') ?? $jadwal->tempat_ujian }}">
          <span class="text-danger">{{ $errors->first('tempat_ujian') }}</span>
        </div>
        <button type="submit" class="btn btn-primary">SIMPAN</button>
      </form>
    </div>
  </div> 
@endsection

@endif