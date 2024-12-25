@extends('dokter.layout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard Dokter</h1>
    <p>Selamat datang <strong>{{ session('dokter')->nama }}</strong> di dashboard dokter poliklinik UDINUS.</p>

    <div class="row">
        <!-- Card untuk jumlah pasien yang sudah diperiksa -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body d-flex justify-content-between">
                    <h1 class="card-title">{{ $pasienSudahDiperiksa }}</h1>
                    <i class="fas fa-check-circle fa-3x"></i> <!-- Icon untuk Pasien yang Sudah Diperiksa -->
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Sudah Diperiksa</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Card untuk jumlah pasien yang belum diperiksa -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-danger text-white">
                <div class="card-body d-flex justify-content-between">
                    <h1 class="card-title">{{ $pasienBelumDiperiksa }}</h1>
                    <i class="fas fa-times-circle fa-3x"></i> <!-- Icon untuk Pasien yang Belum Diperiksa -->
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Belum Diperiksa</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Card untuk jumlah jadwal periksa -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-dark text-white">
                <div class="card-body d-flex justify-content-between">
                    <h1 class="card-title">{{ $jumlahJadwal }}</h1>
                    <i class="fas fa-calendar-check fa-3x"></i> <!-- Icon untuk Jadwal Periksa -->
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Jadwal Periksa</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
