@extends('layouts.app_modern', ['title' => 'Data Jadwal']) 
@section('content') 
<div class="card">
  <h5 class="card-header">Data Jadwal</h5>
    <div class="card-body">
      {{-- <h3>Data jadwal</h3> --}}
      <a href="/jadwal/create" class="btn btn-primary">Tambah Data</a>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>NO</th>
            <th>Kode Jadwal</th>
            <th>Tanggal Ujian</th>
            <th>Tempat Ujian</th>
            <th>Nama Skema</th>
            <th>Jadwal Dibuat</th>
            <th>AKSI</th>
          </tr>
        </thead>
        <tbody> 
            @foreach ($jadwal as $item) 
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kd_jadwal }}</td>
                <td>{{ $item->tgl_ujian }}</td>
                <td>{{ $item->tempat_ujian }}</td>
                <td>{{ $item->skema->nama_skema }}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                <a href="/jadwal/{{ $item->id }}/edit" class="btn btn-warning btn-sm">
                    Edit
                </a>
                <form action="/jadwal/{{ $item->id }}" method="post" class="d-inline">
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
      {!! $jadwal->links() !!}
    </div>
</div> 
@endsection