<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasien Login</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gowun+Batang:wght@400;700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #edf0f2;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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
        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #1153a1;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 28px;
            color: white;
            font-family: 'Montserrat', sans-serif;
        }
        .navbar-brand:hover {
            color: #ffc600;
        }
        .navbar img {
            height: 40px; /* Atur tinggi gambar sesuai kebutuhan */
            margin-right: 10px; /* Jarak antara gambar dan teks */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <img src="{{ asset('assets/img/logo_dinus.png') }}" alt="Logo" /> <!-- Ganti dengan path gambar logo -->
            <a class="navbar-brand mx-auto" href="#">POLIKLINIK UDINUS</a>
        </div>
    </nav>

    <div class="container mt-5 pt-4"> <!-- Tambahkan margin top untuk menghindari navbar -->
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card login-card">
                    <div class="icon-container">
                        <i class="fas fa-user-injured fa-5x"></i>
                        <h5>Login Pasien</h5>
                    </div>
                    <div class="card-body">
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
                        <form method="POST" action="{{ route('pasien.pasienLogin') }}">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    <span class="input-group-text" onclick="togglePasswordVisibility()" style="cursor: pointer;">
                                        <i id="toggle-icon" class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                        <div class="text-center mt-3">
                            <p>Belum punya akun Pasien? <a href="/pasien/register">Daftar di sini</a></p>
                        </div>
                        <div class="text-center mt-3">
                            <p>Login sebagai Dokter <a href="/dokter/login">Klik di sini</a></p>
                        </div>
                        <div class="text-center mt-3">
                            <p>Kembali ke <a href="/">Dashboard Utama</a></p>
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