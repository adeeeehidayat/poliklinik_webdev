@extends('dokter.layout')

@section('content')
<div class="container-fluid px-5 mt-4 mb-4">
    <h2>Edit Pemeriksaan Pasien</h2>
    <div class="card">
        <div class="card-body">
        <form action="{{ route('daftar_pasien.updateSudahDiperiksa', $pendaftaran->id) }}" method="POST">
            @csrf
            <!-- Nama Pasien (Tidak Bisa Diedit) -->
            <div class="mb-3">
                <label for="nama_pasien" class="form-label">Nama Pasien</label>
                <input type="text" class="form-control" id="nama_pasien" value="{{ $pendaftaran->pasien->nama }}" disabled>
            </div>

            <!-- Input Tanggal Periksa -->
            <div class="mb-3">
                <label for="tanggal_periksa" class="form-label">Tanggal Periksa</label>
                <input type="date" class="form-control" id="tanggal_periksa" name="tanggal_periksa" value="{{ $periksa->tgl_periksa }}">
            </div>

            <!-- Input Catatan -->
            <div class="mb-3">
                <label for="catatan" class="form-label">Catatan</label>
                <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ $periksa->catatan }}</textarea>
            </div>

            <!-- Pilih Obat -->
            <div class="form-group">
                <label for="obat">Obat yang diberikan</label><br>
                @foreach ($obat as $item)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="obat[]" value="{{ $item->id }}" data-harga="{{ $item->harga }}"
                            @if(in_array($item->id, $periksa->detailPeriksa->pluck('id_obat')->toArray())) checked @endif>
                        <label class="form-check-label">
                            {{ $item->nama_obat }} - Rp. {{ number_format($item->harga, 0, ',', '.') }}
                        </label>
                    </div>
                @endforeach
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
                <button type="submit" class="btn btn-primary">
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

<!-- Script untuk menghitung biaya obat dan total -->
<script>
    const obatCheckboxes = document.querySelectorAll('input[name="obat[]"]');
    const biayaObatInput = document.getElementById('biaya_obat');
    const biayaJasaDokterInput = document.getElementById('biaya_jasa_dokter');
    const biayaTotalInput = document.getElementById('biaya_total');
    const biayaPeriksaInput = document.getElementById('biaya_periksa');
    const biayaJasaDokter = 150000; // Biaya jasa dokter tetap

    // Hitung biaya saat checkbox berubah
    function updateBiaya() {
        let totalBiayaObat = 0;
        obatCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                totalBiayaObat += parseInt(checkbox.getAttribute('data-harga')); // Ambil harga dari data-harga
            }
        });

        // Update biaya obat
        biayaObatInput.value = "Rp. " + totalBiayaObat.toLocaleString();

        // Update total biaya
        let totalBiaya = totalBiayaObat + biayaJasaDokter;
        biayaTotalInput.value = "Rp. " + totalBiaya.toLocaleString();

        // Update biaya_periksa
        biayaPeriksaInput.value = totalBiaya;
    }

    // Inisialisasi biaya awal
    updateBiaya();

    // Event listener
    obatCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBiaya);
    });
</script>
@endsection
