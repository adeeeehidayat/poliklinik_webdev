@extends('dokter.layout')

@section('content')
<div class="container-fluid px-5 mt-4 mb-4">
    <h1 class="mt-4">Tambah Jadwal Periksa</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Jadwal Periksa</li>
    </ol>
    <form action="{{ route('jadwal_periksa.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="hari">Hari</label>
            <div class="input-group">
                <select name="hari" class="form-control" id="hari">
                    <option value="">Pilih Hari</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                    <option value="Minggu">Minggu</option>
                </select>
                <span class="input-group-text">
                    <i class="fas fa-chevron-down"></i>
                </span>
            </div>
        </div>
        <div class="mb-3">
            <label for="jam_mulai">Jam Mulai</label>
            <div class="input-group">
                <input type="time" name="jam_mulai" class="form-control" id="jam_mulai" value="{{ old('jam_mulai') }}">
            </div>
        </div>
        <div class="mb-3">
            <label for="jam_selesai">Jam Selesai</label>
            <div class="input-group">
                <input type="time" name="jam_selesai" class="form-control" id="jam_selesai" value="{{ old('jam_selesai') }}">
            </div>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('jadwal_periksa.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>
@endsection
