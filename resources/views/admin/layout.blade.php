<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Poliklinik UDINUS</title>
        <link href="/assets/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{ route('admin.dashboard') }}">Admin</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link {{ Request::routeIs('dokter.index') ? 'active' : '' }}" href="{{ route('dokter.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-doctor"></i></div>
                                Dokter
                            </a>
                            <a class="nav-link {{ Request::routeIs('pasien.index') ? 'active' : '' }}" href="{{ route('pasien.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-injured"></i></div>
                                Pasien
                            </a>
                            <a class="nav-link {{ Request::routeIs('poli.index') ? 'active' : '' }}" href="{{ route('poli.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-hospital"></i></div>
                                Poli
                            </a>
                            <a class="nav-link {{ Request::routeIs('obat.index') ? 'active' : '' }}" href="{{ route('obat.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-pills"></i></div>
                                Obat
                            </a>
                            <div class="sb-sidenav-footer">
                                <form method="POST" action="{{ route('admin.adminLogout') }}">
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/assets/js/scripts.js"></script>
    </body>
</html>
