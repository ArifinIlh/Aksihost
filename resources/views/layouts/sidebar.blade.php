<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">AksiHot Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Manajemen Domain -->
                <li class="nav-item has-treeview {{ request()->routeIs('admin.domain.*') || request()->routeIs('admin.domain-prices.*') || request()->routeIs('admin.verifikasi.*') || request()->routeIs('admin.orders.create') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.domain.*') || request()->routeIs('admin.domain-prices.*') || request()->routeIs('admin.verifikasi.*') || request()->routeIs('admin.orders.create') ? 'active' : '' }}">
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

                <!-- Hosting -->
                <li class="nav-item">
                    <a href="{{ route('admin.hosting.index') }}" class="nav-link {{ request()->routeIs('admin.hosting.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-server"></i>
                        <p>Kelola Hosting</p>
                    </a>
                </li>

                <!-- User -->
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Kelola User</p>
                    </a>
                </li>

                <!-- Pembayaran -->
                <li class="nav-item">
                    <a href="{{ route('admin.payments.index') }}" class="nav-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>Pembayaran</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
