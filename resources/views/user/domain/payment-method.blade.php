@extends('layouts.user')

@section('title',)

@section('content')
@include('components.checkout-steps', ['step' => 2])

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="text-center fw-bold mb-4">Konfirmasi & Pembayaran</h2>

            @if (session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card border-0 shadow rounded-4">
                <div class="card-body px-4 py-5">

                    <h5 class="fw-semibold mb-3">Detail Pesanan</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td>
                                            {{ $item->product_name }}<br>
                                            <small class="text-muted">Durasi: {{ json_decode($item->meta, true)['duration'] ?? '-' }} bulan</small>
                                        </td>
                                        <td class="text-end fw-semibold text-primary">
                                            Rp{{ number_format($item->price * (json_decode($item->meta, true)['duration'] ?? 1), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="table-light">
                                    <td><strong>Total Pembayaran</strong></td>
                                    <td class="text-end text-success fw-bold">
                                        Rp{{ number_format($order->total, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr class="my-4">

                    <form action="{{ route('user.hosting.payment.process', $order->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="payment_method" class="form-label fw-semibold">Pilih Metode Pembayaran</label>
                            <select name="payment_method" id="payment_method" class="form-select rounded-3" required>
                                <option value="">-- Pilih Metode --</option>
                                <option value="bank_transfer">Transfer Bank (Virtual Account)</option>
                                <option value="qris">QRIS (Scan QR dari e-Wallet)</option>
                                <option value="ewallet">E-Wallet (OVO, DANA, ShopeePay)</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-warning w-100 rounded-pill fw-bold py-2">
                            Lanjutkan Pembayaran
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
