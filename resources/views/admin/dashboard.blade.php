@extends('admin.layout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard Admin</h1>
    <p>Selamat datang di dashboard admin poliklinik.</p>

    <div class="row">
        <!-- Card 1: Jumlah Pasien -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body d-flex justify-content-between">
                    <h1 class="card-title">{{ $jumlahPasien }}</h1>
                    <i class="fas fa-user-injured fa-3x"></i> <!-- Icon untuk Pasien -->
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('pasien.index') }}">Jumlah Pasien</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Card 2: Jumlah Dokter -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body d-flex justify-content-between">
                    <h1 class="card-title">{{ $jumlahDokter }}</h1>
                    <i class="fas fa-user-md fa-3x"></i> <!-- Icon untuk Dokter -->
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('dokter.index') }}">Jumlah Dokter</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Card 3: Jumlah Poli -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-dark mb-4">
                <div class="card-body d-flex justify-content-between">
                    <h1 class="card-title">{{ $jumlahPoli }}</h1>
                    <i class="fas fa-hospital fa-3x" style="color: #ffffff;"></i> <!-- Icon untuk Poli -->
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-dark stretched-link" href="{{ route('poli.index') }}">Jumlah Poli</a>
                    <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Card 4: Jumlah Obat -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body d-flex justify-content-between">
                    <h1 class="card-title">{{ $jumlahObat }}</h1>
                    <i class="fas fa-pills fa-3x"></i> <!-- Icon untuk Obat -->
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('obat.index') }}">Jumlah Obat</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
