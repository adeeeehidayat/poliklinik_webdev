@extends('pasien.layout')

@section('content')
<div class="container-fluid px-5 mt-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Pendaftaran Poliklinik</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('daftar_poli.store') }}" method="POST">
                @csrf
                
                <!-- Nomor Rekam Medis -->
                <div class="mb-3">
                    <label for="no_rm" class="form-label">Nomor Rekam Medis</label>
                    <input type="text" class="form-control" id="no_rm" value="{{ session('pasien')->no_rm }}" disabled>
                </div>

                <!-- Dropdown Poli -->
                <div class="mb-3">
                    <label for="id_poli" class="form-label">Pilih Poli</label>
                    <select name="id_poli" id="id_poli" class="form-control" required>
                        <option value="" disabled selected>Pilih Poli</option>
                        @foreach($polis as $poli)
                            <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Dropdown Jadwal Dokter -->
                <div class="mb-3">
                    <label for="id_jadwal" class="form-label">Pilih Jadwal Dokter</label>
                    <select name="id_jadwal" id="id_jadwal" class="form-control" required>
                        <option value="" disabled selected>Pilih Jadwal</option>
                    </select>
                </div>

                <!-- Input Keluhan -->
                <div class="mb-3">
                    <label for="keluhan" class="form-label">Keluhan</label>
                    <textarea name="keluhan" id="keluhan" class="form-control" rows="3" required></textarea>
                </div>

                <!-- Tombol Daftar -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Script untuk mengupdate dropdown jadwal dokter berdasarkan pilihan poli
    document.getElementById('id_poli').addEventListener('change', function() {
        var poliId = this.value;
        var jadwalSelect = document.getElementById('id_jadwal');

        // Reset jadwal dropdown
        jadwalSelect.innerHTML = '<option value="" disabled selected>Pilih Jadwal</option>';

        // Ambil jadwal berdasarkan poli yang dipilih
        fetch(`/get-jadwal-dokter/${poliId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(jadwal => {
                    var option = document.createElement('option');
                    // Menampilkan nama dokter dan jadwal
                    option.value = jadwal.id;
                    option.textContent = `${jadwal.dokter.nama} | ${jadwal.hari} (${jadwal.jam_mulai} - ${jadwal.jam_selesai})`;
                    jadwalSelect.appendChild(option);
                });
            });
    });
</script>
@endsection
