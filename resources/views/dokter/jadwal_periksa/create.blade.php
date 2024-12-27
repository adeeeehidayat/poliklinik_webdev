@extends('dokter.layout')

@section('content')
<div class="container-fluid px-5 mt-4 mb-4">
    <h1 class="mt-4">Tambah Jadwal Periksa</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Jadwal Periksa</li>
    </ol>
    <form id="jadwalForm" action="{{ route('jadwal_periksa.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf
        <div class="mb-3">
            <label for="hari">Hari</label>
            <div class="input-group">
                <select name="hari" class="form-control" id="hari" required>
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
                <div class="invalid-feedback">
                    Hari harus dipilih.
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="jam_mulai">Jam Mulai</label>
            <div class="input-group">
                <input type="time" name="jam_mulai" class="form-control" id="jam_mulai" value="{{ old('jam_mulai') }}" required>
                <div class="invalid-feedback">
                    Jam mulai harus diisi.
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="jam_selesai">Jam Selesai</label>
            <div class="input-group">
                <input type="time" name="jam_selesai" class="form-control" id="jam_selesai" value="{{ old('jam_selesai') }}" required>
                <div class="invalid-feedback">
                    Jam selesai harus diisi.
                </div>
            </div>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-primary" id="submitBtn">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('jadwal_periksa.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Jadwal Periksa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin semua data sudah benar dan ingin menambah jadwal periksa ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmSubmit">Ya, Benar</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Validasi form
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()

    // Konfirmasi sebelum submit
    document.getElementById('submitBtn').addEventListener('click', function() {
        var form = document.getElementById ('jadwalForm');
        if (form.checkValidity()) {
            var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            confirmationModal.show();
        } else {
            form.classList.add('was-validated');
        }
    });

    document.getElementById('confirmSubmit').addEventListener('click', function() {
        document.getElementById('jadwalForm').submit();
    });
</script>
@endsection