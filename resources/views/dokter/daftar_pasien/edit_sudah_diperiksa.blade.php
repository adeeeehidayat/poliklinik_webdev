@extends('dokter.layout')

@section('content')
<div class="container-fluid px-5 mt-4 mb-4">
    <h2>Edit Pemeriksaan Pasien</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('daftar_pasien.updateSudahDiperiksa', $pendaftaran->id) }}" method="POST" id="formPendaftaran">
                @csrf
                <!-- Nama Pasien (Tidak Bisa Diedit) -->
                <div class="mb-3">
                    <label for="nama_pasien" class="form-label">Nama Pasien</label>
                    <input type="text" class="form-control" id="nama_pasien" value="{{ $pendaftaran->pasien->nama }}" disabled>
                </div>

                <!-- Input Tanggal Periksa -->
                <div class="mb-3">
                    <label for="tanggal_periksa" class="form-label">Tanggal Periksa</label>
                    <input type="date" class="form-control" id="tanggal_periksa" name="tanggal_periksa" value="{{ $periksa->tgl_periksa }}" required>
                    <div class="invalid-feedback">Tanggal periksa harus diisi.</div>
                </div>

                <!-- Input Catatan -->
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="3" required>{{ $periksa->catatan }}</textarea>
                    <div class="invalid-feedback">Catatan harus diisi.</div>
                </div>

                <!-- Pilih Obat -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Pilih Obat</h5>
                        <!-- Search Bar untuk mencari obat -->
                        <input type="text" class="form-control" id="search-obat" placeholder="Cari obat...">
                    </div>
                    <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                        <!-- Daftar Obat dengan checkbox -->
                        <div id="obat">
                            @foreach ($obat as $item)
                                <div class="form-check obat-item">
                                    <input class="form-check-input" type="checkbox" name="obat[]" value="{{ $item->id }}" data-harga="{{ $item->harga }}"
                                        @if(in_array($item->id, $periksa->detailPeriksa->pluck('id_obat')->toArray())) checked @endif>
                                    <label class="form-check-label">
                                        {{ $item->nama_obat }} - Rp. {{ number_format($item->harga, 0, ',', '.') }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="invalid-feedback">
                            Pilih minimal satu obat.
                        </div>
                    </div>
                </div>

                <!-- Biaya Obat dan Jasa Dokter -->
                <div class="mb-3">
                    <label for="biaya_obat" class="form-label">Biaya Obat</label>
                    <input type="text" class="form-control" id="biaya_obat" value="Rp. 0" disabled>
                </div>

                <div class="mb-3">
                    <label for="biaya_jasa_dokter" class="form-label">Biaya Jasa Dokter</label>
                    <input type="text" class="form-control" id="biaya_jasa_dokter" value="Rp. 150.000" disabled>
                </div>

                <div class="mb-3">
                    <label for="biaya_total" class="form-label">Biaya Total</label>
                    <input type="text" class="form-control" id="biaya_total" value="Rp. 150.000" disabled>
                </div>

                <!-- Input Tersembunyi untuk Biaya Pemeriksaan -->
                <input type="hidden" id="biaya_periksa" name="biaya_periksa" value="0">

                <!-- Button Simpan dan Batal -->
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" id="submitButton">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('daftar_pasien.index') }}" class="btn btn-secondary ms-2">
                        <i class="fas fa-times"></i> Batal
                    </a>
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
                <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Pemeriksaan</h5>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin data yang dimasukkan sudah benar?</p>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th scope="row">Tanggal Periksa</th>
                            <td id="confirmTanggalPeriksa"></td>
                        </tr>
                        <tr>
                            <th scope="row">Catatan</th>
                            <td id="confirmCatatan"></td>
                        </tr>
                        <tr>
                            <th scope="row">Obat yang Dipilih</th>
                            <td id="confirmObat"></td>
                        </tr>
                        <tr>
                            <th scope="row">Biaya Obat</th>
                            <td id="confirmBiayaObat"></td>
                        </tr>
                        <tr>
                            <th scope="row">Biaya Jasa Dokter</th>
                            <td id="confirmBiayaJasaDokter"></td>
                        </tr>
                        <tr>
                            <th scope="row">Biaya Total</th>
                            <td id="confirmBiayaTotal"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="formPendaftaran" class="btn btn-primary">Konfirmasi</button>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk filter berdasarkan nama obat -->
<script>
    document.getElementById('search-obat').addEventListener('input', function() {
        var searchQuery = this.value.toLowerCase();
        var obatItems = document.querySelectorAll('.obat-item');

        obatItems.forEach(function(item) {
            var label = item.querySelector('label').textContent.toLowerCase();
            if (label.includes(searchQuery)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>

<!-- Script untuk menghitung biaya obat dan total -->
<script>
    const obatCheckboxes = document.querySelectorAll('input[name="obat[]"]');
    const biayaObatInput = document.getElementById('biaya_obat');
    const biayaJasaDokterInput = document.getElementById('biaya_jasa_dokter');
    const biayaTotalInput = document.getElementById('biaya_total');
    const biayaPeriksaInput = document.getElementById('biaya_periksa');
    const biayaJasaDokter = 150000; // Biaya jasa dokter tetap

    // Validasi sebelum menyimpan
    function validateForm() {
        let isValid = true;

        // Validasi Tanggal Periksa
        const tanggalPeriksa = document.getElementById('tanggal_periksa');
        if (!tanggalPeriksa.value) {
            tanggalPeriksa.classList.add('is-invalid');
            isValid = false;
        } else {
            tanggalPeriksa.classList.remove('is-invalid');
        }

        // Validasi Catatan
        const catatan = document.getElementById('catatan');
        if (!catatan.value) {
            catatan.classList.add('is-invalid');
            isValid = false;
        } else {
            catatan.classList.remove('is-invalid');
        }

        // Validasi Obat
        const selectedObat = document.querySelectorAll('input[name="obat[]"]:checked');
        if (selectedObat.length === 0) {
            obatCheckboxes.forEach(item => {
                item.classList.add('is-invalid');
            });
            isValid = false;
        } else {
            obatCheckboxes.forEach(item => {
                item.classList.remove('is-invalid');
            });
        }

        return isValid;
    }

    // Hitung biaya saat checkbox berubah
    function updateBiaya() {
        let totalBiayaObat = 0;
        let obatDipilih = [];
        
        obatCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                totalBiayaObat += parseInt(checkbox.getAttribute('data-harga')); // Ambil harga dari data-harga
                let obatName = checkbox.nextElementSibling.textContent.split(' - ')[0]; // Ambil nama obat
                obatDipilih.push(obatName);
            }
        });

        // Update biaya obat
        biayaObatInput.value = "Rp. " + totalBiayaObat.toLocaleString();

        // Update total biaya
        let totalBiaya = totalBiayaObat + biayaJasaDokter;
        biayaTotalInput.value = "Rp. " + totalBiaya.toLocaleString();

        // Update biaya_periksa
        biayaPeriksaInput.value = totalBiaya;

        // Update obat yang dipilih di modal
        document.getElementById('confirmObat').textContent = obatDipilih.length > 0 ? obatDipilih.join(', ') : 'Tidak ada obat yang dipilih';
    }

    // Inisialisasi biaya awal
    updateBiaya();

    // Event listener
    obatCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBiaya);
    });

    // Update modal dengan data inputan
    document.getElementById('submitButton').addEventListener('click', function(event) {
        // Validasi form
        if (!validateForm()) {
            event.preventDefault();  // Mencegah modal terbuka jika form tidak valid
        } else {
            // Tanggal Periksa
            document.getElementById('confirmTanggalPeriksa').textContent = document.getElementById('tanggal_periksa').value;

            // Catatan
            document.getElementById('confirmCatatan').textContent = document.getElementById('catatan').value;

            // Biaya Obat
            document.getElementById('confirmBiayaObat').textContent = biayaObatInput.value;

            // Biaya Jasa Dokter
            document.getElementById('confirmBiayaJasaDokter').textContent = biayaJasaDokterInput.value;

            // Biaya Total
            document.getElementById('confirmBiayaTotal').textContent = biayaTotalInput.value;

            // Tampilkan modal konfirmasi
            new bootstrap.Modal(document.getElementById('confirmationModal')).show();
        }
    });
</script>
@endsection
