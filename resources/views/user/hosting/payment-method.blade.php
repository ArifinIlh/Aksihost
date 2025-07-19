@extends('layouts.user')

@section('title',)

@section('content')
<div class="container py-5">
    <h2 class="text-center fw-bold mb-4">Pembayaran Hosting</h2>

    @if (session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="mb-3">Detail Pesanan:</h5>
            <ul class="list-group list-group-flush mb-4">
                @foreach ($order->items as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $item->product_name }} ({{ json_decode($item->meta, true)['duration'] ?? '-' }} bulan)
                        <span class="fw-bold text-primary">Rp{{ number_format($item->price * (json_decode($item->meta, true)['duration'] ?? 1), 0, ',', '.') }}</span>
                    </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                    <strong>Total</strong>
                    <strong class="text-success">Rp{{ number_format($order->total, 0, ',', '.') }}</strong>
                </li>
            </ul>

            <form action="{{ route('user.hosting.payment.process', $order->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="payment_method" class="form-label">Pilih Metode Pembayaran</label>
                    <select name="payment_method" id="payment_method" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <option value="bank_transfer">Transfer Bank</option>
                        <option value="qris">QRIS</option>
                        <option value="ewallet">E-Wallet</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success rounded-pill w-100 fw-bold">
                    Bayar Sekarang
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
