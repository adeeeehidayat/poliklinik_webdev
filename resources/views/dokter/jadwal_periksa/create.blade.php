@extends('dokter.layout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Jadwal Periksa</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Obat</li>
    </ol>
    <form action="{{ route('jadwal_periksa.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="hari">Hari</label>
            <input type="text" name="hari" class="form-control" id="hari" value="{{ old('hari') }}">
        </div>
        <div class="mb-3">
            <label for="jam_mulai">Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" id="jam_mulai" value="{{ old('jam_mulai') }}">
        </div>
        <div class="mb-3">
            <label for="jam_selesai">Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control" id="jam_selesai" value="{{ old('jam_selesai') }}">
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('jadwal_periksa.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
