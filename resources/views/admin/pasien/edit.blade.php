@extends('admin.layout')

@section('content')
<div class="container-fluid px-5 mt-4 mb-4">
    <h1 class="mt-4">Edit Pasien</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pasien</li>
    </ol>
    <form action="{{ route('pasien.update', $pasien->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pasien</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $pasien->nama }}" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ $pasien->username }}" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $pasien->alamat }}" required>
        </div>
        <div class="mb-3">
            <label for="no_ktp" class="form-label">No KTP</label>
            <input type="text" class="form-control" id="no_ktp" name="no_ktp" value="{{ $pasien->no_ktp }}" required>
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $pasien->no_hp }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" class="form-control" id="password" name="password" value="{{ $pasien->password }}" required>
        </div>
        <div class="mb-3">
            <label for="no_rm" class="form-label">No RM</label>
            <input type="text" class="form-control" id="no_rm" name="no_rm" value="{{ $pasien->no_rm }}" required>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Perbarui
            </button>
            <a href="{{ route('pasien.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>
@endsection
