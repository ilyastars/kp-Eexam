@extends('layouts.app_modern', ['title' => 'Data Peserta']) 
@section('content') 
<div class="card">
  <h5 class="card-header">Data Peserta</h5>
    <div class="card-body">
      {{-- <h3>Data peserta</h3> --}}
      <a href="/peserta/create" class="btn btn-primary">Tambah Data</a>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>NO</th>
            <th>Kode Pendaftaran</th>
            <th>Nama</th>
            <th>Nama Skema</th>
            <th>Jadwal Ujian</th>
            <th>Tgl Buat</th>
            <th>AKSI</th>
          </tr>
        </thead>
        <tbody> 
            @foreach ($peserta as $item) 
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->pendaftaran->kd_pendaftaran }}</td>
                <td>{{ $item->pendaftaran->nama }}</td>
                <td>{{ $item->pendaftaran->nama_skema }}</td>
                <td>{{ $item->jadwal->tgl_ujian }}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                <a href="/peserta/{{ $item->id }}/edit" class="btn btn-warning btn-sm">
                    Edit
                </a>
                <form action="/peserta/{{ $item->id }}" method="post" class="d-inline">
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
      {!! $peserta->links() !!}
    </div>
</div> 
@endsection