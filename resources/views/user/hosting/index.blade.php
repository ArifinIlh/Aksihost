@extends('layouts.user')

@section('title', 'Paket Hosting')

@section('content')

{{-- Notifications --}}
@if (session('error'))
    <div class="container-fluid py-2">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" style="border-radius: 12px; background: linear-gradient(135deg, #ff6b6b 0%, #ee5a5a 100%);">
                    <div class="d-flex align-items-center p-2">
                        <div class="bg-white bg-opacity-20 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-white fw-bold mb-1">Kesalahan</h6>
                            <p class="text-white text-opacity-90 mb-0 small">{{ session('error') }}</p>
                        </div>
                        <button type="button" class="btn-close btn-close-white ms-2" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if (session('success'))
    <div class="container-fluid py-2">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" style="border-radius: 12px; background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                    <div class="d-flex align-items-center p-2">
                        <div class="bg-white bg-opacity-20 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                            <i class="fas fa-check-circle text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-white fw-bold mb-1">Berhasil</h6>
                            <p class="text-white text-opacity-90 mb-0 small">{{ session('success') }}</p>
                        </div>
                        <button type="button" class="btn-close btn-close-white ms-2" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="container py-4">
    {{-- Header Section --}}
    <div class="text-center mb-4">
        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle mb-3" style="width: 60px; height: 60px;">
            <i class="fas fa-server text-primary fs-4"></i>
        </div>
        <h1 class="h2 fw-bold text-dark mb-2">Paket Hosting Premium</h1>
        <p class="text-muted mb-3">Pilih paket hosting yang sesuai dengan kebutuhan website Anda</p>
        <div class="mt-3">
            <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded-pill me-2 small">
                <i class="fas fa-shield-alt me-1"></i>99.9% Uptime
            </span>
            <span class="badge bg-info bg-opacity-10 text-info px-2 py-1 rounded-pill me-2 small">
                <i class="fas fa-rocket me-1"></i>LiteSpeed Server
            </span>
            <span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1 rounded-pill small">
                <i class="fas fa-lock me-1"></i>SSL Gratis
            </span>
        </div>
    </div>

    <div class="row g-3">
        @forelse ($hostings as $index => $item)
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card h-100 border-0 shadow hosting-card position-relative" style="border-radius: 16px; transition: all 0.3s ease;">
                    {{-- Popular Badge --}}
                    @if($index == 1)
                        <div class="position-absolute top-0 start-50 translate-middle">
                            <span class="badge bg-gradient text-white px-2 py-1 rounded-pill shadow-sm small" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <i class="fas fa-star me-1"></i>TERPOPULER
                            </span>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column p-3">
                        {{-- Package Header --}}
                        <div class="text-center mb-3">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle mb-2" style="width: 45px; height: 45px;">
                                <i class="fas fa-{{ $index == 0 ? 'seedling' : ($index == 1 ? 'rocket' : ($index == 2 ? 'crown' : 'star')) }} text-primary"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-1">{{ $item->name }}</h5>
                            <p class="text-muted small mb-0">{{ $item->description ?? 'Paket hosting terbaik untuk Anda' }}</p>
                        </div>

                        {{-- Pricing --}}
                        @php
                            $price = $item->promo_price ?? $item->price_monthly;
                        @endphp

                        @if ($item->price_monthly)
                            <div class="text-center mb-3">
                                <div class="pricing-wrapper">
                                    @if($item->promo_price)
                                        <p class="mb-1 text-muted text-decoration-line-through small">
                                            Rp{{ number_format($item->price_monthly * 2, 0, ',', '.') }}
                                        </p>
                                    @endif
                                    <div class="price-display bg-gradient rounded-3 p-2 text-white mb-2" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        <div class="h5 fw-bold mb-0">Rp{{ number_format($price, 0, ',', '.') }}</div>
                                        <small class="text-white text-opacity-75">/bulan</small>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Duration Selection Form --}}
                        <form action="{{ route('user.hosting.cart.add', $item->id) }}" method="POST" class="mt-auto d-flex flex-column">
                            @csrf

                            @if (!empty($item->durations))
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-dark small">
                                        <i class="fas fa-calendar-alt me-1 text-muted"></i>Pilih Durasi:
                                    </label>
                                    <select name="duration" class="form-select border-0 bg-light" required style="border-radius: 8px;">
                                        @foreach ($item->durations as $duration)
                                            <option value="{{ $duration['duration_days'] }}">
                                                {{ $duration['duration_days'] }} Hari - Rp{{ number_format($duration['discounted_price'] ?? $duration['original_price'], 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <input type="hidden" name="duration" value="30">
                            @endif

                            {{-- Main Features --}}
                            <div class="features-section mb-3">
                                <h6 class="fw-semibold text-dark mb-2 small">
                                    <i class="fas fa-check-circle text-success me-1"></i>Fitur Utama
                                </h6>
                                <div class="row g-1">
                                    <div class="col-12">
                                        <div class="feature-item d-flex align-items-center p-2 bg-light rounded-2">
                                            <i class="fas fa-globe text-primary me-2 small"></i>
                                            <div>
                                                <small class="text-muted d-block" style="font-size: 0.7rem;">Site Hosted</small>
                                                <span class="fw-semibold small">{{ $item->site_hosted ?? 'Unlimited' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="feature-item d-flex align-items-center p-2 bg-light rounded-2">
                                            <i class="fas fa-hdd text-info me-2 small"></i>
                                            <div>
                                                <small class="text-muted d-block" style="font-size: 0.7rem;">Disk Space</small>
                                                <span class="fw-semibold small">{{ $item->disk_space }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="feature-item d-flex align-items-center p-2 bg-light rounded-2">
                                            <i class="fas fa-at text-warning me-2 small"></i>
                                            <div>
                                                <small class="text-muted d-block" style="font-size: 0.7rem;">Email</small>
                                                <span class="fw-semibold small">{{ $item->email_accounts }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- SSL & LiteSpeed Badges --}}
                                <div class="mt-2 d-flex gap-1">
                                    @if($item->has_ssl)
                                        <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded-pill" style="font-size: 0.65rem;">
                                            <i class="fas fa-lock me-1"></i>SSL
                                        </span>
                                    @endif
                                    <span class="badge bg-info bg-opacity-10 text-info px-2 py-1 rounded-pill" style="font-size: 0.65rem;">
                                        <i class="fas fa-rocket me-1"></i>LiteSpeed
                                    </span>
                                </div>
                            </div>

                            {{-- Additional Features (Collapsible) --}}
                            @php
                                $features = collect([
                                    $item->feature_1,
                                    $item->feature_2,
                                    $item->feature_3,
                                    $item->feature_4,
                                    $item->feature_5,
                                ])->filter();
                            @endphp

                            @if ($features->isNotEmpty())
                                <div class="mb-3">
                                    <button class="btn btn-outline-secondary btn-sm w-100 rounded-pill" type="button" data-bs-toggle="collapse" data-bs-target="#fitur-{{ $item->id }}" style="border-radius: 8px; font-size: 0.8rem;">
                                        <i class="fas fa-plus me-1"></i>Lihat Semua Fitur
                                    </button>

                                    <div class="collapse mt-2" id="fitur-{{ $item->id }}">
                                        <div class="bg-light rounded-2 p-2">
                                            <h6 class="fw-semibold text-dark mb-2 small">
                                                <i class="fas fa-star text-warning me-1"></i>Fitur Tambahan
                                            </h6>
                                            <ul class="list-unstyled mb-0" style="font-size: 0.75rem;">
                                                @foreach ($features as $fitur)
                                                    <li class="d-flex align-items-center mb-1">
                                                        <i class="fas fa-check text-success me-1"></i>
                                                        {{ $fitur }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- CTA Button --}}
                            <button type="submit" class="btn fw-bold text-white w-100 mt-auto shadow-sm" style="border-radius: 8px; background: linear-gradient(135deg, #009dff 10%, #009dff 100%); border: none; font-size: 0.85rem;">
                                <i class="fas fa-cart-plus me-1"></i>
                                Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-muted bg-opacity-10 rounded-circle mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-server text-muted" style="font-size: 2rem; opacity: 0.3;"></i>
                    </div>
                    <h5 class="text-muted mb-2">Belum Ada Paket Hosting</h5>
                    <p class="text-muted">Paket hosting akan segera tersedia. Silakan cek kembali nanti.</p>
                </div>
            </div>
        @endforelse
    {{-- </div>edia. Silakan cek kembali nanti.</p>
                </div>
            </div>
        @endforelse --}}
    </div>

    {{-- Features Highlight Section --}}
    @if($hostings->isNotEmpty())
        <div class="row justify-content-center mt-4">
            <div class="col-lg-10">
                <div class="text-center mb-3">
                    <h4 class="fw-bold text-dark">Mengapa Memilih Hosting Kami?</h4>
                    <p class="text-muted small">Dapatkan performa terbaik dengan fitur premium</p>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="text-center p-3">
                            <div class="bg-success bg-opacity-10 rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-shield-alt text-success fs-5"></i>
                            </div>
                            <h6 class="fw-semibold mb-1 small">99.9% Uptime</h6>
                            <p class="text-muted mb-0" style="font-size: 0.75rem;">Server selalu online dengan performa stabil</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-3">
                            <div class="bg-info bg-opacity-10 rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-headset text-info fs-5"></i>
                            </div>
                            <h6 class="fw-semibold mb-1 small">Support 24/7</h6>
                            <p class="text-muted mb-0" style="font-size: 0.75rem;">Tim support siap membantu kapan saja</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-3">
                            <div class="bg-warning bg-opacity-10 rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-rocket text-warning fs-5"></i>
                            </div>
                            <h6 class="fw-semibold mb-1 small">Kecepatan Tinggi</h6>
                            <p class="text-muted mb-0" style="font-size: 0.75rem;">Loading website super cepat dengan LiteSpeed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
/* Card hover effects - Reduced */
.hosting-card {
    transition: all 0.3s ease;
}

.hosting-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

/* Feature item hover */
.feature-item {
    transition: all 0.2s ease;
}

.feature-item:hover {
    background-color: rgba(102, 126, 234, 0.1) !important;
    transform: translateX(2px);
}

/* Button effects */
.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}

/* Form focus effects */
.form-select:focus {
    border-color: transparent;
    box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.25);
}

/* Reduced animations */
.notification-card {
    animation: slideInDown 0.3s ease-out;
}

@keyframes slideInDown {
    from {
        transform: translate3d(0, -50px, 0);
        opacity: 0;
    }
    to {
        transform: translate3d(0, 0, 0);
        opacity: 1;
    }
}

/* Badge animations */
.badge {
    animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translate3d(0, 20px, 0);
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

/* Collapse button icon rotation */
.btn[data-bs-toggle="collapse"]:not(.collapsed) .fa-plus:before {
    content: "\f068"; /* fa-minus */
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .hosting-card:hover {
        transform: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
}
</style>

@endsection