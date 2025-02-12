@if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('user'))

@extends('layouts.app_modern', ['title' => 'Data Peserta'])

@section('content')
<div class="card">
    <h3 class="card-header">Data Peserta</h5>
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
                <th>Link Group</th>
            </tr>
        </thead>
        <tbody>
            {{-- Filter data berdasarkan role --}}
            @php
            $filteredPeserta = auth()->user()->hasRole('user') 
                ? $pesertas->filter(fn($item) => $item->transaksi->pendaftaran && $item->transaksi->pendaftaran->user_id === auth()->id()) 
                : $pesertas;
            @endphp

            {{-- Tampilkan data pendaftaran --}}
            {{-- @foreach ($filteredPendaftaran as $item) --}}
            @foreach($filteredPeserta as $peserta)
                <tr>
                    <td>{{ $peserta->transaksi->kd_transaksi }}</td>
                    <td>{{ $peserta->transaksi->pendaftaran->nama }}</td>
                    <td>{{ $peserta->transaksi->pendaftaran->jadwal->skema->nama_skema }}</td>
                    <td>{{ $peserta->transaksi->pendaftaran->jadwal->tgl_ujian }}</td>
                    {{-- <td>{{ $peserta->transaksi->pendaftaran->jadwal->link_group }}</td> --}}
                    <td>
                        @if ($peserta->transaksi->pendaftaran->jadwal->link_group)
                            <a href="{{ $peserta->transaksi->pendaftaran->jadwal->link_group }}" target="_blank" class="btn btn-success btn-sm">
                                Join Group
                            </a>
                        @else
                            <span class="text-muted">No Link Available</span>
                        @endif
                    </td>
                    
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

@endif