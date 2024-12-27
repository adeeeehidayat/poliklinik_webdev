@extends('pasien.layout')

@section('content')
<div class="container-fluid px-5 mt-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Pendaftaran Poliklinik</h4>
        </div>
        <div class="card-body">
            <form id="formPendaftaran" action="{{ route('daftar_poli.store') }}" method="POST">
                @csrf
                
                <!-- Nomor Rekam Medis -->
                <div class="mb-3">
                    <label for="no_rm" class="form-label">Nomor Rekam Medis</label>
                    <input type="text" class="form-control" id="no_rm" value="{{ session('pasien')->no_rm }}" disabled>
                </div>

                <!-- Dropdown Poli -->
                <div class="mb-3">
                    <label for="id_poli" class="form-label">Pilih Poli</label>
                    <div class="input-group">
                        <select name="id_poli" id="id_poli" class="form-control" required>
                            <option value="" disabled selected>Pilih Poli</option>
                            @foreach($polis as $poli)
                                <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                            @endforeach
                        </select>
                        <span class="input-group-text">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                        <div class="invalid-feedback">Silakan pilih poli.</div>
                    </div>
                </div>

                <!-- Dropdown Jadwal Dokter -->
                <div class="mb-3">
                    <label for="id_jadwal" class="form-label">Pilih Jadwal Dokter</label>
                    <div class="input-group">
                        <select name="id_jadwal" id="id_jadwal" class="form-control" required>
                            <option value="" disabled selected>Pilih Jadwal</option>
                        </select>
                        <span class="input-group-text">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                        <div class="invalid-feedback">Silakan pilih jadwal dokter.</div>
                    </div>
                </div>

                <!-- Input Keluhan -->
                <div class="mb-3">
                    <label for="keluhan" class="form-label">Keluhan</label>
                    <textarea name="keluhan" id="keluhan" class="form-control" rows="3" required></textarea>
                    <div class="invalid-feedback">Silakan isi keluhan Anda.</div>
                </div>

                <!-- Tombol Daftar -->
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" id="openConfirmationModal">
                        <i class="fas fa-check-circle"></i> Daftar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Pendaftaran</h5>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin data yang dimasukkan sudah benar?</p>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th scope="row">Poli</th>
                            <td id="confirmPoli"></td>
                        </tr>
                        <tr>
                            <th scope="row">Jadwal</th>
                            <td id="confirmJadwal"></td>
                        </tr>
                        <tr>
                            <th scope="row">Keluhan</th>
                            <td id="confirmKeluhan"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="fas fa-times"></i> Batal
            </button>
            <button type="submit" form="formPendaftaran" class="btn btn-primary">
                <i class="fas fa-check"></i> Ya, Benar
            </button>
        </div>
        </div>
    </div>
</div>

<script>
    // Validasi form dan buka modal konfirmasi
    document.getElementById('openConfirmationModal').addEventListener('click', function () {
        const idPoli = document.getElementById('id_poli');
        const idJadwal = document.getElementById('id_jadwal');
        const keluhan = document.getElementById('keluhan');
        let isValid = true;

        // Reset validasi
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

        // Validasi Poli
        if (!idPoli.value) {
            isValid = false;
            idPoli.classList.add('is-invalid');
        }

        // Validasi Jadwal
        if (!idJadwal.value) {
            isValid = false;
            idJadwal.classList.add('is-invalid');
        }

        // Validasi Keluhan
        if (!keluhan.value.trim()) {
            isValid = false;
            keluhan.classList.add('is-invalid');
        }

        // Jika validasi lolos, tampilkan modal
        if (isValid) {
            document.getElementById('confirmPoli').textContent = idPoli.options[idPoli.selectedIndex].text;
            document.getElementById('confirmJadwal').textContent = idJadwal.options[idJadwal.selectedIndex]?.text || "Belum dipilih";
            document.getElementById('confirmKeluhan').textContent = keluhan.value.trim();

            const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            confirmationModal.show();
        }
    });

    // Update dropdown jadwal dokter saat poli dipilih
    document.getElementById('id_poli').addEventListener('change', function () {
        const poliId = this.value;
        const jadwalSelect = document.getElementById('id_jadwal');

        // Reset jadwal dropdown
        jadwalSelect.innerHTML = '<option value="" disabled selected>Pilih Jadwal</option>';

        // Fetch jadwal berdasarkan poli
        fetch(`/get-jadwal-dokter/${poliId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(jadwal => {
                    const option = document.createElement('option');
                    option.value = jadwal.id;
                    option.textContent = `${jadwal.dokter.nama} | ${jadwal.hari} (${jadwal.jam_mulai} - ${jadwal.jam_selesai})`;
                    jadwalSelect.appendChild(option);
                });
            });
    });
</script>
@endsection
