@extends('layouts.user')

@section('title', 'Cek Domain')

@section('content')
<div class="container py-5">
    {{-- Header Section --}}
    <div class="text-center mb-5">
            <i class="fas fa-globe text-primary" style="font-size: 2rem;"></i>
        <h1 class="display-5 fw-bold text-dark mb-2">Cek Ketersediaan Domain</h1>
        <p class="lead text-muted">Temukan domain impian Anda dengan mudah dan cepat</p>
    </div>

    {{-- Notifikasi --}}
    @if (session('error'))
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8">
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-lg notification-card" role="alert" style="border-radius: 16px; background: linear-gradient(135deg, #ff6b6b 0%, #ee5a5a 100%);">
                    <div class="d-flex align-items-start p-2">
                        <div class="notification-icon me-3">
                            <div class="bg-white bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-exclamation-triangle text-white fs-5"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-white fw-bold mb-1">Oops! Terjadi Kesalahan</h6>
                            <p class="text-white text-opacity-90 mb-0">{{ session('error') }}</p>
                        </div>
                        <button type="button" class="btn-close btn-close-white ms-2" data-bs-dismiss="alert" style="filter: brightness(0) invert(1);"></button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    @if (session('success'))
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8">
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-lg notification-card" role="alert" style="border-radius: 16px; background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                    <div class="d-flex align-items-start p-2">
                        <div class="notification-icon me-3">
                            <div class="bg-white bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-check-circle text-white fs-5"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-white fw-bold mb-1">Berhasil!</h6>
                            <p class="text-white text-opacity-90 mb-0">{{ session('success') }}</p>
                        </div>
                        <button type="button" class="btn-close btn-close-white ms-2" data-bs-dismiss="alert" style="filter: brightness(0) invert(1);"></button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Search Section --}}
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h4 class="fw-semibold text-dark mb-2">Mulai Pencarian Domain</h4>
                        <p class="text-muted small">Masukkan nama domain yang Anda inginkan</p>
                    </div>
                    
                    <form method="POST" action="{{ route('user.domain.check') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="position-relative">
                                    <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                                    <input type="text" name="name" class="form-control form-control-lg ps-5 border-0 bg-light" 
                                           placeholder="Contoh: websiteku" required style="border-radius: 12px;">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select name="extension_id" class="form-select form-select-lg border-0 bg-light" required style="border-radius: 12px;">
                                    <option value="">Pilih Ekstensi</option>
                                    @foreach ($extensions as $ext)
                                        <option value="{{ $ext->id }}">{{ $ext->extension }} - Rp{{ number_format($ext->price, 0, ',', '.') }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 d-grid">
                                <button class="btn btn-primary btn-lg fw-semibold" style="border-radius: 12px;">
                                    <i class="fas fa-search me-1"></i> Cek
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Hasil Pengecekan --}}
    @if (isset($result))
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h5 class="fw-semibold mb-3">Hasil Pencarian Domain</h5>
                            <div class="bg-light rounded-pill px-4 py-2 d-inline-block">
                                <span class="fw-bold text-primary fs-5">{{ $result['full'] }}</span>
                            </div>
                        </div>
                        
                        @if ($result['available'])
                            <div class="text-center">
                                <div class="bg-success bg-opacity-10 rounded-4 p-4 mb-4">
                                    <i class="fas fa-check-circle text-success mb-3" style="font-size: 3rem;"></i>
                                    <h4 class="text-success fw-bold mb-2">Domain Tersedia!</h4>
                                    <p class="text-muted mb-0">Selamat! Domain ini masih tersedia untuk didaftarkan</p>
                                </div>
                                
                                <form method="POST" action="{{ route('user.domain.addToCart') }}">
                                    @csrf
                                    <input type="hidden" name="domain" value="{{ $result['full'] }}">
                                    <input type="hidden" name="extension_id" value="{{ $result['extension_id'] }}">
                                    <input type="hidden" name="price" value="{{ $result['price'] }}">
                                    
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                        <button class="btn btn-success btn-lg px-5 fw-semibold" style="border-radius: 12px;">
                                            <i class="fas fa-shopping-cart me-2"></i>
                                            Tambah ke Keranjang
                                        </button>
                                    </div>
                                    
                                    <div class="mt-3">
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Harga: <strong>Rp{{ number_format($result['price'], 0, ',', '.') }}</strong>
                                        </small>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="text-center">
                                <div class="bg-danger bg-opacity-10 rounded-4 p-4">
                                    <i class="fas fa-times-circle text-danger mb-3" style="font-size: 3rem;"></i>
                                    <h4 class="text-danger fw-bold mb-2">Domain Tidak Tersedia</h4>
                                    <p class="text-muted mb-0">Maaf, domain ini sudah digunakan oleh orang lain</p>
                                </div>
                                
                                <div class="mt-4">
                                    <a href="{{ route('user.domain.check') }}" class="btn btn-outline-primary btn-lg px-4" style="border-radius: 12px;">
                                        <i class="fas fa-redo me-2"></i>
                                        Coba Domain Lain
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    {{-- Tips Section --}}
    @if (!isset($result))
        <div class="row justify-content-center mt-5">
            <div class="col-lg-10">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="text-center p-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-lightbulb text-primary fs-4"></i>
                            </div>
                            <h6 class="fw-semibold mb-2">Pilih Nama yang Mudah</h6>
                            <p class="text-muted small mb-0">Gunakan nama yang mudah diingat dan dieja</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-4">
                            <div class="bg-success bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-rocket text-success fs-4"></i>
                            </div>
                            <h6 class="fw-semibold mb-2">Pendek & Jelas</h6>
                            <p class="text-muted small mb-0">Hindari nama domain yang terlalu panjang</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-4">
                            <div class="bg-warning bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-shield-alt text-warning fs-4"></i>
                            </div>
                            <h6 class="fw-semibold mb-2">Hindari Karakter Khusus</h6>
                            <p class="text-muted small mb-0">Jangan gunakan tanda hubung atau angka berlebihan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.form-control:focus,
.form-select:focus {
    border-color: transparent;
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
}

.alert {
    border-radius: 12px;
}

/* Notification Styles */
.notification-card {
    border-left: 5px solid rgba(255,255,255,0.5);
    animation: slideInDown 0.5s ease-out;
}

.notification-icon {
    animation: bounceIn 0.6s ease-out 0.2s both;
}

@keyframes slideInDown {
    from {
        transform: translate3d(0, -100%, 0);
        opacity: 0;
    }
    to {
        transform: translate3d(0, 0, 0);
        opacity: 1;
    }
}

@keyframes bounceIn {
    0%, 20%, 40%, 60%, 80% {
        animation-timing-function: cubic-bezier(0.215, 0.610, 0.355, 1.000);
    }
    0% {
        opacity: 0;
        transform: scale3d(.3, .3, .3);
    }
    20% {
        transform: scale3d(1.1, 1.1, 1.1);
    }
    40% {
        transform: scale3d(.9, .9, .9);
    }
    60% {
        opacity: 1;
        transform: scale3d(1.03, 1.03, 1.03);
    }
    80% {
        transform: scale3d(.97, .97, .97);
    }
    100% {
        opacity: 1;
        transform: scale3d(1, 1, 1);
    }
}

.notification-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}
</style>

@endsection