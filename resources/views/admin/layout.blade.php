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
    <style>
        .dropdown-toggle::after {
            display: none; /* Menghilangkan tanda panah dropdown */
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-light" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="{{ route('admin.dashboard') }}">Admin</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        
        <!-- User Icon and Dropdown -->
        <div class="ms-auto dropdown">
            <button class="btn btn-link dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user" aria-hidden="true"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li>
                    <form method="POST" action="{{ route('admin.adminLogout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
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