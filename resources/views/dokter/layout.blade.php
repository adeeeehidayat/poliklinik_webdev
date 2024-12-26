<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dokter - Poliklinik UDINUS</title>
        <link href="/assets/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-light bg-light" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{ route('dokter.dashboard') }}">Dokter</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion" style="box-shadow: 4px 0 8px rgba(0, 0, 0, 0.2);">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link {{ Request::routeIs('dokter.dashboard') ? 'active' : '' }}" href="{{ route('dokter.dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link {{ Request::routeIs('daftar_pasien.index') ? 'active' : '' }}" href="{{ route('daftar_pasien.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-injured"></i></div>
                                Daftar Pasien
                            </a>
                            <a class="nav-link {{ Request::routeIs('riwayat_periksa.index') ? 'active' : '' }}" href="{{ route('riwayat_periksa.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-notes-medical"></i></div>
                                Riwayat Periksa
                            </a>
                            <a class="nav-link {{ Request::routeIs('jadwal_periksa.index') ? 'active' : '' }}" href="{{ route('jadwal_periksa.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-calendar-days"></i></div>
                                Jadwal Periksa
                            </a>
                            <a class="nav-link {{ Request::routeIs('profil_dokter.index') ? 'active' : '' }}" href="{{ route('profil_dokter.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-md"></i></div>
                                Profile
                            </a>
                            <div class="sb-sidenav-footer">
                                <form method="POST" action="{{ route('dokter.dokterLogout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/js/scripts.js"></script>
    </body>
</html>
