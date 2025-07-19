@extends('layouts.user')

@section('title',)

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="mb-4 fw-semibold">Selamat Datang, {{-- {{ $user->name }} --}}</h4>

            <!-- Promo Banner (Slider) -->
<div id="bannerCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
    <div class="carousel-inner rounded shadow-sm">
        <div class="carousel-item active">
            <img src="{{ asset('asset/img/aksihost-removebg-preview.png') }}" class="d-block w-100 img-fluid object-fit-contain" alt="Banner 1" style="max-height: 250px;">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('asset/img/ChatGPT_Image_12_Jul_2025__11.11.57-removebg-preview.png') }}" class="d-block w-100 img-fluid object-fit-contain" alt="Banner 2" style="max-height: 250px;">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('asset/img/aksihost-removebg-preview.png') }}" class="d-block w-100 img-fluid object-fit-contain" alt="Banner 3" style="max-height: 250px;">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Sebelumnya</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Berikutnya</span>
    </button>
</div>


            <div class="row g-4">
                <!-- Jumlah Domain -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-globe fa-2x text-primary mb-3"></i>
                            <h6 class="fw-bold">Domain Kamu</h6>
                            <h3 class="text-primary fw-bold">{{ $domainCount }}</h3>
                            <a href="{{ route('user.domain.index') }}" class="btn btn-outline-primary btn-sm rounded-pill mt-2">
                                Lihat Domain
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Jumlah Hosting -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-server fa-2x text-success mb-3"></i>
                            <h6 class="fw-bold">Layanan Hosting</h6>
                            <h3 class="text-success fw-bold">{{ $hostingCount ?? 0 }}</h3>
                            <a href="{{ route('user.hosting.index') }}" class="btn btn-outline-success btn-sm rounded-pill mt-2">
                                Lihat Hosting
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Order -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-file-invoice fa-2x text-warning mb-3"></i>
                            <h6 class="fw-bold">Total Order</h6>
                            <h3 class="text-warning fw-bold">{{ $orderCount }}</h3>
                            <a href="{{ route('user.orders.index') }}" class="btn btn-outline-warning btn-sm rounded-pill mt-2">
                                Riwayat Order
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-4">
                <!-- Profil -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-user-circle fa-2x text-info mb-3"></i>
                            <h6 class="fw-bold">Profil Akun</h6>
                            <p class="text-muted small">Edit data & password kamu</p>
                            <a href="{{ route('profile.edit') }}" class="btn btn-info btn-sm rounded-pill">
                                Edit Profil
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Live Chat -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-headset fa-2x text-secondary mb-3"></i>
                            <h6 class="fw-bold">Live Chat</h6>
                            <p class="text-muted small">Butuh bantuan? Segera Hadir</p>
                            <a href="#" class="btn btn-secondary btn-sm rounded-pill disabled">
                                Segera Hadir
                            </a>
                        </div>
                    </div>
                </div>
            </div> <!-- /.row -->

        </div>
    </div>
</div>
@endsection
