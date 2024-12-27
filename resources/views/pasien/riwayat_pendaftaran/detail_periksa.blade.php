@extends('pasien.layout')

@section('content')
<div class="container-fluid px-5 mt-4 mb-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Detail Pemeriksaan Pasien</h4>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th>Poliklinik</th>
                        <td>{{ $pendaftaran->jadwal->dokter->poli->nama_poli }}</td>
                    </tr>
                    <tr>
                        <th>Dokter</th>
                        <td>{{ $pendaftaran->jadwal->dokter->nama }}</td>
                    </tr>
                    <tr>
                        <th>Hari</th>
                        <td>{{ $pendaftaran->jadwal->hari }}</td>
                    </tr>
                    <tr>
                        <th>Jam Mulai</th>
                        <td>{{ $pendaftaran->jadwal->jam_mulai }}</td>
                    </tr>
                    <tr>
                        <th>Jam Selesai</th>
                        <td>{{ $pendaftaran->jadwal->jam_selesai }}</td>
                    </tr>
                    <tr>
                        <th>No Antrian</th>
                        <td>{{ $pendaftaran->no_antrian }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if ($pendaftaran->status_periksa == 0)
                                <span class="badge bg-danger">Belum Diperiksa</span>
                            @elseif ($pendaftaran->status_periksa == 1)
                                <span class="badge bg-success">Sudah Diperiksa</span>
                            @else
                                <span class="badge bg-secondary">Status Tidak Diketahui</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

            @if ($pendaftaran->status_periksa == 1)
                <hr>
                <h5 class="mb-4">Informasi Pemeriksaan</h5>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>Tanggal Periksa</th>
                            <td>{{ $periksa->tgl_periksa }}</td>
                        </tr>
                        <tr>
                            <th>Catatan Dokter</th>
                            <td>{{ $periksa->catatan }}</td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <h5 class="mb-3">Obat yang Diberikan</h5>
                <ul class="list-group mb-4">
                    @foreach ($periksa->detailPeriksa as $index => $detail)
                        <li class="list-group-item">{{ $index + 1 }}. {{ $detail->obat->nama_obat }}</li>
                    @endforeach
                </ul>

                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Biaya Pemeriksaan</h5>
                        <h1 class="card-text">Rp {{ number_format($periksa->biaya_periksa, 2, ',', '.') }}</h1>
                    </div>
                </div>
            @endif
        </div>

        <!-- Tombol Kembali di bagian bawah card -->
        <div class="card-footer">
            <a href="{{ route('riwayat_pendaftaran.index') }}" class="btn btn-secondary w-100">Kembali</a>
        </div>

    </div>
</div>
@endsection
