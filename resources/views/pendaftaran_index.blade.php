@extends('layouts.app_modern', ['title' => 'Data Pendaftaran']) 
@section('content') 
<div class="card">
  <h5 class="card-header">Data Pendaftaran</h5>
    <div class="card-body">
      {{-- <h3>Data pendaftaran</h3> --}}
      <a href="/pendaftaran/create" class="btn btn-primary">Tambah Data</a>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>NO</th>
              <th>Nama Skema</th>
              <th>Kode Pendaftaran</th>
              <th>Nama</th>
              <th>NIK</th>
              <th>Tempat Lahir</th>
              <th>Tanggal Lahir</th>
              <th>Jenis Kelamin</th>
              <th>Kebangsaan</th>
              <th>Alamat</th>
              <th>No Hp</th>
              <th>Pendidikan</th>
              <th>Tgl Pendaftaran</th>
              <th>AKSI</th>
            </tr>
          </thead>
          <tbody> 
              @foreach ($pendaftaran as $item) 
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->jadwal->skema->nama_skema }}</td>
                  <td>{{ $item->jadwal->tgl_ujian }}</td>
                  <td>{{ $item->kd_pendaftaran }}</td>
                  <td>{{ $item->nama }}</td>
                  <td>{{ $item->nik }}</td>
                  <td>{{ $item->tmp_lahir }}</td>
                  <td>{{ $item->tgl_lahir }}</td>
                  <td>{{ $item->jns_kelamin }}</td>
                  <td>{{ $item->kebangsaan }}</td>
                  <td>{{ $item->alamat }}</td>
                  <td>{{ $item->no_hp }}</td>
                  <td>{{ $item->pendidikan }}</td>
                  <td>{{ $item->created_at }}</td>
                  <td>
                  <a href="/pendaftaran/{{ $item->id }}/edit" class="btn btn-warning btn-sm">
                      Edit
                  </a>
                  <form action="/pendaftaran/{{ $item->id }}" method="post" class="d-inline">
                      @csrf
                      @method('delete')
                      <button class="btn btn-danger btn-sm ml-2" 
                      onclick="return confirm('Yakin ingin menghapus data?')">
                      Hapus
                      </button>
                  </form>
                  </td>
              </tr> 
            @endforeach 
          </tbody>
        </table>
      </div>
      {!! $pendaftaran->links() !!}
    </div>
</div> 
@endsection