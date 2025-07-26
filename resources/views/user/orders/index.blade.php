@extends('layouts.user')

@section('title',)

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <h2 class="display-6 fw-bold text-primary mb-2">
                    <i class="fas fa-history me-2"></i>Riwayat Pembelian
                </h2>
                <p class="text-muted">Kelola dan pantau semua pembelian domain & hosting Anda</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success rounded-4 shadow-sm text-center border-0 mb-4">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if ($orders->count())
                <!-- Orders Cards -->
                <div class="row g-4">
                    @php 
                        $no = ($orders->currentPage() - 1) * $orders->perPage() + 1;
                    @endphp
                    
                    @foreach ($orders as $order)
                        @php
                            $domainItems = $order->items->where('product_type', 'domain');
                            $hostingItems = $order->items->where('product_type', 'hosting');
                            $totalPrice = $order->items->sum('price');
                            
                            // Tentukan tipe pembelian
                            $purchaseType = '';
                            $cardClass = '';
                            $iconClass = '';
                            
                            if ($domainItems->count() > 0 && $hostingItems->count() > 0) {
                                $purchaseType = 'Domain + Hosting';
                                $cardClass = 'border-primary';
                                $iconClass = 'fas fa-globe text-primary';
                            } elseif ($domainItems->count() > 0) {
                                $purchaseType = 'Domain Only';
                                $cardClass = 'border-info';
                                $iconClass = 'fas fa-globe text-info';
                            } else {
                                $purchaseType = 'Hosting Only';
                                $cardClass = 'border-success';
                                $iconClass = 'fas fa-server text-success';
                            }
                        @endphp
                        
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm {{ $cardClass }} rounded-4 hover-card">
                                <!-- Card Header -->
                                <div class="card-header bg-light border-0 rounded-top-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="{{ $iconClass }} fa-lg me-2"></i>
                                            <div>
                                                <h6 class="mb-0 fw-semibold">Order #{{ $no++ }}</h6>
                                                <small class="text-muted">{{ $order->created_at->format('d M Y') }}</small>
                                            </div>
                                        </div>
                                        <span class="badge bg-{{ $purchaseType === 'Domain + Hosting' ? 'primary' : ($purchaseType === 'Domain Only' ? 'info' : 'success') }} rounded-pill">
                                            {{ $purchaseType }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Card Body -->
                                <div class="card-body">
                                    <!-- Domain Items -->
                                    @if ($domainItems->count() > 0)
                                        <div class="mb-3">
                                            <h6 class="text-info mb-2">
                                                <i class="fas fa-globe me-1"></i>Domain
                                            </h6>
                                            @foreach ($domainItems as $item)
                                                <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded-3">
                                                    <div>
                                                        <div class="fw-medium">{{ $item->product_name }}</div>
                                                        <small class="text-muted">Rp{{ number_format($item->price, 0, ',', '.') }}</small>
                                                    </div>
                                                    <span class="badge bg-{{ $item->status === 'active' ? 'success' : ($item->status === 'unpaid' ? 'warning' : 'secondary') }}">
                                                        {{ ucfirst($item->status) }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    
                                    <!-- Hosting Items -->
                                    @if ($hostingItems->count() > 0)
                                        <div class="mb-3">
                                            <h6 class="text-success mb-2">
                                                <i class="fas fa-server me-1"></i>Hosting
                                            </h6>
                                            @foreach ($hostingItems as $item)
                                                <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded-3">
                                                    <div>
                                                        <div class="fw-medium">{{ $item->product_name }}</div>
                                                        <small class="text-muted">Rp{{ number_format($item->price, 0, ',', '.') }}</small>
                                                    </div>
                                                    <span class="badge bg-{{ $item->status === 'active' ? 'success' : ($item->status === 'unpaid' ? 'warning' : 'secondary') }}">
                                                        {{ ucfirst($item->status) }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    
                                    <!-- Total Price -->
                                    <div class="border-top pt-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong class="text-primary">Total:</strong>
                                            <strong class="text-primary">Rp{{ number_format($totalPrice, 0, ',', '.') }}</strong>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Card Footer -->
                                <div class="card-footer bg-white border-0 rounded-bottom-4">
                                    <div class="d-grid">
                                        <a href="{{ route('user.orders.invoice', $order->id) }}" 
                                           class="btn btn-outline-primary rounded-pill btn-sm">
                                            <i class="fas fa-file-invoice me-1"></i> Lihat Invoice
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-5 d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
                
                <!-- Summary Stats -->
                <div class="row mt-5">
                    <div class="col-md-4">
                        <div class="card text-center border-0 bg-info bg-opacity-10 rounded-4">
                            <div class="card-body">
                                <i class="fas fa-globe fa-2x text-info mb-2"></i>
                                <h5 class="text-info">Domain Only</h5>
                                <p class="text-muted mb-0">{{ $orders->filter(function($order) { return $order->items->where('product_type', 'domain')->count() > 0 && $order->items->where('product_type', 'hosting')->count() == 0; })->count() }} Orders</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center border-0 bg-success bg-opacity-10 rounded-4">
                            <div class="card-body">
                                <i class="fas fa-server fa-2x text-success mb-2"></i>
                                <h5 class="text-success">Hosting Only</h5>
                                <p class="text-muted mb-0">{{ $orders->filter(function($order) { return $order->items->where('product_type', 'hosting')->count() > 0 && $order->items->where('product_type', 'domain')->count() == 0; })->count() }} Orders</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center border-0 bg-primary bg-opacity-10 rounded-4">
                            <div class="card-body">
                                <i class="fas fa-globe fa-2x text-primary mb-2"></i>
                                <h5 class="text-primary">Domain + Hosting</h5>
                                <p class="text-muted mb-0">{{ $orders->filter(function($order) { return $order->items->where('product_type', 'domain')->count() > 0 && $order->items->where('product_type', 'hosting')->count() > 0; })->count() }} Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <div class="card border-0 shadow-sm rounded-4 py-5">
                        <div class="card-body">
                            <div class="empty-state">
                                <i class="fas fa-shopping-cart fa-4x text-muted mb-4"></i>
                                <h4 class="text-muted mb-3">Belum Ada Pembelian</h4>
                                <p class="text-muted mb-4">Anda belum memiliki riwayat pembelian domain atau hosting.</p>
                                <a href="{{ route('user.domain.index') }}" class="btn btn-primary rounded-pill me-2">
                                    <i class="fas fa-globe me-1"></i>Beli Domain
                                </a>
                                <a href="{{ route('user.hosting.index') }}" class="btn btn-success rounded-pill">
                                    <i class="fas fa-server me-1"></i>Beli Hosting
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.hover-card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.empty-state {
    max-width: 400px;
    margin: 0 auto;
}

.card-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.bg-opacity-10 {
    background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
}

.border-primary {
    border-left: 4px solid var(--bs-primary) !important;
}

.border-info {
    border-left: 4px solid var(--bs-info) !important;
}

.border-success {
    border-left: 4px solid var(--bs-success) !important;
}
</style>
@endsection