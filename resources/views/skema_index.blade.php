@extends('layouts.app_modern', ['title' => 'Data Skema']) 
@section('content') 
<div class="card">
  <h5 class="card-header">Data Skema</h5>
    <div class="card-body">
      {{-- <h3>Data skema</h3> --}}
      <a href="/skema/create" class="btn btn-primary">Tambah Data</a>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>NO</th>
            <th>Kode Skema</th>
            <th>Nama</th>
            <th>Level</th>
            <th>Harga</th>
            <th>Tanggal Dibuat</th>
            <th>AKSI</th>
          </tr>
        </thead>
        <tbody> @foreach ($skema as $item) <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->kd_skema }}</td>
            <td>
              @if ($item->foto)
                <a href="{{ Storage::url($item->foto) }}" target="blank">
                  <img src="{{ Storage::url($item->foto) }}" width="50">
                </a>
              @endif
              {{ $item->nama_skema }}
            </td>
            <td>{{ $item->level }}</td>
            <td>{{ $item->harga }}</td>
            <td>{{ $item->created_at }}</td>
            <td>
              <a href="/skema/{{ $item->id }}/edit" class="btn btn-warning btn-sm">
                Edit
              </a>
              <form action="/skema/{{ $item->id }}" method="post" class="d-inline">
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
      {!! $skema->links() !!}
    </div>
</div> 
@endsection