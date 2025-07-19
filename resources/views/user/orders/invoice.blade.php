@extends('layouts.user')

@section('title',)

@section('content')
@include('components.checkout-steps', ['step' => 3])

<div class="container my-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-white border-bottom-0 rounded-top-4 px-4 py-3">
            <h4 class="mb-0 text-primary fw-semibold">🧾 Invoice Pembayaran</h4>
        </div>
        <div class="card-body px-4 py-4">

            <div class="mb-4">
                <p><strong>Nama Pengguna:</strong> {{ $order->user->name }}</p>
                <p><strong>Metode Pembayaran:</strong></p>
                <p><strong>Tanggal Cetak:</strong> {{ $order->created_at->format('d M Y') }}</p>
                <p><strong>Jatuh Tempo:</strong></p>
            </div>

            <ul class="list-group mb-4 shadow-sm">
                @foreach ($order->items as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $item->product_name }}
                        <span>Rp{{ number_format($item->price, 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>

            <div class="mb-4">
                <p><strong>Total:</strong> Rp{{ number_format($order->total, 0, ',', '.') }}</p>
                <p><strong>Status:</strong>
                    <span class="badge bg-{{ $order->status == 'paid' ? 'success' : 'secondary' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>
            </div>
            <a href="{{ route('user.orders.invoice.download', $order->id) }}" class="btn btn-danger rounded-pill">
                <i class="fas fa-file-pdf me-1"></i> Download PDF
            </a>
            
            <a href="{{ route('user.orders.index') }}" class="btn btn-outline-primary rounded-pill">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Riwayat Order
            </a>
        </div>
    </div>
</div>
@endsection
