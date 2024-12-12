@extends('admin.layout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Poli</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Poli</li>
    </ol>
    <form action="{{ route('poli.update', $poli->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_poli" class="form-label">Nama Poli</label>
            <input type="text" class="form-control" id="nama_poli" name="nama_poli" value="{{ $poli->nama_poli }}" required>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $poli->keterangan }}" required>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('poli.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
