@extends('layouts.app_modern', ['title' => 'Pendataran Ujian']) 
@section('content') 
<div class="card">
  <h5 class="card-header">Pendataran Ujian</h5>
    <div class="card-body">
      <form action="/pendaftaran" method="POST" enctype="multipart/form-data"> 
        @csrf 
        <div class="form-group mt-1 mb-3">
          <label for="kd_pendaftaran">Kode Pendaftaran</label>
          <input type="text" class="form-control @error('kd_pendaftaran') is-invalid @enderror" id="kd_pendaftaran" name="kd_pendaftaran" value="{{ old('kd_pendaftaran') }}">
          <span class="text-danger">{{ $errors->first('kd_pendaftaran') }}</span>
        </div>
        <div class="form-group mt-1 mb-3">
          <label for="nama">Nama</label>
          <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
          <span class="text-danger">{{ $errors->first('nama') }}</span>
        </div>
        <div class="form-group  mt-1  mt-3">
          <label for="jadwal_id">Pilih Jadwal dan Skema</label>
            <select name="jadwal_id" id="jadwal_id" class="form-control" required>
                @foreach ($listJadwal as $jadwal)
                    <option value="{{ $jadwal->id }}">
                        {{ $jadwal->skema->nama_skema }} - {{ $jadwal->tgl_ujian }}
                    </option>
                @endforeach
            </select>
           <span class="text-danger">{{ $errors->first('skema_id') }}</span>
        </div>
        <div class="form-group mt-1 mb-3">
          <label for="nik">NIK</label>
          <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik') }}">
          <span class="text-danger">{{ $errors->first('nik') }}</span>
        </div>
        <div class="form-group mt-1 mb-3">
          <label for="tmp_lahir">Tempat Lahir</label>
          <input type="text" class="form-control @error('tmp_lahir') is-invalid @enderror" id="tmp_lahir" name="tmp_lahir" value="{{ old('tmp_lahir') }}">
          <span class="text-danger">{{ $errors->first('tmp_lahir') }}</span>
        </div>
        <div class="form-group mt-3">
          <label for="tgl_lahir">Tanggal Lahir</label>
          <input type="date" name="tgl_lahir" class="form-control"
          value="{{ old('tgl_lahir') ?? date('Y-m-d') }}">
          <span class="text-danger">{{ $errors->first('tgl_lahir') }}</span>
          </div>
        <div class="form-group mt-1 mb-3">
          <label for="jns_kelamin">Jenis Kelamin</label>
          <br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jns_kelamin" id="laki-laki" value="laki-laki" {{ old('jns_kelamin') === 'laki-laki' ? 'checked' : '' }}>
            <label class="form-check-label" for="laki-laki">Laki-laki</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jns_kelamin" id="perempuan" value="perempuan" {{ old('jns_kelamin') === 'perempuan' ? 'checked' : '' }}>
            <label class="form-check-label" for="perempuan">Perempuan</label>
          </div>
          <span class="text-danger">{{ $errors->first('jns_kelamin') }}</span>
        </div>
        <div class="form-group mt-1 mb-3">
          <label for="kebangsaan">Kebangsaan</label>
          <input type="text" class="form-control @error('kebangsaan') is-invalid @enderror" id="kebangsaan" name="kebangsaan" value="{{ old('kebangsaan') }}">
          <span class="text-danger">{{ $errors->first('kebangsaan') }}</span>
        </div>
        <div class="form-group mt-1 mb-3">
          <label for="alamat">Alamat</label>
          <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') }}">
          <span class="text-danger">{{ $errors->first('alamat') }}</span>
        </div>
        <div class="form-group mt-1 mb-3">
          <label for="no_hp">No HP</label>
          <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
          <span class="text-danger">{{ $errors->first('no_hp') }}</span>
        </div>
        <div class="form-group mt-1 mb-3">
          <label for="pendidikan">Pendidikan</label>
          <input type="text" class="form-control @error('pendidikan') is-invalid @enderror" id="pendidikan" name="pendidikan" value="{{ old('pendidikan') }}">
          <span class="text-danger">{{ $errors->first('pendidikan') }}</span>
        </div>
        <button type="submit" class="btn btn-primary">DAFTAR</button>
      </form>
    </div>
  </div> 
@endsection