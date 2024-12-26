@extends('dokter.layout')

@section('content')
<div class="container-fluid px-5 mt-4">
    <!-- Profil Dokter Section -->
    <div class="bg-light shadow-sm p-4 rounded-lg">
        <div class="mb-4">
            <h4 class="text-primary font-weight-bold">Profil Dokter</h4>
        </div>

        <!-- Nama -->
        <div class="row mb-3">
            <div class="col-md-3">
                <strong>Nama</strong>
            </div>
            <div class="col-md-9">
                <p class="mb-0">{{ $dokter->nama }}</p>
            </div>
        </div>

        <!-- Username -->
        <div class="row mb-3">
            <div class="col-md-3">
                <strong>Username</strong>
            </div>
            <div class="col-md-9">
                <p class="mb-0">{{ $dokter->username }}</p>
            </div>
        </div>

        <!-- Alamat -->
        <div class="row mb-3">
            <div class="col-md-3">
                <strong>Alamat</strong>
            </div>
            <div class="col-md-9">
                <p class="mb-0">{{ $dokter->alamat }}</p>
            </div>
        </div>

        <!-- No HP -->
        <div class="row mb-3">
            <div class="col-md-3">
                <strong>No HP</strong>
            </div>
            <div class="col-md-9">
                <p class="mb-0">{{ $dokter->no_hp }}</p>
            </div>
        </div>

        <!-- Poli -->
        <div class="row mb-3">
            <div class="col-md-3">
                <strong>Poli</strong>
            </div>
            <div class="col-md-9">
                <p class="mb-0">{{ $dokter->poli ? $dokter->poli->nama_poli : 'Tidak ada poli yang terkait' }}</p>
            </div>
        </div>

        <!-- Password -->
        <div class="row mb-3">
            <div class="col-md-3">
                <strong>Password</strong>
            </div>
            <div class="col-md-9">
                <p class="mb-0">{{ $dokter->password }}</p>
            </div>
        </div>

        <!-- Button Edit -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('profil_dokter.edit') }}" class="btn btn-warning btn-lg">
                <i class="fas fa-edit"></i> Edit Profil
            </a>
        </div>
    </div>
</div>

<!-- Modal Success -->
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
