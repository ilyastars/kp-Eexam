@extends('layouts.app_modern')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                        <!-- Bagian Artikel Info Perusahaan -->
                        <div class="jumbotron mb-4">
                            <h1 class="display-4">Selamat Datang di Perusahaan Kami</h1>
                            <p class="lead">Kami menyediakan berbagai skema ujian untuk mendukung pengembangan keterampilan Anda.</p>
                            <hr class="my-4">
                            <p>Informasi lebih lanjut tentang perusahaan dan layanan kami dapat dilihat di bawah ini.</p>
                        </div>
                    
                        <!-- Bagian Info Skema Ujian -->
                        <div class="row">
                            @foreach ($skemas as $skema)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    @if($skema->foto)
                                    <img src="{{ asset('storage/' . $skema->foto) }}" class="card-img-top" alt="{{ $skema->nama_skema }}">
                                    @else
                                    <img src="{{ asset('images/default.jpg') }}" class="card-img-top" alt="Default Image">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $skema->nama_skema }}</h5>
                                        <p class="card-text">
                                            Level: {{ ucfirst($skema->level) }} <br>
                                            Harga: Rp {{ number_format($skema->harga, 2, ',', '.') }}
                                        </p>
                                        <a href="{{ route('pendaftaran.create', ['skema_id' => $skema->id]) }}" class="btn btn-primary">Daftar</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
