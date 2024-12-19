@extends('dokter.layout')

@section('content')
<div class="container mt-3">
    <div class="card shadow-lg rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Profil Dokter</h4>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3">
                    <strong>Nama</strong>
                </div>
                <div class="col-md-9">
                    <p>{{ $dokter->nama }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <strong>Username</strong>
                </div>
                <div class="col-md-9">
                    <p>{{ $dokter->username }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <strong>Alamat</strong>
                </div>
                <div class="col-md-9">
                    <p>{{ $dokter->alamat }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <strong>No HP</strong>
                </div>
                <div class="col-md-9">
                    <p>{{ $dokter->no_hp }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <strong>Poli</strong>
                </div>
                <div class="col-md-9">
                    <p>{{ $dokter->poli ? $dokter->poli->nama_poli : 'Tidak ada poli yang terkait' }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <strong>Password</strong>
                </div>
                <div class="col-md-9">
                    <p>{{ $dokter->password }}</p>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('profil_dokter.edit') }}" class="btn btn-warning btn-lg"><i class="fas fa-edit"></i> Edit Profil</a>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Berhasil!</h5>
                </div>
                <div class="modal-body">
                    <i class="fas fa-check-circle text-success"></i> {{ session('success') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="window.location.href='{{ route('profil_dokter.index') }}'">OK</button>
                </div>
            </div>
        </div>
    </div>
@endif

<script>
    // Menampilkan modal sukses setelah halaman selesai dimuat
    window.addEventListener('DOMContentLoaded', (event) => {
        if (document.getElementById('successModal')) {
            var myModal = new bootstrap.Modal(document.getElementById('successModal'));
            myModal.show();
        }
    });
</script>
@endsection
