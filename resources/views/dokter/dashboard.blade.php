@extends('dokter.layout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard Dokter</h1>
    <p>Selamat datang <strong>{{ session('dokter')->nama }}</strong> di dashboard dokter poliklinik UDINUS.</p>
</div>
@endsection
