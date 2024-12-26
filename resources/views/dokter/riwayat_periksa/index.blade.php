@extends('dokter.layout')

@section('content')
<div class="container-fluid px-5 mt-4">
    <h1 class="mb-4">Riwayat Periksa</h1>
    <p>Berikut adalah daftar riwayat periksa pasien di <strong>{{ session('dokter')->nama }}</strong></p>

    <div class="card shadow-sm mt-4">
        <div class="card-body">
            @if ($daftarPasien->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
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
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-muted">
                    <i class="fa fa-info-circle"></i> Belum ada data pasien yang pernah diperiksa.
                </p>
            @endif
        </div>
    </div>
</div>
@endsection
