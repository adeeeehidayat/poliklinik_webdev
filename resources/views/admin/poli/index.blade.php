@extends('admin.layout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Daftar Poli</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Poli</li>
    </ol>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <a href="{{ route('poli.create') }}" class="btn btn-primary mb-3">Tambah Poli</a>
    <table class="table table-bordered">
        <thead>
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
                        <a href="{{ route('poli.edit', $poli->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('poli.destroy', $poli->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus poli ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection