@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')
<div class="container py-5">
    <!-- Welcome Header -->
    <!-- Welcome Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 bg-gradient-primary text-white shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="fw-bold mb-2">
                                <i class="fas fa-hand-sparkles me-2"></i>
                                Selamat Datang, {{ auth()->user()->name }}!
                            </h2>
                            <p class="mb-0 opacity-75">Kelola domain dan hosting Anda dengan mudah dari dashboard ini</p>
                        </div>
                        <div class="col-md-4 text-end d-none d-md-block">
                            <i class="fas fa-chart-line fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Promo Banner (Slider) -->
    <div class="row mb-5">
        <div class="col-12">
            <div id="bannerCarousel" class="carousel slide shadow-lg" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner rounded-4 overflow-hidden">
                    <div class="carousel-item active">
                        <div class="position-relative">
                            <img src="{{ asset('asset/img/aksihost-removebg-preview.png') }}" 
                                 class="d-block w-100 img-fluid object-fit-contain bg-light" 
                                 alt="Banner 1" style="max-height: 280px;">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="bg-dark bg-opacity-50 rounded-3 p-3">
                                    <h5 class="fw-bold">Hosting Terpercaya</h5>
                                    <p>Dapatkan layanan hosting terbaik untuk website Anda</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="position-relative">
                            <img src="{{ asset('asset/img/ChatGPT_Image_12_Jul_2025__11.11.57-removebg-preview.png') }}" 
                                 class="d-block w-100 img-fluid object-fit-contain bg-light" 
                                 alt="Banner 2" style="max-height: 280px;">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="bg-dark bg-opacity-50 rounded-3 p-3">
                                    <h5 class="fw-bold">Domain Premium</h5>
                                    <p>Pilih domain yang tepat untuk bisnis Anda</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="position-relative">
                            <img src="{{ asset('asset/img/aksihost-removebg-preview.png') }}" 
                                 class="d-block w-100 img-fluid object-fit-contain bg-light" 
                                 alt="Banner 3" style="max-height: 280px;">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="bg-dark bg-opacity-50 rounded-3 p-3">
                                    <h5 class="fw-bold">Support 24/7</h5>
                                    <p>Tim support siap membantu Anda kapan saja</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                    <div class="carousel-control-icon bg-dark bg-opacity-50 rounded-circle p-3">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </div>
                    <span class="visually-hidden">Sebelumnya</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                    <div class="carousel-control-icon bg-dark bg-opacity-50 rounded-circle p-3">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </div>
                    <span class="visually-hidden">Berikutnya</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <!-- Domain Card -->
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-lg h-100 stat-card">
                <div class="card-body text-center p-4">
                    <h6 class="fw-bold text-muted mb-2">Domain Kamu</h6>
                    <h2 class="text-primary fw-bold mb-3 counter">{{ $domainCount }}</h2>
                    <p class="text-muted small mb-3">Domain yang sudah terdaftar</p>
                    <a href="{{ route('user.domain.index') }}" class="btn btn-primary btn-sm rounded-pill px-4 py-2">
                        <i class="fas fa-list me-2"></i>Lihat Domain
                    </a>
                </div>
            </div>
        </div>

        <!-- Hosting Card -->
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-lg h-100 stat-card">
                <div class="card-body text-center p-4">
                    <h6 class="fw-bold text-muted mb-2">Layanan Hosting</h6>
                    <h2 class="text-success fw-bold mb-3 counter">{{ $hostingCount ?? 0 }}</h2>
                    <p class="text-muted small mb-3">Paket hosting aktif</p>
                    <a href="{{ route('user.hosting.index') }}" class="btn btn-success btn-sm rounded-pill px-4 py-2">
                        <i class="fas fa-list me-2"></i>Lihat Hosting
                    </a>
                </div>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-lg h-100 stat-card">
                <div class="card-body text-center p-4">
                    <h6 class="fw-bold text-muted mb-2">Total Order</h6>
                    <h2 class="text-warning fw-bold mb-3 counter">{{ $orderCount }}</h2>
                    <p class="text-muted small mb-3">Pesanan yang telah dibuat</p>
                    <a href="{{ route('user.orders.index') }}" class="btn btn-warning btn-sm rounded-pill px-4 py-2">
                        <i class="fas fa-receipt me-2"></i>Riwayat Order
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Cards -->

    <!-- Action Cards -->
    <div class="row g-4">
        <!-- Profile Card -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg h-100 action-card">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-3 text-center">
                        </div>
                        <div class="col-9">
                            <h5 class="fw-bold mb-2">
                                <i class="fas fa-user-shield me-2 text-info"></i>
                                Profil Akun
                            </h5>
                            <p class="text-muted mb-3">Edit data personal dan ubah password untuk keamanan akun Anda</p>
                            <a href="{{ route('profile.edit') }}" class="btn btn-info btn-sm rounded-pill px-4">
                                <i class="fas fa-user-cog me-2"></i>Edit Profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Live Chat Card -->
 <div class="col-lg-6">
            <div class="card border-0 shadow-lg h-100 action-card">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-3 text-center">
                        </div>
                        <div class="col-9">
                            <h5 class="fw-bold mb-2">
                                <i class="fas fa-headset me-2 text-secondary"></i>
                                Live Chat Support
                            </h5>
                            <p class="text-muted mb-3">Butuh bantuan? Tim support kami akan segera tersedia untuk Anda</p>
                            <a href="#" class="btn btn-secondary btn-sm rounded-pill px-4 disabled">
                                <i class="fas fa-hourglass-half me-2"></i>Segera Hadir
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 text-center">
                        <i class="fas fa-rocket text-warning me-2"></i>Aksi Cepat
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-3 col-6">
                            <a href="{{ route('user.domain.check') }}" class="btn btn-outline-primary w-100 py-3 rounded-3">
                                <i class="fas fa-search-plus d-block mb-2"></i>
                                <small>Cek Domain</small>
                            </a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="{{ route('user.hosting.index') }}" class="btn btn-outline-success w-100 py-3 rounded-3">
                                <i class="fas fa-database d-block mb-2"></i>
                                <small>Hosting</small>
                            </a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="{{ route('user.orders.index') }}" class="btn btn-outline-warning w-100 py-3 rounded-3">
                                <i class="fas fa-shopping-basket d-block mb-2"></i>
                                <small>Pesanan</small>
                            </a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="{{ route('profile.edit') }}" class="btn btn-outline-info w-100 py-3 rounded-3">
                                <i class="fas fa-user-circle d-block mb-2"></i>
                                <small>Profil</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.stat-card {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
}

.stat-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

.action-card {
    transition: all 0.3s ease;
}

.action-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
}

.stat-icon, .action-icon {
    width: 70px;
    height: 70px;
    transition: all 0.3s ease;
}

.stat-card:hover .stat-icon,
.action-card:hover .action-icon {
    transform: scale(1.1);
}

.counter {
    font-size: 2.5rem;
    background: linear-gradient(135deg, currentColor, rgba(0,0,0,0.7));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.carousel-control-icon {
    transition: all 0.3s ease;
}

.carousel-control-icon:hover {
    transform: scale(1.1);
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    animation: fadeInUp 0.6s ease-out;
}

.card:nth-child(2) { animation-delay: 0.1s; }
.card:nth-child(3) { animation-delay: 0.2s; }
.card:nth-child(4) { animation-delay: 0.3s; }

@media (max-width: 768px) {
    .counter {
        font-size: 2rem;
    }
    
    .stat-icon, .action-icon {
        width: 60px;
        height: 60px;
    }
}
</style>
@endsection