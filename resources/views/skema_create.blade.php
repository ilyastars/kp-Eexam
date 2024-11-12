@extends('layouts.app_modern', ['title' => 'Data Skema']) 
@section('content') 
<div class="card">
  <h5 class="card-header">Tambah Data Skema</h5>
    <div class="card-body">
      <form action="/skema" method="POST" enctype="multipart/form-data"> 
        @csrf 
        <div class="form-group mt-1 mb-3">
          <label for="kd_skema">Kode Skema</label>
          <input type="text" class="form-control @error('kd_skema') is-invalid @enderror" id="kd_skema" name="kd_skema" value="{{ old('kd_skema') }}">
          <span class="text-danger">{{ $errors->first('kd_skema') }}</span>
        </div>
        <div class="form-group mt-1 mb-3">
          <label for="foto">Foto Skema (jpg, jpeg, png)</label>
          <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
          <span class="text-danger">{{ $errors->first('foto') }}</span>
        </div>
        <div class="form-group mt-1 mb-3">
          <label for="nama_skema">Nama Skema</label>
          <input type="text" class="form-control @error('nama_skema') is-invalid @enderror" id="nama_skema" name="nama_skema" value="{{ old('nama_skema') }}">
          <span class="text-danger">{{ $errors->first('nama_skema') }}</span>
        </div>
        <div class="form-group mt-1 mb-3">
          <label for="level">Level</label>
          <br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="level" id="junior" value="junior" {{ old('level') === 'junior' ? 'checked' : '' }}>
            <label class="form-check-label" for="junior">Junior</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="level" id="senior" value="senior" {{ old('level') === 'senior' ? 'checked' : '' }}>
            <label class="form-check-label" for="senior">Senior</label>
          </div>
          <span class="text-danger">{{ $errors->first('level') }}</span>
        </div>
        <div class="form-group mt-1 mb-3">
          <label for="harga">Harga</label>
          <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') }}">
          <span class="text-danger">{{ $errors->first('harga') }}</span>
        </div>
        <button type="submit" class="btn btn-primary">SIMPAN</button>
      </form>
    </div>
  </div> 
@endsection