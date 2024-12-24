@extends('pasien.layout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard Pasien</h1>
    <p>Selamat datang pasien <strong>{{ session('pasien')->nama }}</strong> di dashboard pasien poliklinik UDINUS.</p>
@endsection
