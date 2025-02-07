@extends('admin.layout')

@section('content')
<div class="container-fluid px-5 mt-4 mb-4">
    <h1 class="mt-4">Daftar Dokter</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="text-decoration: none;">Dashboard</a></li>
        <li class="breadcrumb-item active">Dokter</li>
    </ol>
    <a href="{{ route('dokter.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Dokter
    </a>
    <div class="card shadow-sm">
        <div class="card-body">
            @if ($dokters->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Alamat</th>
                                <th>No HP</th>
                                <th>Password</th>
                                <th>Poli</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dokters as $dokter)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $dokter->nama }}</td>
                                    <td>{{ $dokter->username }}</td>
                                    <td>{{ $dokter->alamat }}</td>
                                    <td>{{ $dokter->no_hp }}</td>
                                    <td>{{ $dokter->password }}</td>
                                    <td>{{ $dokter->poli->nama_poli }}</td>
                                    <td>
                                        <a href="{{ route('dokter.edit', $dokter->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $dokter->id }}">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>

                                        <!-- Modal Konfirmasi Hapus -->
                                        <div class="modal fade" id="deleteModal{{ $dokter->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus dokter <strong>{{ $dokter->nama }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <form action="{{ route('dokter.destroy', $dokter->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-muted">
                    <i class="fa fa-info-circle"></i> Belum ada data dokter.
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
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="window.location.href='{{ route('dokter.index') }}'">OK</button>
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