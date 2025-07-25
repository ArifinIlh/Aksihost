<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard User - AksiHost')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom Style -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <!-- Cart -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.domain.cart') }}" title="Keranjang Domain">
                    <span id="cart-icon-default"><i class="bi bi-cart-fill"></i></span>
                    <span id="cart-icon-active" style="display: none;"><i class="bi bi-cart-check"></i></span>
                    @php $total = count(session('domain_cart', [])); @endphp
                    @if ($total > 0)
                        <span class="badge badge-danger navbar-badge">{{ $total }}</span>
                    @endif
                </a>
            </li>
            <!-- Logout -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('user.dashboard') }}" class="brand-link text-center">
            <span class="brand-text font-weight-light">AksiHost User</span>
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('user.dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Domain -->
                    <li class="nav-item {{ Request::is('user/domain*') || Request::is('user/orders*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('user/domain*') || Request::is('user/orders*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-globe"></i>
                            <p>Domain <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview ms-3">
                            <li class="nav-item">
                                <a href="{{ route('user.domain.index') }}" class="nav-link {{ Request::is('user/domain') ? 'active' : '' }}">
                                    <i class="bi bi-search nav-icon"></i>
                                    <p>Cek Domain</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.domain.cart') }}" class="nav-link {{ Request::is('user/domain/cart') ? 'active' : '' }}">
                                    <i class="bi bi-cart-fill nav-icon"></i>
                                    <p>Keranjang</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Hosting -->
                    <li class="nav-item {{ Request::is('user/hosting*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('user/hosting*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-hdd-network"></i>
                            <p>Hosting <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview ms-3">
                            <li class="nav-item">
                                <a href="{{ route('user.hosting.index') }}" class="nav-link">
                                    <i class="bi bi-box nav-icon"></i>
                                    <p>Paket Hosting</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.hosting.cart') }}" class="nav-link">
                                    <i class="bi bi-cart-fill nav-icon"></i>
                                    <p>Keranjang</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Riwayat -->
                    <li class="nav-item">
                        <a href="{{ route('user.orders.index') }}" class="nav-link {{ Request::is('user/orders*') ? 'active' : '' }}">
                            <i class="bi bi-clock-history nav-icon"></i>
                            <p>Riwayat Pembelian</p>
                        </a>
                    </li>

                    <!-- Profil -->
                    <li class="nav-item">
                        <a href="{{ route('profile.edit') }}" class="nav-link {{ Request::is('profile') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-person-circle"></i>
                            <p>Profil</p>
                        </a>
                    </li>

                    
<li class="nav-item {{ Request::is('user/support*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('user/support*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-life-preserver"></i>
        <p>Support <i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview ms-3">
        <li class="nav-item">
            <a href="{{ route('user.support.index') }}" class="nav-link {{ Request::is('user/support*') ? 'active' : '' }}">
                <i class="bi bi-ticket-perforated nav-icon"></i>
                <p>Bantuan Tiket</p>
            </a>
        </li>
    </ul>
</li>

                </ul>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">@yield('page_heading', )</h1>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="main-footer text-sm text-center">
        <strong>&copy; {{ date('Y') }} AksiHost.</strong> Seluruh hak cipta dilindungi undang-undang.
    </footer>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- Cart Icon Toggle -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const defaultIcon = document.getElementById('cart-icon-default');
        const activeIcon = document.getElementById('cart-icon-active');
        if (window.location.pathname.includes('/user/domain/cart')) {
            defaultIcon.style.display = 'none';
            activeIcon.style.display = 'inline';
        } else {
            defaultIcon.style.display = 'inline';
            activeIcon.style.display = 'none';
        }
    });
</script>

@yield('scripts')
</body>
</html>
