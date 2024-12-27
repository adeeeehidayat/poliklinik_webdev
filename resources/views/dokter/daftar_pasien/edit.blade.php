@extends('dokter.layout')

@section('content')
<div class="container-fluid px-5 mt-4 mb-4">
    <h2>Periksa Pasien</h2>
    <div class="card">
        <div class="card-body">
            <form id="formPeriksa" action="{{ route('daftar_pasien.simpan', $pendaftaran->id) }}" method="POST">
                @csrf
                <!-- Nama Pasien (Tidak Bisa Diedit) -->
                <div class="mb-3">
                    <label for="nama_pasien" class="form-label">Nama Pasien</label>
                    <input type="text" class="form-control" id="nama_pasien" value="{{ $pendaftaran->pasien->nama }}" disabled>
                </div>

                <!-- Input Tanggal Periksa -->
                <div class="mb-3">
                    <label for="tanggal_periksa" class="form-label">Tanggal Periksa</label>
                    <input type="date" class="form-control" id="tanggal_periksa" name="tanggal_periksa" required>
                    <div class="invalid-feedback">
                        Tanggal periksa harus diisi.
                    </div>
                </div>

                <!-- Input Catatan -->
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="3" required></textarea>
                    <div class="invalid-feedback">
                        Catatan harus diisi.
                    </div>
                </div>

                <!-- Pilih Obat -->
                <div class="mb-3">
                    <label for="obat" class="form-label">Pilih Obat</label>
                    <div id="obat">
                        @foreach ($obat as $item)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $item->id }}" id="obat{{ $item->id }}" name="obat[]" data-harga="{{ $item->harga }}">
                                <label class="form-check-label" for="obat{{ $item->id }}">
                                    {{ $item->nama_obat }} - Rp. {{ number_format($item->harga, 0, ',', '.') }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="invalid-feedback">
                        Setidaknya satu obat harus dipilih.
                    </div>
                </div>

                <!-- Biaya Obat dan Jasa Dokter -->
                <div class="mb-3">
                    <label for="biaya_obat" class="form-label">Biaya Obat</label>
                    <input type="text" class="form-control" id="biaya_obat_display" value="Rp. 0" readonly>
                    <input type="hidden" id="biaya_obat" name="biaya_obat" value="0">
                </div>

                <div class="mb-3">
                    <label for="biaya_jasa_dokter" class="form-label">Biaya Jasa Dokter</label>
                    <input type="text" class="form-control" id="biaya_jasa_dokter" value="Rp. 150.000" disabled>
                </div>

                <div class="mb-3">
                    <label for="biaya_total" class="form-label">Biaya Total</label>
                    <input type="text" class="form-control" id="biaya_total_display" value="Rp. 150.000" readonly>
                    <input type="hidden" id="biaya_total" name="biaya_total" value="150000">
                </div>

                <!-- Button Simpan dan Batal -->
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" id="btnSimpan">
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
<div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin data yang dimasukkan sudah benar?</p>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Tanggal Periksa</th>
                            <td id="tanggalPeriksaTabel"></td>
                        </tr>
                        <tr>
                            <th>Catatan</th>
                            <td id="catatanTabel"></td>
                        </tr>
                        <tr>
                            <th>Obat yang Dipilih</th>
                            <td id="obatTabel"></td>
                        </tr>
                        <tr>
                            <th>Biaya Obat</th>
                            <td id="biayaObatTabel"></td>
                        </tr>
                        <tr>
                            <th>Biaya Jasa Dokter</th>
                            <td>Rp. 150.000</td>
                        </tr>
                        <tr>
                            <th>Total Biaya</th>
                            <td id="biayaTotalTabel"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-primary" id="konfirmasiYa">Ya</button>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk menghitung biaya obat dan total -->
<script>
    // Variabel untuk elemen yang digunakan
    const obatCheckboxes = document.querySelectorAll('input[name="obat[]"]');
    const biayaObatInput = document.getElementById('biaya_obat');
    const biayaObatDisplay = document.getElementById('biaya_obat_display');
    const biayaTotalInput = document.getElementById('biaya_total');
    const biayaTotalDisplay = document.getElementById('biaya_total_display');
    const biayaJasaDokter = 150000;

    // Fungsi untuk menghitung biaya
    const hitungBiaya = () => {
        let totalBiayaObat = 0;

        obatCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                totalBiayaObat += parseInt(checkbox.getAttribute('data-harga'));
            }
        });

        // Perbarui input dan tampilan
        biayaObatInput.value = totalBiayaObat;
        biayaObatDisplay.value = `Rp. ${totalBiayaObat.toLocaleString()}`;
        const totalBiaya = totalBiayaObat + biayaJasaDokter;
        biayaTotalInput.value = totalBiaya;
        biayaTotalDisplay.value = `Rp. ${totalBiaya.toLocaleString()}`;
    };

    // Event listener untuk checkbox
    obatCheckboxes.forEach(checkbox => checkbox.addEventListener('change', hitungBiaya));

    // Event listener untuk tombol Simpan
    document.getElementById('btnSimpan').addEventListener('click', () => {
        // Validasi form
        const form = document.getElementById('formPeriksa');
        const tanggalPeriksa = document.getElementById('tanggal_periksa');
        const catatan = document.getElementById('catatan');
        const obatChecked = Array.from(obatCheckboxes).some(checkbox => checkbox.checked);

        // Reset invalid feedback
        tanggalPeriksa.classList.remove('is-invalid');
        catatan.classList.remove('is-invalid');
        obatCheckboxes.forEach(checkbox => checkbox.classList.remove('is-invalid'));
        const invalidFeedbacks = form.querySelectorAll('.invalid-feedback');
        invalidFeedbacks.forEach(feedback => feedback.style.display = 'none');

        let isValid = true;

        // Validasi Tanggal Periksa
        if (!tanggalPeriksa.value) {
            tanggalPeriksa.classList.add('is-invalid');
            tanggalPeriksa.nextElementSibling.style.display = 'block';
            isValid = false;
        }

        // Validasi Catatan
        if (!catatan.value) {
            catatan.classList.add('is-invalid');
            catatan.nextElementSibling.style.display = 'block';
            isValid = false;
        }

        // Validasi Obat
        if (!obatChecked) {
            obatCheckboxes.forEach(checkbox => checkbox.classList.add('is-invalid'));
            const obatFeedback = document.querySelector('#obat .invalid-feedback');
            obatFeedback.style.display = 'block';
            isValid = false;
        }

        // Jika valid, tampilkan modal konfirmasi
        if (isValid) {
            // Menampilkan data yang diisi di modal
            const tanggalPeriksaValue = tanggalPeriksa.value;
            const catatanValue = catatan.value;
            const selectedObats = Array.from(obatCheckboxes).filter(checkbox => checkbox.checked).map(checkbox => checkbox.nextElementSibling.textContent.trim());
            const totalBiayaObat = document.getElementById('biaya_obat_display').value;
            const totalBiaya = document.getElementById('biaya_total_display').value;

            document.getElementById('tanggalPeriksaTabel').textContent = tanggalPeriksaValue;
            document.getElementById('catatanTabel').textContent = catatanValue;
            document.getElementById('obatTabel').textContent = selectedObats.join(', ') || 'Tidak ada obat yang dipilih';
            document.getElementById('biayaObatTabel').textContent = totalBiayaObat;
            document.getElementById('biayaTotalTabel').textContent = totalBiaya;

            new bootstrap.Modal(document.getElementById('konfirmasiModal')).show();
        }
    });

    // Event listener untuk tombol Ya di modal
    document.getElementById('konfirmasiYa').addEventListener('click', () => {
        // Kirim form jika pengguna menekan Ya
        document.getElementById('formPeriksa').submit();
    });
</script>
@endsection
