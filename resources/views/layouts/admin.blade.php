<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel - AksiHost')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts & CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    {{-- Navbar --}}
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Toggle Sidebar -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right Navbar -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
            </li>
        </ul>
    </nav>

    {{-- Sidebar --}}
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
            <span class="brand-text font-weight-light">AksiHost Admin</span>
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    {{-- Domain Management --}}
                    <li class="nav-item has-treeview {{ request()->is('admin/domain*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/domain*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-globe"></i>
                            <p>
                                Manajemen Domain
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ms-3">
                            <li class="nav-item">
                                <a href="{{ route('admin.domain.index') }}" class="nav-link {{ request()->routeIs('admin.domain.index') ? 'active' : '' }}">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Domain Pelanggan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.domain-prices.index') }}" class="nav-link {{ request()->routeIs('admin.domain-prices.*') ? 'active' : '' }}">
                                    <i class="fas fa-tags nav-icon"></i>
                                    <p>Kelola Harga Domain</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.create') }}" class="nav-link {{ request()->routeIs('admin.orders.create') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-plus-circle"></i>
                                    <p>Order Manual</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Hosting --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.hosting.index') }}" class="nav-link {{ request()->routeIs('admin.hosting.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-server"></i>
                            <p>Kelola Hosting</p>
                        </a>
                    </li>

                    {{-- Users --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>Kelola User</p>
                        </a>
                    </li>

                    {{-- Payments --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.payments.index') }}" class="nav-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-wallet"></i>
                            <p>Pembayaran</p>
                        </a>
                    </li>

                    {{-- Support --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.support.index') }}" class="nav-link {{ request()->routeIs('admin.support.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-headset"></i>
                            <p>Permintaan Bantuan</p>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>

    {{-- Content --}}
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">@yield('page_heading',)</h1>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>

    {{-- Footer --}}
    <footer class="main-footer text-sm text-center">
        <strong>&copy; {{ date('Y') }} AksiHost.</strong> Admin Panel.
    </footer>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
@stack('scripts')
</body>
</html>
