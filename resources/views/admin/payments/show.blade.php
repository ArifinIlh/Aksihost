@extends('layouts.admin')

@section('title',)

@section('content')
<div class="container mt-4">
    <h3>Detail Pembayaran</h3>

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Nama Pengguna:</strong> {{ $payment->user->name }}</p>
            <p><strong>Email:</strong> {{ $payment->user->email }}</p>
            <p><strong>Jumlah:</strong> Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
            <p><strong>Status:</strong> 
                @if($payment->status === 'verified')
                    <span class="badge bg-success">Terverifikasi</span>
                @elseif($payment->status === 'rejected')
                    <span class="badge bg-danger">Ditolak</span>
                @elseif($payment->status === 'refunded')
                    <span class="badge bg-warning">Refund</span>
                @else
                    <span class="badge bg-secondary">Pending</span>
                @endif
            </p>
            <p><strong>Tanggal:</strong> {{ $payment->created_at->format('d M Y H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
