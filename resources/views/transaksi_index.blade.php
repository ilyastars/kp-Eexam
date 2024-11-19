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
                    <td>{{ $transaksi->status_bayar }}</td>
                    <td>
                        @if (auth()->user()->hasRole('admin'))
                            {{ $transaksi->bukti_bayar }}                            
                        @else
                            <input type="file" class="form-control" name="bukti_bayar" accept="image/*">
                        @endif
                            
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
