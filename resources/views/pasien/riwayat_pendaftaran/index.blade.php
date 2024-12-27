@extends('pasien.layout')

@section('content')
<div class="container-fluid px-5 mt-4 mb-4">
    <h2>Riwayat Pendaftaran Poli</h2>
    <p>Berikut daftar riwayat pendaftaran pasien <strong>{{ session('pasien')->nama }}</strong> di Poliklinik UDINUS</p>
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            @if($riwayatPendaftaran->isEmpty())
                <p class="text-center">Anda belum mendaftar ke poli manapun.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Poliklinik</th>
                                <th>Dokter</th>
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Antrian</th>
                                <th>Status</th>
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
                                    <td>{{ $pendaftaran->no_antrian }}</td>
                                    <td>
                                        @if ($pendaftaran->status_periksa == 0)
                                            <span class="badge bg-danger">Belum Diperiksa</span>
                                        @elseif ($pendaftaran->status_periksa == 1)
                                            <span class="badge bg-success">Sudah Diperiksa</span>
                                            <!-- Menambahkan tanggal pemeriksaan jika sudah diperiksa -->
                                            <p class="mt-2"><small><strong>{{ $pendaftaran->periksa->tgl_periksa ?? 'Tanggal tidak tersedia' }}</strong></span></p>
                                        @else
                                            <span class="badge bg-secondary">Status Tidak Diketahui</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('riwayat_pendaftaran.detail_periksa', ['id' => $pendaftaran->id]) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
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
