@extends('layouts.admin')

@section('title')

@section('content')
<div class="container mt-4">
    <h3>Invoice Pembayaran</h3>

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Nama User:</strong> {{ $payment->user->name }}</p>
            <p><strong>Email:</strong> {{ $payment->user->email }}</p>
            <p><strong>Jumlah:</strong> Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>
            <p><strong>Tanggal Bayar:</strong> {{ $payment->created_at->format('d M Y H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
