@extends('dokter.layout')

@section('content')
<div class="container-fluid px-5 mt-4">
    <h1 class="mb-4">Jadwal Periksa</h1>

    <!-- Card for Warning -->
    <div class="alert alert-warning" role="alert">
        Pada saat hari H jadwal periksa, Dokter tidak diperbolehkan mengubah hari maupun jam periksanya.
    </div>

    <a href="{{ route('jadwal_periksa.create') }}" class="btn btn-success mb-3">Tambah Jadwal</a>

    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-dark">
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
            @if ($jadwalPeriksa->isNotEmpty())
                @foreach ($jadwalPeriksa as $index => $jadwal)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $jadwal->dokter->nama ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $jadwal->hari }}</td>
                        <td>{{ $jadwal->jam_mulai }}</td>
                        <td>{{ $jadwal->jam_selesai }}</td>
                        <td>{{ $jadwal->status === 'Y' ? 'Aktif' : 'Tidak Aktif' }}</td>
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
                                <button class="btn btn-secondary btn-sm" disabled>Edit</button>
                            @else
                                <a href="{{ route('jadwal_periksa.edit', $jadwal->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            @endif

                            <form action="{{ route('jadwal_periksa.destroy', $jadwal->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        <i class="fas fa-info-circle"></i> Belum ada data jadwal periksa.
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
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
