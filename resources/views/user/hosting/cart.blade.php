@extends('layouts.user')
@section('title', 'Keranjang Hosting')

@section('content')
<div class="container py-5">
    <div class="row">

        {{-- SIDEBAR RINGKASAN --}}
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

            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h5 class="fw-bold text-danger mb-3">Ringkasan Belanja</h5>

                {{-- Ringkasan Hosting --}}
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
                                <button class="btn btn-sm btn-link text-danger p-0">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                {{-- Ringkasan Domain --}}
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
                                <button class="btn btn-sm btn-link text-danger p-0">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <hr>
                <div class="d-flex justify-content-between">
                    <strong>Total</strong>
                    <strong class="text-success">Rp{{ number_format($total, 0, ',', '.') }}</strong>
                </div>

                <form action="{{ route('user.hosting.checkout') }}" method="POST" class="mt-4">
                    @csrf
                    <button class="btn btn-warning w-100 rounded-pill fw-semibold" {{ !count($domainCart) ? 'disabled' : '' }}>
                        Lanjutkan Pembayaran
                    </button>
                </form>
            </div>
        </div>

        {{-- KONTEN UTAMA --}}
        <div class="col-lg-8">
            <h2 class="fw-bold mb-4">Keranjang Hosting</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- Tabel Hosting --}}
            @if (count($hostingCart))
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Paket</th>
                            <th>Durasi</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hostingCart as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['duration'] }} bulan</td>
                                <td>Rp{{ number_format($item['price'] * $item['duration'], 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if (!count($domainCart))
                    <div class="alert alert-warning mt-3">
                        ⚠️ Untuk melanjutkan pembelian hosting, silakan tambahkan domain terlebih dahulu.
                    </div>
                @endif
            @else
                <p class="text-muted">Tidak ada paket hosting di keranjang.</p>
            @endif

            {{-- CEK DOMAIN --}}
            <hr class="my-5">
            <h4 class="mb-3">Cek dan Tambah Domain</h4>
            <form method="POST" action="{{ route('user.domain.addToCart') }}">
                @csrf
                <div class="col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama domain" required>
                </div>
                <div class="col-md-4">
                    <select name="extension_id" class="form-select" required>
                        <option value="">-- Pilih Ekstensi --</option>
                        @foreach ($extensions as $ext)
                            <option value="{{ $ext->id }}">{{ $ext->extension }} - Rp{{ number_format($ext->price, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-secondary w-100">Cek</button>
                </div>
            </form>

            {{-- HASIL CEK DOMAIN --}}
            @if (isset($result))
                <div class="card shadow-sm mt-4 border-{{ $result['available'] ? 'success' : 'danger' }}">
                    <div class="card-body">
                        <h5>Hasil: <strong>{{ $result['full'] }}</strong></h5>
                        @if ($result['available'])
                            <p class="text-success">✅ Domain tersedia</p>
                            <form method="POST" action="{{ route('user.domain.addToCart') }}">
                                @csrf
                                <input type="hidden" name="domain" value="{{ $result['full'] }}">
                                <input type="hidden" name="extension_id" value="{{ $result['extension_id'] }}">
                                <input type="hidden" name="price" value="{{ $result['price'] }}">
                                <button class="btn btn-warning">+ Tambahkan ke Keranjang</button>
                            </form>
                        @else
                            <p class="text-danger">❌ Domain sudah digunakan</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
