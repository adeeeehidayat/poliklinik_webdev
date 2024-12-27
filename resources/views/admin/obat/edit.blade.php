@extends('admin.layout')

@section('content')
<div class="container-fluid px-5 mt-4 mb-4">
    <h1 class="mt-4">Edit Obat</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="text-decoration: none;">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('obat.index') }}" style="text-decoration: none;">Obat</a></li>
        <li class="breadcrumb-item active">Edit Obat</li>
    </ol>
    <form action="{{ route('obat.update', $obat->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_obat" class="form-label">Nama Obat</label>
            <input type="text" class="form-control" id="nama_obat" name="nama_obat" value="{{ $obat->nama_obat }}" required>
        </div>
        <div class="mb-3">
            <label for="kemasan" class="form-label">Kemasan</label>
            <input type="text" class="form-control" id="kemasan" name="kemasan" value="{{ $obat->kemasan }}" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga" value="{{ $obat->harga }}" required>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Perbarui
            </button>
            <a href="{{ route('obat.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>
@endsection
