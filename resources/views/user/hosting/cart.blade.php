@extends('layouts.user')

@section('title', 'Keranjang Hosting')

@section('content')
<div class="container py-5">
    <div class="row">
        {{-- SIDEBAR: Ringkasan Belanja --}}
        <div class="col-lg-4 order-lg-2 mb-4">
            @php
                $hostingCart = session('hosting_cart', []);
                $domainCart = session('domain_cart', []);
                $total = 0;

                foreach ($hostingCart as $h) {
                    $price = isset($h['price']) ? (int) str_replace('.', '', $h['price']) : 0;
                    $total += $price;
                }

                foreach ($domainCart as $d) {
                    $domainPrice = isset($d['price']) ? (int) str_replace('.', '', $d['price']) : 0;
                    $total += $domainPrice;
                }

                $hasItem = count($hostingCart) > 0 || count($domainCart) > 0;
            @endphp

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold text-danger mb-3">Ringkasan Belanja</h5>

                {{-- HOSTING --}}
                @foreach ($hostingCart as $key => $hosting)
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <strong class="d-block">{{ $hosting['name'] ?? 'Paket Hosting' }}</strong>
                            <small class="text-muted">{{ $hosting['duration'] ?? 1 }} bulan</small>
                        </div>
                        <div class="text-end">
                            <div>Rp{{ number_format($hosting['price'] ?? 0, 0, ',', '.') }}</div>
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
                        @if (!isset($domain['domain'], $domain['price']))
                            @continue
                        @endif
                        <div class="d-flex justify-content-between mb-2">
                            <div>
                                <strong class="d-block">{{ $domain['domain'] }}</strong>
                                <small class="text-muted">Domain</small>
                            </div>
                            <div class="text-end">
                                <div>Rp{{ number_format($domain['price'], 0, ',', '.') }}</div>
                                <form action="{{ route('user.domain.removeFromCart') }}" method="POST" class="mt-1">
                                    @csrf
                                    <input type="hidden" name="key" value="{{ $key }}">
                                    <button class="btn btn-sm btn-link text-danger p-0" onclick="return confirm('Hapus domain ini?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif

                {{-- TOTAL & CHECKOUT --}}
                @if ($hasItem)
                    <hr>
                    <div class="d-flex justify-content-between mt-2">
                        <span class="fw-semibold">Total</span>
                        <span class="fw-bold text-success">Rp{{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <form action="{{ route('user.hosting.checkout') }}" method="POST" class="mt-4">
                        @csrf
                        <button class="btn btn-warning w-100 rounded-pill fw-semibold">Lanjutkan Pembayaran</button>
                    </form>
                @else
                    <div class="alert alert-warning mt-3">Keranjang masih kosong.</div>
                @endif
            </div>
        </div>

        {{-- MAIN CONTENT --}}
        <div class="col-lg-8">
            <h2 class="fw-bold mb-4">Keranjang Hosting</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- HOSTING CART TABLE --}}
            @if(count($hostingCart))
                <table class="table table-bordered mb-4">
                    <thead>
                        <tr>
                            <th>Paket Hosting</th>
                            <th>Durasi</th>
                            <th>Harga/Bulan</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hostingCart as $key => $item)
                        <tr>
                            <td>{{ $item['name'] ?? '-' }}</td>
                            <td>{{ $item['duration'] ?? 1 }} bulan</td>
                            <td>Rp{{ number_format($item['price'] ?? 0, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($item['price'] ?? 0, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('user.hosting.cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="key" value="{{ $key }}">
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus hosting ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">Keranjang hosting kosong.</p>
            @endif

            {{-- CEK DOMAIN --}}
            <hr>
            @isset($result)
                <div class="alert alert-{{ $result['available'] ? 'success' : 'danger' }}">
                    Domain <strong>{{ $result['full'] }}</strong>
                    {{ $result['available'] ? 'tersedia dan telah ditambahkan ke keranjang' : 'sudah terdaftar oleh orang lain' }}
                </div>
            @endisset

            <div class="card border-0 shadow-sm p-4 rounded-4 mb-4">
                <h5 class="mb-3 fw-semibold">Cek Domain untuk Hosting</h5>
                <form action="{{ route('user.hosting.domain.check') }}" method="POST">
                    @csrf
                    <div class="row g-2 align-items-center">
                        <div class="col-md-5">
                            <input type="text" name="name" class="form-control" placeholder="nama domain" required>
                        </div>
                        <div class="col-md-4">
                            <select name="extension_id" class="form-select" required>
                                @foreach ($extensions as $ext)
                                    <option value="{{ $ext->id }}">{{ $ext->extension }} - Rp{{ number_format($ext->price, 0, ',', '.') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100">Cek Domain</button>
                        </div>
                    </div>
                </form>
            </div>

            <a href="{{ route('user.domain.cart') }}" class="btn btn-outline-secondary rounded-pill">
                <i class="bi bi-cart"></i> Lihat Keranjang Domain
            </a>
        </div>
    </div>
</div>
@endsection
