<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Billing - AksiHost')</title>

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
        <a href="#" class="brand-link text-center">
            <span class="brand-text font-weight-light">AksiHost Billing</span>
        </a>    
            <div class="sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview" role="menu" data-accordion="false">
            
            <li class="nav-item">
                <a href="{{ route('billing.invoices.index') }}"
                   class="nav-link {{ Request::is('billing/invoices*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text nav-icon"></i>
                    <p>Daftar Invoice</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('billing.payments.index') }}"
                   class="nav-link {{ Request::is('billing/payments*') ? 'active' : '' }}">
                    <i class="bi bi-credit-card nav-icon"></i>
                    <p>Pembayaran Masuk</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('billing.support.index') }}"
                   class="nav-link {{ Request::is('billing/support*') ? 'active' : '' }}">
                    <i class="bi bi-headset nav-icon"></i>
                    <p>Tiket Masuk</p>
                </a>
            </li>

            <li class="nav-item has-treeview {{ Request::is('billing/domains*') || Request::is('billing/orders/manual*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ Request::is('billing/domains*') || Request::is('billing/orders/manual*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-globe"></i>
                    <p>
                        Manajemen Domain
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('billing.domains.index') }}"
                           class="nav-link {{ Request::is('billing/domains*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Domain Pelanggan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('billing.orders.manual') }}"
                           class="nav-link {{ Request::is('billing/orders/manual*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Order Manual</p>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>
</div>

                </ul>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">@yield('page_heading', 'Billing Panel')</h1>
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
        <strong>&copy; {{ date('Y') }} AksiHost.</strong> Panel Billing.
    </footer>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

@yield('scripts')
</body>
</html>
