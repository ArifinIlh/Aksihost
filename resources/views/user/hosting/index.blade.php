@extends('layouts.user')

@section('title',)

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-dark mb-3">Pilih Paket Hosting Terbaik</h1>
        <p class="lead text-muted">Dapatkan hosting berkualitas dengan harga terjangkau</p>
        <div class="d-inline-flex align-items-center bg-success bg-opacity-10 rounded-pill px-3 py-2">
            <i class="fas fa-fire text-danger me-2"></i>
            <span class="text-success fw-semibold">Promo Spesial - Diskon hingga 50%</span>
        </div>
    </div>

    <div class="row g-4">
        @forelse ($hostings as $index => $item)
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card border-0 shadow-lg rounded-4 h-100 position-relative overflow-hidden hover-lift">
                    
                    <!-- Badge Popular untuk paket tertentu -->
                    @if ($index === 1)
                        <div class="position-absolute top-0 start-50 translate-middle-x">
                            <span class="badge bg-gradient-primary text-white px-3 py-2 rounded-pill shadow">
                                <i class="fas fa-star me-1"></i>Paling Populer
                            </span>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column p-4">
                        <!-- Package Name -->
                        <div class="text-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-server text-primary fs-4"></i>
                            </div>
                            <h4 class="fw-bold text-dark mb-2">{{ $item->name }}</h4>
                            <p class="text-muted small mb-0">{{ $item->description ?? 'Paket hosting untuk kebutuhan Anda' }}</p>
                        </div>

                        <!-- Pricing Section -->
                        @php
                            $price = $item->promo_price ?? $item->price_monthly;
                        @endphp

                        @if ($item->price_monthly)
                            <div class="text-center mb-4">
                                <div class="mb-2">
                                    <span class="text-muted text-decoration-line-through fs-6">Rp{{ number_format($item->price_monthly * 2, 0, ',', '.') }}</span>
                                    <span class="badge bg-danger ms-2 pulse-animation">-50%</span>
                                </div>
                                <div class="price-display">
                                    <span class="display-6 fw-bold text-primary">Rp{{ number_format($price, 0, ',', '.') }}</span>
                                    <span class="text-muted">/bulan</span>
                                </div>
                            </div>
                        @endif

                        <!-- Duration Selection -->
                        @if (!empty($item->durations))
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark">Pilih Durasi:</label>
                                <select name="duration" class="form-select form-select-sm rounded-3 border-2">
                                    @foreach ($item->durations as $duration)
                                        <option value="{{ $duration['duration_months'] }}">
                                            {{ $duration['duration_months'] }} Bulan - Rp{{ number_format($duration['discounted_price'] ?? $duration['original_price'], 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <!-- Features List -->
                        <div class="mb-4">
                            <h6 class="fw-semibold text-dark mb-3">Fitur Utama:</h6>
                            <ul class="list-unstyled">
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <small><strong>Site Hosted:</strong> {{ $item->site_hosted ?? '-' }}</small>
                                </li>
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <small><strong>Disk Space:</strong> {{ $item->disk_space }}</small>
                                </li>
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <small><strong>Domain:</strong> .my.id / biz.id</small>
                                </li>
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <small><strong>Email:</strong> {{ $item->email_accounts }}</small>
                                </li>
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-{{ $item->has_ssl ? 'check-circle text-success' : 'times-circle text-danger' }} me-2"></i>
                                    <small><strong>SSL:</strong> {{ $item->has_ssl ? 'Gratis' : 'Tidak' }}</small>
                                </li>
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <small><strong>LiteSpeed:</strong> Community</small>
                                </li>
                            </ul>
                        </div>

                        <!-- Additional Features -->
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
                            <div class="mb-4">
                                <button class="btn btn-outline-primary btn-sm w-100 rounded-pill toggle-fitur-btn"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#fitur-{{ $item->id }}"
                                    aria-expanded="false"
                                    aria-controls="fitur-{{ $item->id }}">
                                    <i class="fas fa-plus me-2"></i>Lihat Semua Fitur
                                </button>

                                <div class="collapse mt-3" id="fitur-{{ $item->id }}">
                                    <div class="bg-light rounded-3 p-3">
                                        <h6 class="fw-semibold text-dark mb-2">Fitur Tambahan:</h6>
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($features as $fitur)
                                                <li class="d-flex align-items-center mb-1">
                                                    <i class="fas fa-star text-warning me-2"></i>
                                                    <small>{{ $fitur }}</small>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- CTA Button -->
                        <div class="mt-auto">
                            <form action="{{ route('user.hosting.cart.add', $item->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="duration" value="12">
                                <button class="btn btn-primary w-100 rounded-pill py-3 fw-semibold btn-hover-effect">
                                    <i class="fas fa-shopping-cart me-2"></i>
                                    Tambah ke Keranjang
                                </button>
                            </form>
                            
                            <div class="text-center mt-2">
                                <small class="text-muted">
                                    <i class="fas fa-shield-alt me-1"></i>
                                    Garansi 30 hari uang kembali
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="empty-state">
                    <i class="fas fa-server text-muted mb-3" style="font-size: 4rem;"></i>
                    <h4 class="text-muted mb-2">Belum Ada Paket Hosting</h4>
                    <p class="text-muted">Paket hosting akan segera tersedia. Silakan cek kembali nanti.</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Trust Indicators -->
    <div class="row mt-5 pt-5 border-top">
        <div class="col-12 text-center mb-4">
            <h5 class="fw-bold text-dark mb-4">Mengapa Memilih Kami?</h5>
        </div>
        <div class="col-md-3 text-center mb-3">
            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                <i class="fas fa-clock text-primary fs-4"></i>
            </div>
            <h6 class="fw-semibold">Uptime 99.9%</h6>
            <p class="text-muted small">Server selalu online dan stabil</p>
        </div>
        <div class="col-md-3 text-center mb-3">
            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                <i class="fas fa-headset text-success fs-4"></i>
            </div>
            <h6 class="fw-semibold">Support 24/7</h6>
            <p class="text-muted small">Tim support siap membantu kapan saja</p>
        </div>
        <div class="col-md-3 text-center mb-3">
            <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                <i class="fas fa-bolt text-warning fs-4"></i>
            </div>
            <h6 class="fw-semibold">Performa Tinggi</h6>
            <p class="text-muted small">Server cepat dengan teknologi terbaru</p>
        </div>
        <div class="col-md-3 text-center mb-3">
            <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                <i class="fas fa-shield-alt text-info fs-4"></i>
            </div>
            <h6 class="fw-semibold">Backup Otomatis</h6>
            <p class="text-muted small">Data aman dengan backup harian</p>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .hover-lift {
        transition: all 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
    }
    
    .pulse-animation {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    .btn-hover-effect {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-hover-effect:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .btn-hover-effect::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    
    .btn-hover-effect:hover::before {
        left: 100%;
    }
    
    .price-display {
        position: relative;
    }
    
    .card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .card:hover {
        border-color: rgba(13, 110, 253, 0.2);
    }
    
    .toggle-fitur-btn {
        transition: all 0.3s ease;
    }
    
    .toggle-fitur-btn:hover {
        transform: translateY(-1px);
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
    }
    
    @media (max-width: 768px) {
        .display-5 {
            font-size: 2rem;
        }
        
        .display-6 {
            font-size: 1.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Toggle fitur functionality
        document.querySelectorAll('.toggle-fitur-btn').forEach(button => {
            const targetId = button.getAttribute('data-bs-target');
            const collapseEl = document.querySelector(targetId);
            const icon = button.querySelector('i');

            collapseEl.addEventListener('show.bs.collapse', () => {
                button.innerHTML = '<i class="fas fa-minus me-2"></i>Sembunyikan Fitur';
                icon.classList.remove('fa-plus');
                icon.classList.add('fa-minus');
            });

            collapseEl.addEventListener('hide.bs.collapse', () => {
                button.innerHTML = '<i class="fas fa-plus me-2"></i>Lihat Semua Fitur';
                icon.classList.remove('fa-minus');
                icon.classList.add('fa-plus');
            });
        });

        // Smooth scroll animation for cards
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });

        // Duration selection update price (if needed)
        document.querySelectorAll('select[name="duration"]').forEach(select => {
            select.addEventListener('change', function() {
                const hiddenInput = this.closest('.card-body').querySelector('input[name="duration"]');
                if (hiddenInput) {
                    hiddenInput.value = this.value;
                }
            });
        });
    });
</script>
@endpush