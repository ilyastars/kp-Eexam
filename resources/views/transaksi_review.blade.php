@extends('layouts.app_modern', ['title' => 'Data Transaksi']) 
{{-- @extends('layouts.app') --}}

@section('content')
<div class="container">
    <h2>Data Transaksi</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>KD Transaksi</th>
                <th>Nama Pendaftaran</th>
                <th>Status Bayar</th>
                <th>Bukti Bayar</th>
                {{-- @if (auth()->user()->hasRole('user')) 
                    <div class="form-group">
                        <label for="bukti_bayar">Upload Bukti Bayar</label>
                        <input type="file" class="form-control" name="bukti_bayar" accept="image/*">
                    </div>
                @endif  --}}

            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $transaksi)
                <tr>
                    <td>{{ $transaksi->kd_transaksi }}</td>
                    <td>{{ $transaksi->pendaftaran->nama }}</td>
                    {{-- <td>{{ $transaksi->status_bayar }}</td> --}}
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
                            {{ $transaksi->status_bayar }}                        
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
                                    <input type="file" class="form-control" name="bukti_bayar" accept="image/*" required>
                                    <button type="submit" class="btn btn-primary mt-2">Edit Bukti Bayar</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('transaksi.uploadBuktiBayar', $transaksi->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    
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
@endsection
