@extends('layouts.app_modern', ['title' => 'Invoice Pembayaran'])

@section('content')
<div class="container mt-2">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header text-center bg-primary text-white rounded-top-4">
            <h4 class="mb-0 text-white">Data Transaksi</h4>
        </div>
        <div class="card-body p-4">
            @if (auth()->user()->hasRole('user'))                
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-info text-center p-4 rounded-3">
                        <h5 class="fw-bold mb-3">Detail Pembayaran</h5>
                        <p class="mb-1"><strong>Bank:</strong> BCA</p>
                        <p class="mb-1"><strong>Atas Nama:</strong> PT Anugerah Komputer Indonesia</p>
                        <p class="mb-0"><strong>No Rek:</strong> 111-222-3333</p>
                    </div>
                </div>
            </div>
            @endif

            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>KD Transaksi</th>
                        <th>Nama Pendaftaran</th>
                        <th>Nama Skema</th>
                        <th>Tanggal Ujian</th>
                        <th>Harga</th>
                        <th>Status Bayar</th>
                        <th>Bukti Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksis as $transaksi)
                        <tr>
                            <td>{{ $transaksi->kd_transaksi }}</td>
                            <td>{{ $transaksi->pendaftaran->nama }}</td>
                            <td>{{ $transaksi->pendaftaran->jadwal->skema->nama_skema }}</td>
                            <td>{{ $transaksi->pendaftaran->jadwal->tgl_ujian }}</td>
                            <td>{{ number_format($transaksi->pendaftaran->jadwal->skema->harga, 0, ',', '.') }}</td>
                            <td>
                                @if (auth()->user()->hasRole('admin'))
                                    <form id="updateStatusForm" onsubmit="return confirm('Are you sure you want to change the status?');" method="POST" action="{{ route('transaksi.updateStatus', $transaksi->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status_bayar" class="form-control">
                                            <option value="pending" {{ $transaksi->status_bayar == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="completed" {{ $transaksi->status_bayar == 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                        <button type="submit" class="btn btn-success mt-2">Update Status</button>
                                    </form>
                                @else    
                                    <span class="fw-bold {{ $transaksi->status_bayar == 'completed' ? 'text-success' : 'text-danger' }}">
                                        {{ ucfirst($transaksi->status_bayar) }}
                                    </span>                        
                                @endif
                            </td>
                            <td>
                                @if (auth()->user()->hasRole('admin'))
                                    @if ($transaksi->bukti_bayar)
                                        <a href="{{ asset('storage/' . $transaksi->bukti_bayar) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $transaksi->bukti_bayar) }}" alt="Bukti Bayar" style="width: 100px; height: auto;">
                                        </a>
                                    @else
                                        <span>No file uploaded</span>
                                    @endif
                                @else
                                    @if ($transaksi->bukti_bayar)
                                        <a href="{{ asset('storage/' . $transaksi->bukti_bayar) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $transaksi->bukti_bayar) }}" alt="Bukti Bayar" style="width: 100px; height: auto;">
                                        </a>
                                        <form method="POST" action="{{ route('transaksi.uploadBuktiBayar', $transaksi->id) }}" enctype="multipart/form-data" class="mt-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="file" class="form-control" name="bukti_bayar" accept="image/*">
                                            <button type="submit" class="btn btn-secondary mt-2">Edit Bukti Bayar</button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('transaksi.uploadBuktiBayar', $transaksi->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <input type="file" class="form-control" name="bukti_bayar" accept="image/*" required>
                                            <button type="submit" class="btn btn-primary mt-2">Upload Bukti Bayar</button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
