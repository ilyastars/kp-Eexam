@extends('layouts.app_modern', ['title' => 'Data Transaksi']) 
@section('content') 
<div class="card">
  <h5 class="card-header">Data Transaksi</h5>
    <div class="card-body">
      {{-- <h3>Data transaksi</h3> --}}
      <a href="/transaksi/create" class="btn btn-primary">Tambah Data</a>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>NO</th>
            <th>Kode Transaksi</th>
            <th>Tanggal Bayar</th>
            <th>Status Bayar</th>
            <th>Id Pendaftaran</th>
            <th>Id Skema</th>
            <th>AKSI</th>
          </tr>
        </thead>
        <tbody> 
            @foreach ($transaksi as $item) 
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kd_transaksi }}</td>
                <td>{{ $item->tgl_bayar }}</td>
                <td>{{ $item->status_bayar }}</td>
                <td>{{ $item->pendaftaran_id }}</td>
                <td>{{ $item->skema_id }}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                <a href="/transaksi/{{ $item->id }}/edit" class="btn btn-warning btn-sm">
                    Edit
                </a>
                <form action="/transaksi/{{ $item->id }}" method="post" class="d-inline">
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
      {!! $transaksi->links() !!}
    </div>
</div> 
@endsection