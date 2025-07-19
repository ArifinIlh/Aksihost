@extends('layouts.user')
@section('title',)

@section('content')
@include('components.checkout-steps', ['step' => 1])
<div class="container py-5">
    <div class="row">

        {{-- SIDEBAR: Ringkasan Belanja --}}
        <div class="col-lg-4 order-lg-2 mb-4">
            @php
                $hostingCart = session('hosting_cart', []);
                $domainCart = session('domain_cart', []);
                $subtotal = 0;

                foreach ($hostingCart as $key => $h) {
                    $subtotal += $h['price'] * $h['duration'];
                }
                foreach ($domainCart as $key => $d) {
                    $subtotal += $d['price'];
                }

                $total = $subtotal;
            @endphp

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold text-danger mb-3">Ringkasan Belanja</h5>

                {{-- HOSTING --}}
                @foreach ($hostingCart as $key => $hosting)
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <strong class="d-block">{{ $hosting['name'] }}</strong>
                            <small class="text-muted">{{ $hosting['duration'] }} bulan</small>
                        </div>
                        <div class="text-end">
                            <div>Rp{{ number_format($hosting['price'] * $hosting['duration'], 0, ',', '.') }}</div>
                            <form action="{{ route('user.hosting.cart.remove') }}" method="POST" class="mt-1">
                                @csrf
                                <input type="hidden" name="key" value="{{ $key }}">
                                <button class="btn btn-sm btn-link text-danger p-0" onclick="return confirm('Hapus hosting ini?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                {{-- DOMAIN --}}
                @if(count($domainCart))
                    <hr class="my-3">
                    @foreach ($domainCart as $key => $domain)
                        <div class="d-flex justify-content-between mb-2">
                            <div>
                                <strong class="d-block">{{ $domain['domain'] }}</strong>
                                <small class="text-muted">Domain</small>
                            </div>
                            <div class="text-end">
                                <div>Rp{{ number_format($domain['price'], 0, ',', '.') }}</div>
                                <form action="{{ route('user.domain.removeFromCart') }}" method="POST" class="mt-1">
                                    @csrf
                                    <input type="hidden" name="domain" value="{{ $key }}">
                                    <button class="btn btn-sm btn-link text-danger p-0" onclick="return confirm('Hapus domain ini?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif

                <hr>
                <div class="d-flex justify-content-between mt-2">
                    <span class="fw-semibold">Total</span>
                    <span class="fw-bold text-success">Rp{{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <form action="{{ route('user.domain.checkout') }}" method="POST" class="mt-4">
                    @csrf
                    <button class="btn btn-warning w-100 rounded-pill fw-semibold">Lanjutkan Pembayaran</button>
                </form>
            </div>
        </div>

        {{-- KONTEN UTAMA --}}
        <div class="col-lg-8">
            <h2 class="fw-bold mb-4">Keranjang</h2>

            {{-- Alert --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- DAFTAR DOMAIN --}}
            <div class="mb-4">
                <h5 class="fw-semibold mb-3">Domain</h5>
                @if (count($domainCart))
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Domain</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($domainCart as $item)
                                <tr>
                                    <td>{{ $item['domain'] }}</td>
                                    <td>Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">Belum ada domain ditambahkan ke keranjang.</p>
                @endif

                <a href="{{ route('user.domain.index') }}" class="btn btn-outline-primary rounded-pill mt-2">
                    + Tambah Domain Baru
                </a>
            </div>

            <hr>

            {{-- FORM TAMBAH HOSTING --}}
            <div class="card p-4 shadow-sm border-0 rounded-4">
                <h5 class="fw-bold mb-3">Tambah Produk Hosting <small class="text-muted">(Opsional)</small></h5>
                <form action="{{ route('user.domain.cart.addHosting') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Paket Hosting</label>
                        <select name="hosting_id" class="form-select" required>
                            <option value="">-- Pilih Paket --</option>
                            @foreach ($hostingPackages as $package)
                                <option value="{{ $package->id }}">{{ $package->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Durasi (bulan)</label>
                        <select name="duration" class="form-select" required>
                            <option value="">-- Pilih Durasi --</option>
                            @foreach ([1, 3, 6, 12, 24, 36] as $bulan)
                                <option value="{{ $bulan }}">{{ $bulan }} Bulan</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-outline-danger fw-semibold rounded-pill px-4">Tambah ke Keranjang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
