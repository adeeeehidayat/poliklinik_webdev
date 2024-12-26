@extends('pasien.layout')

@section('content')
<div class="container-fluid px-5 mt-4">
    <h1 class="mt-4">Dashboard Pasien</h1>
    <p class="mb-4">Selamat datang pasien <strong>{{ session('pasien')->nama }}</strong> di dashboard pasien poliklinik UDINUS.</p>

    <!-- Card untuk jumlah daftar periksa pasien -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body d-flex justify-content-between">
                    <h1 class="card-title">{{ $jumlahDaftarPeriksa }}</h1> <!-- Menampilkan jumlah daftar periksa -->
                    <i class="fas fa-calendar-check fa-3x"></i> <!-- Ikon untuk daftar periksa -->
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('riwayat_pendaftaran.index') }}">Riwayat Pendaftaran</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
@endsection
