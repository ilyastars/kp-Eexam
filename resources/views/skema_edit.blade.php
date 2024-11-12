@extends('layouts.app_modern', ['title' => 'Data Skema']) 
@section('content') 
<div class="card">
    <h5 class="card-header">Edit Data <b>{{ $skema->nama_skema }}</b></h5>
    <div class="card-body">
    <form action="/skema/{{ $skema->id }}" method="POST" enctype="multipart/form-data"> 
        @method('put')
        @csrf 
        <div class="form-group mt-1 mb-3">
          <label for="kd_skema">Kode Skema</label>
          <input type="text" class="form-control @error('kd_skema') is-invalid @enderror" id="kd_skema" name="kd_skema" value="{{ old('kd_skema') ?? $skema->kd_skema }}">
          <span class="text-danger">{{ $errors->first('kd_skema') }}</span>
        </div>
        <div class="form-group mt-1 mb-3">
          <label for="foto">Foto Skema (jpg, jpeg, png)</label>
          <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
          <span class="text-danger">{{ $errors->first('foto') }}</span>
          <img src="{{ Storage::url($skema->foto) }}" alt="Foto Skema" class="img-thumbnail mt-2" style="width: 100px">
        </div>
        <div class="form-group mt-1 mb-3">
          <label for="nama_skema">Nama Skema</label>
          <input type="text" class="form-control @error('nama_skema') is-invalid @enderror" id="nama_skema" name="nama_skema" value="{{ old('nama_skema') ?? $skema->nama_skema }}">
          <span class="text-danger">{{ $errors->first('nama_skema') }}</span>
        </div>
        <div class="form-group mt-1 mb-3">
          <label for="level">Level</label>
          <br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="level" id="junior" value="junior" {{ old('level') ?? $skema->level === 'junior' ? 'checked' : '' }}>
            <label class="form-check-label" for="junior">Junior</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="level" id="senior" value="senior" {{ old('level') ?? $skema->level === 'senior' ? 'checked' : '' }}>
            <label class="form-check-label" for="senior">Senior</label>
          </div>
          <span class="text-danger">{{ $errors->first('level') }}</span>
        </div>
        <div class="form-group mt-1 mb-3">
          <label for="harga">Harga</label>
          <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') ?? $skema->harga }}">
          <span class="text-danger">{{ $errors->first('harga') }}</span>
        </div>
        <button type="submit" class="btn btn-primary">UPDATE</button>
      </form>
    </div>
  </div> 
@endsection