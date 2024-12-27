@extends('admin.layout')

@section('content')
<div class="container-fluid px-5 mt-4 mb-4">
    <h1 class="mt-4">Daftar Pasien</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pasien</li>
    </ol>
    <a href="{{ route('pasien.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Pasien
    </a>
    <div class="card shadow-sm">
        <div class="card-body">
            @if ($pasiens->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Alamat</th>
                                <th>No KTP</th>
                                <th>No HP</th>
                                <th>Password</th>
                                <th>No RM</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pasiens as $pasien)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pasien->nama }}</td>
                                    <td>{{ $pasien->username }}</td>
                                    <td>{{ $pasien->alamat }}</td>
                                    <td>{{ $pasien->no_ktp }}</td>
                                    <td>{{ $pasien->no_hp }}</td>
                                    <td>{{ $pasien->password }}</td>
                                    <td>{{ $pasien->no_rm }}</td>
                                    <td>
                                        <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pasien ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-muted">
                    <i class="fa fa-info-circle"></i> Belum ada data pasien.
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
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="window.location.href='{{ route('pasien.index') }}'">OK</button>
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