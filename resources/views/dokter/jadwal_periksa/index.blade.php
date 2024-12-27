@extends('dokter.layout')

@section('content')
<div class="container-fluid px-5 mt-4 mb-4">
    <h1 class="mb-4">Jadwal Periksa</h1>
    <p>Berikut adalah daftar jadwal periksa <strong>{{ session('dokter')->nama }}</strong></p>

    <a href="{{ route('jadwal_periksa.create') }}" class="btn btn-primary mb-3 mt-4">
        <i class="fas fa-plus"></i> Tambah Jadwal
    </a>

    <div class="card shadow-sm">
        <div class="card-body">
            @if ($jadwalPeriksa->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Dokter</th>
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwalPeriksa as $index => $jadwal)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $jadwal->dokter->nama ?? 'Tidak Diketahui' }}</td>
                                    <td>{{ $jadwal->hari }}</td>
                                    <td>{{ $jadwal->jam_mulai }}</td>
                                    <td>{{ $jadwal->jam_selesai }}</td>
                                    <td>
                                        @if ($jadwal->status === 'Y')
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $hariIndonesia = [
                                                'Monday' => 'Senin',
                                                'Tuesday' => 'Selasa',
                                                'Wednesday' => 'Rabu',
                                                'Thursday' => 'Kamis',
                                                'Friday' => 'Jumat',
                                                'Saturday' => 'Sabtu',
                                                'Sunday' => 'Minggu'
                                            ];
                                            $hariIni = $hariIndonesia[\Carbon\Carbon::now()->format('l')];
                                        @endphp

                                        @if ($jadwal->hari === $hariIni)
                                            <button class="btn btn-secondary btn-sm" disabled>
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                        @else
                                            <a href="{{ route('jadwal_periksa.edit', $jadwal->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        @endif

                                        <!--
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $jadwal->id }}">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                        -->

                                        <!-- Modal Konfirmasi Hapus 
                                        <div class="modal fade" id="deleteModal{{ $jadwal->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus jadwal periksa untuk dokter <strong>{{ $jadwal->dokter->nama }}</strong> pada hari <strong>{{ $jadwal->hari }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <form action="{{ route('jadwal_periksa.destroy', $jadwal->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </ </div>
            @else
                <p class="text-center text-muted">
                    <i class="fa fa-info-circle"></i> Belum ada data jadwal periksa.
                </p>
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
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="window.location.href='{{ route('jadwal_periksa.index') }}'">OK</button>
                </div>
            </div>
        </div>
    </div>
@endif

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
    window.addEventListener('DOMContentLoaded', (event) => {
        if (document.getElementById('successModal')) {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        }

        if (document.getElementById('errorModal')) {
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        }
    });
</script>
@endsection