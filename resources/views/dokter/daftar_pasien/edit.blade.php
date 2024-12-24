@extends('dokter.layout')

@section('content')
<div class="container-fluid px-5 mt-4 mb-5">
    <h2>Periksa Pasien</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('daftar_pasien.simpan', $pendaftaran->id) }}" method="POST">
                @csrf
                <!-- Nama Pasien (Tidak Bisa Diedit) -->
                <div class="mb-3">
                    <label for="nama_pasien" class="form-label">Nama Pasien</label>
                    <input type="text" class="form-control" id="nama_pasien" value="{{ $pendaftaran->pasien->nama }}" disabled>
                </div>

                <!-- Keluhan Pasien (Tidak Bisa Diedit) -->
                <div class="mb-3">
                    <label for="keluhan" class="form-label">Keluhan</label>
                    <input type="text" class="form-control" id="keluhan" value="{{ $pendaftaran->keluhan }}" disabled>
                </div>

                <!-- Input Tanggal Periksa -->
                <div class="mb-3">
                    <label for="tanggal_periksa" class="form-label">Tanggal Periksa</label>
                    <input type="date" class="form-control" id="tanggal_periksa" name="tanggal_periksa">
                </div>

                <!-- Input Catatan -->
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                </div>

                <!-- Pilih Obat -->
                <div class="mb-3">
                    <label for="obat" class="form-label">Pilih Obat</label>
                    <div id="obat">
                        @foreach ($obat as $item)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $item->id }}" id="obat{{ $item->id }}" name="obat[]" data-harga="{{ $item->harga }}">
                                <label class="form-check-label" for="obat{{ $item->id }}">
                                    {{ $item->nama_obat }} - Rp. {{ $item->harga }} 
                                </label>
                            </div>
                        @endforeach
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

                <!-- Button Simpan dan Batal -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('daftar_pasien.index') }}" class="btn btn-secondary ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script untuk menghitung biaya obat dan total -->
<script>
    // Fungsi untuk menghitung biaya
    const obatCheckboxes = document.querySelectorAll('input[name="obat[]"]');
    const biayaObatInput = document.getElementById('biaya_obat');
    const biayaJasaDokterInput = document.getElementById('biaya_jasa_dokter');
    const biayaTotalInput = document.getElementById('biaya_total');
    const biayaJasaDokter = 150000;

    // Hitung biaya saat checkbox berubah
    obatCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            let totalBiayaObat = 0;
            obatCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    totalBiayaObat += parseInt(checkbox.getAttribute('data-harga'));
                }
            });

            // Update biaya obat
            biayaObatInput.value = "Rp. " + totalBiayaObat.toLocaleString();

            // Update total biaya
            let totalBiaya = totalBiayaObat + biayaJasaDokter;
            biayaTotalInput.value = "Rp. " + totalBiaya.toLocaleString();
        });
    });
</script>
@endsection
