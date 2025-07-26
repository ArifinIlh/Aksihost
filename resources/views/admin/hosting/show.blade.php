@extends('layouts.admin')

@section('title',)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Detail Paket Hosting</h1>
        <a href="{{ route('admin.hosting.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="fas fa-server me-2"></i> {{ $hosting->name }}
            </h4>
        </div>

        <div class="card-body">
            <!-- Spesifikasi Teknis -->
            <div class="row mb-3">
                <div class="col-md-4 fw-bold text-secondary">Disk Space:</div>
                <div class="col-md-8">{{ $hosting->disk_space }}</div>

                <div class="col-md-4 fw-bold text-secondary">Bandwidth:</div>
                <div class="col-md-8">{{ $hosting->bandwidth }}</div>

                <div class="col-md-4 fw-bold text-secondary">Email Accounts:</div>
                <div class="col-md-8">{{ $hosting->email_accounts }}</div>

                <div class="col-md-4 fw-bold text-secondary">Jumlah Database:</div>
                <div class="col-md-8">{{ $hosting->databases }}</div>
            </div>

            <!-- Harga -->
            <div class="row mb-4">
                <div class="col-md-4 fw-bold text-secondary">Harga:</div>
                <div class="col-md-8 d-flex flex-wrap gap-2">
                    <span class="badge bg-info">Bulanan: Rp{{ number_format($hosting->price_monthly, 0, ',', '.') }}</span>
                    <span class="badge bg-success">Tahunan: Rp{{ number_format($hosting->price_yearly, 0, ',', '.') }}</span>
                    @if ($hosting->promo_price)
                        <span class="badge bg-warning text-dark">Promo: Rp{{ number_format($hosting->promo_price, 0, ',', '.') }}</span>
                    @endif
                </div>
            </div>
            

            <!-- Fitur Tambahan -->
            <div class="row">
                <div class="col-md-4 fw-bold text-secondary">Fitur Tambahan:</div>
                <div class="col-md-8">
                    @php
                        $features = collect([
                            $hosting->feature_1,
                            $hosting->feature_2,
                            $hosting->feature_3,
                            $hosting->feature_4,
                            $hosting->feature_5
                        ])->filter();
                    @endphp

                    @if ($features->isEmpty())
                        <p class="text-muted mb-0">Tidak ada fitur tambahan.</p>
                    @else
                        <ul class="mb-0 ps-3">
                            @foreach ($features as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
