@extends('dokter.layout')

@section('content')
<div class="container-fluid px-5 mt-4">
    <h1 class="mb-4">Riwayat Periksa</h1>
    <p>Berikut adalah daftar riwayat periksa pasien di <strong>{{ session('dokter')->nama }}</strong></p>

    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. KTP</th>
                <th>No. HP</th>
                <th>No. RM</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($daftarPasien->isNotEmpty())
                @foreach ($daftarPasien as $item)
                    <tr>
                        <td>{{ $item->pasien->nama }}</td>
                        <td>{{ $item->pasien->alamat }}</td>
                        <td>{{ $item->pasien->no_ktp }}</td>
                        <td>{{ $item->pasien->no_hp }}</td>
                        <td>{{ $item->pasien->no_rm }}</td>
                        <td>
                            <a href="{{ route('riwayat_periksa.detail', $item->pasien->id) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i> Lihat Riwayat
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        <i class="fa fa-info-circle"></i> Belum ada data pasien yang pernah diperiksa.
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
