@extends('dokter.layout')

@section('content')
<div class="container mt-3">
    <!-- Edit Profil Dokter Section -->
    <div class="bg-light shadow-sm p-4 rounded-lg">
        <div class="mb-4">
            <h4 class="text-primary font-weight-bold">Edit Profil Dokter</h4>
        </div>

        <form action="{{ route('profil_dokter.update') }}" method="POST">
            @csrf
            <!-- Nama -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="nama" class="form-label">Nama</label>
                </div>
                <div class="col-md-9">
                    <input type="text" id="nama" name="nama" class="form-control" value="{{ $dokter->nama }}" required>
                </div>
            </div>

            <!-- Username -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="username" class="form-label">Username</label>
                </div>
                <div class="col-md-9">
                    <input type="text" id="username" name="username" class="form-control" value="{{ $dokter->username }}" required>
                </div>
            </div>

            <!-- Alamat -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="alamat" class="form-label">Alamat</label>
                </div>
                <div class="col-md-9">
                    <input type="text" id="alamat" name="alamat" class="form-control" value="{{ $dokter->alamat }}" required>
                </div>
            </div>

            <!-- No HP -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="no_hp" class="form-label">No HP</label>
                </div>
                <div class="col-md-9">
                    <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{ $dokter->no_hp }}" required>
                </div>
            </div>

            <!-- Password -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="password" class="form-label">Password</label>
                </div>
                <div class="col-md-9">
                    <div class="input-group">
                        <input type="password" id="password" name="password" class="form-control" value="{{ $dokter->password }}" required>
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword" style="cursor: pointer;">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Poli -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="id_poli" class="form-label">Poli</label>
                </div>
                <div class="col-md-9">
                    <div class="input-group">
                        <select class="form-control" id="id_poli" name="id_poli" required>
                            @foreach($polis as $poli)
                                <option value="{{ $poli->id }}" {{ $dokter->id_poli == $poli->id ? 'selected' : '' }}>{{ $poli->nama_poli }}</option>
                            @endforeach
                        </select>
                        <span class="input-group-text">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Button Update and Cancel -->
            <div class="d-flex justify-content-end">
                <a href="{{ route('profil_dokter.index') }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn btn-success btn-lg ms-3">
                    <i class="fas fa-save"></i> Update Profil
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Toggle password visibility
    const togglePasswordButton = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    
    togglePasswordButton.addEventListener('click', function() {
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;
        
        // Toggle eye icon
        this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
    });
</script>

@endsection
