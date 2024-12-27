@extends('admin.layout')

@section('content')
<div class="container-fluid px-5 mt-4 mb-4">
    <h1 class="mt-4">Daftar Poli</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Poli</li>
    </ol>
    <a href="{{ route('poli.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Poli
    </a>
    <div class="card shadow-sm">
        <div class="card-body">
            @if ($polis->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Poli</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($polis as $poli)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $poli->nama_poli }}</td>
                                    <td>{{ $poli->keterangan }}</td>
                                    <td>
                                        <a href="{{ route('poli.edit', $poli->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('poli.destroy', $poli->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus poli ini?');">
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
                    <i class="fa fa-info-circle"></i> Belum ada data poli.
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
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="window.location.href='{{ route('poli.index') }}'">OK</button>
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