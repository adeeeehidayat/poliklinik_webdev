@extends('dokter.layout')

@section('content')
<div class="container-fluid px-5 mt-4">
    <h1 class="mt-4">Edit Jadwal Periksa</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Jadwal Periksa</li>
    </ol>
    <form action="{{ route('jadwal_periksa.update', $jadwalPeriksa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3 position-relative">
            <label for="hari" class="form-label">Hari</label>
            <div class="input-group">
                <select name="hari" class="form-control" id="hari">
                    <option value="">Pilih Hari</option>
                    <option value="Senin" {{ $jadwalPeriksa->hari === 'Senin' ? 'selected' : '' }}>Senin</option>
                    <option value="Selasa" {{ $jadwalPeriksa->hari === 'Selasa' ? 'selected' : '' }}>Selasa</option>
                    <option value="Rabu" {{ $jadwalPeriksa->hari === 'Rabu' ? 'selected' : '' }}>Rabu</option>
                    <option value="Kamis" {{ $jadwalPeriksa->hari === 'Kamis' ? 'selected' : '' }}>Kamis</option>
                    <option value="Jumat" {{ $jadwalPeriksa->hari === 'Jumat' ? 'selected' : '' }}>Jumat</option>
                    <option value="Sabtu" {{ $jadwalPeriksa->hari === 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                    <option value="Minggu" {{ $jadwalPeriksa->hari === 'Minggu' ? 'selected' : '' }}>Minggu</option>
                </select>
                <span class="input-group-text">
                    <i class="fas fa-chevron-down"></i>
                </span>
            </div>
        </div>
        <div class="mb-3">
            <label for="jam_mulai">Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" id="jam_mulai" value="{{ $jadwalPeriksa->jam_mulai }}">
        </div>
        <div class="mb-3">
            <label for="jam_selesai">Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control" id="jam_selesai" value="{{ $jadwalPeriksa->jam_selesai }}">
        </div>
        <div class="mb-3">
            <label for="status">Status</label>
            <select name="status" class="form-control" id="status">
                <option value="Y" {{ $jadwalPeriksa->status === 'Y' ? 'selected' : '' }}>Aktif</option>
                <option value="N" {{ $jadwalPeriksa->status === 'N' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Perbarui
            </button>
            <a href="{{ route('jadwal_periksa.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>
@endsection
