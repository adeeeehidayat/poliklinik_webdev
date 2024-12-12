<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasien Register</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #007bff, #28a745);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Roboto', sans-serif;
        }
        .login-card {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background-color: white;
        }
        .login-card .icon-container {
            text-align: center;
            padding-top: 50px;
        }
        .login-card .icon-container i {
            font-size: 3rem;
            color: #007bff;
        }
        .login-card .icon-container h5 {
            margin-top: 20px;
            font-size: 1.25rem;
            font-weight: bold;
        }
        .login-card .card-body {
            padding: 30px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .text-danger {
            font-size: 0.9rem;
        }
        .text-center a {
            text-decoration: none;
            font-weight: bold;
            color: #007bff;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card login-card">
                    <div class="icon-container">
                        <i class="fas fa-user-injured fa-5x"></i>
                        <h5>Register Pasien</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('pasien.pasienRegister') }}">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="no_ktp" name="no_ktp" placeholder="No KTP" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No HP" required>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    <span class="input-group-text" onclick="togglePasswordVisibility()" style="cursor: pointer;">
                                        <i id="toggle-icon" class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            @if ($errors->has('error'))
                                <div class="text-danger mb-3">{{ $errors->first('error') }}</div>
                            @endif
                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </form>
                        <div class="text-center mt-3">
                            <p>Sudah punya akun? <a href="/pasien/login">Login di sini</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggle-icon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
