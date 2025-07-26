@extends('layouts.user')
@section('title', 'Keranjang Belanja')

@section('content')
@include('components.checkout-steps', ['step' => 1])

<div class="container py-5">
    {{-- Header Section --}}
    <div class="text-center mb-5">
        <h1 class="display-6 fw-bold text-dark mb-2">Keranjang Belanja</h1>
        <p class="lead text-muted">Review produk Anda sebelum melanjutkan pembayaran</p>
    </div>

    <div class="row">
        {{-- SIDEBAR: Ringkasan Belanja --}}
        <div class="col-lg-4 order-lg-2 mb-4">
            @php
                $hostingCart = session('hosting_cart', []);
                $domainCart = session('domain_cart', []);

                $validHosting = array_filter($hostingCart, fn($h) => isset($h['name'], $h['price'], $h['duration']));
                $validDomain = array_filter($domainCart, fn($d) => isset($d['domain'], $d['price']));

                $subtotal = 0;

                foreach ($validHosting as $h) {
                    $subtotal += $h['price'] * $h['duration'];
                }

                foreach ($validDomain as $d) {
                    $subtotal += $d['price'];
                }

                $total = $subtotal;
            @endphp

            <div class="position-sticky" style="top: 120px;">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-gradient text-white p-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <h5 class="fw-bold mb-0 d-flex align-items-center">
                            <i class="fas fa-receipt me-2"></i>
                            Ringkasan Belanja
                        </h5>
                    </div>
                    
                    <div class="card-body p-4">
                        {{-- HOSTING --}}
                        @if(count($validHosting))
                            <div class="mb-3">
                                <h6 class="text-muted mb-3 fw-semibold">
                                    <i class="fas fa-server me-2"></i>HOSTING PACKAGES
                                </h6>
                                @foreach ($validHosting as $key => $hosting)
                                    <div class="bg-light rounded-3 p-3 mb-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold text-dark mb-1">{{ $hosting['name'] }}</h6>
                                                <div class="d-flex align-items-center text-muted small">
                                                    <i class="fas fa-clock me-1"></i>
                                                    {{ $hosting['duration'] }} bulan
                                                </div>
                                            </div>
                                            <div class="text-end ms-3">
                                                <div class="fw-bold text-success">Rp{{ number_format($hosting['price'] * $hosting['duration'], 0, ',', '.') }}</div>
                                                <form action="{{ route('user.hosting.cart.remove') }}" method="POST" class="mt-1">
                                                    @csrf
                                                    <input type="hidden" name="key" value="{{ $key }}">
                                                    <button class="btn btn-sm btn-link text-danger p-0 fw-semibold" onclick="return confirm('Hapus hosting ini?')">
                                                        <i class="fas fa-trash-alt me-1"></i>Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- DOMAIN --}}
                        @if(count($validDomain))
                            <div class="mb-3">
                                <h6 class="text-muted mb-3 fw-semibold">
                                    <i class="fas fa-globe me-2"></i>DOMAINS
                                </h6>
                                @foreach ($validDomain as $key => $domain)
                                    <div class="bg-light rounded-3 p-3 mb-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold text-dark mb-1">{{ $domain['domain'] }}</h6>
                                                <div class="text-muted small">
                                                    <i class="fas fa-tag me-1"></i>Domain Registration
                                                </div>
                                            </div>
                                            <div class="text-end ms-3">
                                                <div class="fw-bold text-success">Rp{{ number_format($domain['price'], 0, ',', '.') }}</div>
                                                <form action="{{ route('user.domain.removeFromCart') }}" method="POST" class="mt-1">
                                                    @csrf
                                                    <input type="hidden" name="domain" value="{{ $key }}">
                                                    <button class="btn btn-sm btn-link text-danger p-0 fw-semibold" onclick="return confirm('Hapus domain ini?')">
                                                        <i class="fas fa-trash-alt me-1"></i>Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @if(!count($validHosting) && !count($validDomain))
                            <div class="text-center py-4">
                                <i class="fas fa-shopping-cart text-muted mb-3" style="font-size: 3rem; opacity: 0.3;"></i>
                                <p class="text-muted mb-0">Keranjang masih kosong</p>
                            </div>
                        @endif

                        <hr class="my-4">
                        
                        <div class="d-flex justify-content-between align-items-center bg-success bg-opacity-10 rounded-3 p-3">
                            <span class="fw-bold text-dark fs-5">
                                <i class="fas fa-calculator me-2"></i>Total
                            </span>
                            <span class="fw-bold text-success fs-4">Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        @if(count($validHosting) || count($validDomain))
                            <form action="{{ route('user.domain.checkout') }}" method="POST" class="mt-4">
                                @csrf
                                <button class="btn btn-warning w-100 btn-lg fw-bold shadow-sm" style="border-radius: 12px; background: linear-gradient(135deg, #ffd89b 0%, #19547b 100%); border: none;">
                                    <i class="fas fa-credit-card me-2"></i>
                                    Lanjutkan Pembayaran
                                </button>
                            </form>
                        @else
                            <div class="alert alert-warning border-0 mt-4" style="border-radius: 12px;">
                                <i class="fas fa-info-circle me-2"></i>
                                Tambahkan domain atau hosting untuk melanjutkan.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- KONTEN UTAMA --}}
        <div class="col-lg-8">
            {{-- Notifications --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 12px; background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                    <div class="d-flex align-items-center text-white">
                        <i class="fas fa-check-circle me-2 fs-5"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 12px; background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);">
                    <div class="d-flex align-items-center text-white">
                        <i class="fas fa-exclamation-triangle me-2 fs-5"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- DAFTAR DOMAIN --}}
            <div class="card border-0 shadow-lg rounded-4 mb-4">
                <div class="card-header bg-light border-0 p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="fw-bold mb-0 d-flex align-items-center">
                            Domain Terpilih
                        </h5>
                        <span class="badge bg-primary rounded-pill">{{ count($validDomain) }} item</span>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    @if (count($validDomain))
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr class="border-0">
                                        <th class="border-0 text-muted fw-semibold">NAMA DOMAIN</th>
                                        <th class="border-0 text-muted fw-semibold text-end">HARGA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($validDomain as $item)
                                        <tr class="border-0">
                                            <td class="border-0 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-success bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                        <i class="fas fa-check text-success"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold">{{ $item['domain'] }}</div>
                                                        <small class="text-muted">Domain Registration - 1 Tahun</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="border-0 py-3 text-end">
                                                <span class="fw-bold text-success fs-5">Rp{{ number_format($item['price'], 0, ',', '.') }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-globe text-muted mb-3" style="font-size: 4rem; opacity: 0.3;"></i>
                            <h6 class="text-muted">Belum ada domain ditambahkan</h6>
                            <p class="text-muted small mb-0">Tambahkan domain untuk melanjutkan pembelian</p>
                        </div>
                    @endif

                    <div class="text-center mt-4">
                        <a href="{{ route('user.domain.index') }}" class="btn btn-outline-primary btn-lg fw-semibold" style="border-radius: 12px;">
                            <i class="fas fa-plus-circle me-2"></i>
                            Tambah Domain Baru
                        </a>
                    </div>
                </div>
            </div>

            {{-- FORM TAMBAH HOSTING --}}
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-gradient text-white p-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <h5 class="fw-bold mb-0 d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="fas fa-server text-white"></i>
                        </div>
                        Tambah Produk Hosting
                        <span class="badge bg-white bg-opacity-20 text-white ms-2">Opsional</span>
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('user.domain.cart.addHosting') }}" method="POST">
                        @csrf

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-server me-2 text-muted"></i>Paket Hosting
                                </label>
                                <select name="hosting_id" class="form-select form-select-lg border-0 bg-light" required style="border-radius: 12px;">
                                    <option value="">-- Pilih Paket Hosting --</option>
                                    @foreach ($hostingPackages as $package)
                                        <option value="{{ $package->id }}">{{ $package->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-calendar-alt me-2 text-muted"></i>Durasi Berlangganan
                                </label>
                                <select name="duration" class="form-select form-select-lg border-0 bg-light" required style="border-radius: 12px;">
                                    <option value="">-- Pilih Durasi --</option>
                                    @foreach ([1, 3, 6, 12, 24, 36] as $bulan)
                                        <option value="{{ $bulan }}">{{ $bulan }} Bulan</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-lg fw-bold px-5 shadow-sm" style="border-radius: 12px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                                <i class="fas fa-cart-plus me-2"></i>
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Card hover effects */
.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
}

/* Button effects */
.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

/* Form focus effects */
.form-select:focus,
.form-control:focus {
    border-color: transparent;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.25);
}

/* Table hover effects */
.table-hover tbody tr:hover {
    background-color: rgba(102, 126, 234, 0.05);
    transform: scale(1.01);
    transition: all 0.2s ease;
}

/* Sticky sidebar animation */
.position-sticky {
    transition: all 0.5s ease;
}

/* Alert animations */
.alert {
    animation: slideInRight 0.5s ease-out;
}

@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

/* Badge pulse effect */
.badge {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}
</style>

@endsection