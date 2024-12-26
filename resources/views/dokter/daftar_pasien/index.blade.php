@extends('dokter.layout')

@section('content')
<div class="container-fluid px-5 mt-4">
    <h1 class="mb-4">Daftar Pasien</h1>
    <p>Berikut adalah pasien yang terdaftar di <strong>{{ session('dokter')->nama }}</strong></p>

    <div class="card shadow-sm mt-4">
        <div class="card-body">
            @if($daftarPoli->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Pasien</th>
                                <th>Keluhan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($daftarPoli as $index => $pendaftaran)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pendaftaran->pasien->nama }}</td>
                                    <td>{{ $pendaftaran->keluhan }}</td>
                                    <td>
                                        @if($pendaftaran->status_periksa == 0)
                                            <a href="{{ route('daftar_pasien.edit', $pendaftaran->id) }}" class="btn btn-danger btn-sm">Belum Diperiksa</a>
                                        @else
                                            <a href="{{ route('daftar_pasien.editSudahDiperiksa', $pendaftaran->id) }}" class="btn btn-success btn-sm">Sudah Diperiksa</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-muted">
                    <i class="fa fa-info-circle"></i> Belum ada data pasien yang terdaftar.
                </p>
            @endif
        </div>
    </div>
</div>

<!-- Modal for Success -->
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
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="window.location.href='{{ route('daftar_pasien.index') }}'">OK</button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Modal for Error -->
@if (session('error'))
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error!</h5>
            </div>
            <div class="modal-body">
                <i class="fas fa-exclamation-circle text-danger"></i> {{ session('error') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endif

<script>
    // Display success modal if exists
    window.addEventListener('DOMContentLoaded', () => {
        const successModal = document.getElementById('successModal');
        if (successModal) {
            const modal = new bootstrap.Modal(successModal);
            modal.show();
        }

        // Display error modal if exists
        const errorModal = document.getElementById('errorModal');
        if (errorModal) {
            const modal = new bootstrap.Modal(errorModal);
            modal.show();
        }
    });
</script>
@endsection
