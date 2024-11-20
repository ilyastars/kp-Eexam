@extends('layouts.app_modern', ['title' => 'Data Peserta'])

@section('content')
<div class="container">
    <h2>Data Peserta</h2>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>KD Peserta</th>
                <th>Nama</th>
                <th>Nama Skema</th>
                <th>Jadwal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesertas as $peserta)
                <tr>
                    <td>{{ $peserta->transaksi->kd_transaksi }}</td>
                    <td>{{ $peserta->transaksi->pendaftaran->nama }}</td>
                    <td>{{ $peserta->transaksi->pendaftaran->jadwal->skema->nama_skema }}</td>
                    <td>{{ $peserta->transaksi->pendaftaran->jadwal->tgl_ujian }}</td>
                    @if (auth()->user()->hasRole('admin'))
                      
                    <td>
                    <a href="/peserta/{{ $peserta->id }}/edit" class="btn btn-warning btn-sm">
                        Edit
                    </a>
                    <form action="/peserta/{{ $peserta->id }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-sm ml-2" 
                        onclick="return confirm('Yakin ingin menghapus data?')">
                        Hapus
                        </button>
                    </form>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
