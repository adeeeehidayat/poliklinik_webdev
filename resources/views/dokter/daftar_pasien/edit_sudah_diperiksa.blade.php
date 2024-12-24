@extends('dokter.layout')

@section('content')
<div class="container-fluid px-4 mt-4">
    <h3>Edit Pemeriksaan Pasien (Sudah Diperiksa)</h3>

    <form action="{{ route('daftar_pasien.updateSudahDiperiksa', $pendaftaran->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_pasien" class="form-label">Nama Pasien</label>
            <input type="text" id="nama_pasien" class="form-control" value="{{ $pendaftaran->pasien->nama }}" disabled>
        </div>

        <div class="mb-3">
            <label for="tanggal_periksa" class="form-label">Tanggal Periksa</label>
            <input type="date" id="tanggal_periksa" name="tanggal_periksa" class="form-control" value="{{ $periksa->tgl_periksa }}">
        </div>

        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan</label>
            <textarea id="catatan" name="catatan" class="form-control">{{ $periksa->catatan }}</textarea>
        </div>

        <!-- Button Simpan dan Batal -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('daftar_pasien.index') }}" class="btn btn-secondary ms-2">Batal</a>
        </div>
    </form>
</div>
@endsection
