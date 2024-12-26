@extends('dokter.layout')

@section('content')
<div class="container-fluid px-5 mt-4">
    <h1 class="mb-4">Riwayat Pemeriksaan Pasien</h1>
    <p>Berikut adalah riwayat pemeriksaan untuk pasien</p>

    @if ($riwayatPeriksa->isNotEmpty())
        <div class="mb-4">
            <table class="table table-sm table-borderless" style="table-layout: auto;">
                <tbody>
                    <tr>
                        <td style="width: 1%; white-space: nowrap;"><strong>Nama</strong></td>
                        <td>: {{ $riwayatPeriksa->first()->daftarPoli->pasien->nama }}</td>
                    </tr>
                    <tr>
                        <td style="width: 1%; white-space: nowrap;"><strong>No. RM</strong></td>
                        <td>: {{ $riwayatPeriksa->first()->daftarPoli->pasien->no_rm }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Tanggal Periksa</th>
                    <th>Catatan</th>
                    <th>Keluhan</th>
                    <th>Biaya Periksa</th>
                    <th>Obat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayatPeriksa as $item)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($item->tgl_periksa)->format('d F Y') }}</td>
                        <td>{{ $item->catatan ?? 'Tidak ada catatan' }}</td>
                        <td>{{ $item->daftarPoli->keluhan ?? 'Tidak ada keluhan' }}</td>
                        <td>Rp {{ number_format($item->biaya_periksa, 0, ',', '.') }}</td>
                        <td>
                            @foreach ($item->detailPeriksa as $detail)
                                <span class="badge bg-success">{{ $detail->obat->nama_obat }}</span><br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="alert alert-warning">Pasien ini belum memiliki riwayat pemeriksaan.</p>
    @endif

    <div class="d-flex justify-content-end">
        <a href="{{ route('riwayat_periksa.index') }}" class="btn btn-secondary btn-lg">Kembali</a>
    </div>
</div>
@endsection
