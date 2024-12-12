<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Poliklinik UDINUS Login" />
        <meta name="author" content="Poliklinik UDINUS" />
        <title>Selamat Datang - Poliklinik UDINUS</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
        <style>
            body {
                background: linear-gradient(135deg, #007bff, #28a745);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Roboto', sans-serif;
            }
            .card {
                border: 1px solid #ddd;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                background-color: #fff;
                text-align: center;
                padding: 20px;
            }
            .card-title {
                font-size: 1.25rem;
                font-weight: bold;
                margin-bottom: 10px;
            }
            .card-text {
                font-size: 1rem;
                color: #6c757d;
                margin-bottom: 20px;
            }
            .btn {
                font-weight: 600;
                border-radius: 5px;
                padding: 10px 20px;
            }
            .btn-primary {
                background-color: #007bff;
                border: none;
            }
            .btn-primary:hover {
                background-color: #0056b3;
            }
            .btn-success {
                background-color: #28a745;
                border: none;
            }
            .btn-success:hover {
                background-color: #218838;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row g-4 justify-content-center">
                <!-- Card Login Dokter -->
                <div class="col-md-4">
                    <div class="card">
                        <i class="fas fa-user-md fa-5x" style="margin-bottom: 15px"></i> <!-- Ikon Dokter -->
                        <h5 class="card-title">Dokter</h5>
                        <p class="card-text">Masuk untuk mengelola data pasien, jadwal, dan informasi lainnya.</p>
                        <a href="/dokter/login" class="btn btn-primary">Login</a>
                    </div>
                </div>

                <!-- Card Login Pasien -->
                <div class="col-md-4">
                    <div class="card">
                        <i class="fas fa-user-injured fa-5x" style="margin-bottom: 15px"></i> <!-- Ikon Pasien -->
                        <h5 class="card-title">Pasien</h5>
                        <p class="card-text">Masuk untuk melihat rekam medis, jadwal periksa, dan informasi lainnya.</p>
                        <a href="/pasien/login" class="btn btn-success">Login</a>
                    </div>
                </div>
            </div>
        </div>    

        <script src="assets/js/bootstrap.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    </body>
</html>
