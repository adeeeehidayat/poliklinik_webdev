@extends('pasien.layout')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Riwayat Pendaftaran Poli</h4>
        </div>
        <div class="card-body">
            @if($riwayatPendaftaran->isEmpty())
                <p class="text-center">Anda belum mendaftar ke poli manapun.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Poliklinik</th>
                                <th>Dokter</th>
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Keluhan</th>
                                <th>Antrian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayatPendaftaran as $index => $pendaftaran)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pendaftaran->jadwal->dokter->poli->nama_poli }}</td>
                                    <td>{{ $pendaftaran->jadwal->dokter->nama }}</td>
                                    <td>{{ $pendaftaran->jadwal->hari }}</td>
                                    <td>{{ $pendaftaran->jadwal->jam_mulai }}</td>
                                    <td>{{ $pendaftaran->jadwal->jam_selesai }}</td>
                                    <td>{{ $pendaftaran->keluhan }}</td>
                                    <td>{{ $pendaftaran->no_antrian }}</td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm">Detail</a>
                                        <!-- Tindakan lain seperti batal pendaftaran bisa ditambahkan disini -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
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
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="window.location.href='{{ route('riwayat_pendaftaran.index') }}'">OK</button>
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
