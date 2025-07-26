@extends('layouts.admin')

@section('title', 'Invoice Domain')

@section('content')
<div class="container mt-4">
    <h4>Invoice Domain</h4>
    <div class="card p-4 mb-4">
        <p><strong>Nama Domain:</strong> {{ $domain->product_name }}</p>
        <p><strong>Harga:</strong> Rp{{ number_format($domain->price, 0, ',', '.') }}</p>
        <p><strong>Pemilik:</strong> {{ $domain->order->user->name ?? 'Tidak Diketahui' }}</p>
        <p><strong>Status:</strong>
            @if($domain->status === 'paid' || $domain->status === 'active')
                <span class="badge bg-success">Lunas</span>
            @else
                <span class="badge bg-warning text-dark">Belum Lunas</span>
            @endif
        </p>
        <p><strong>Dibuat:</strong> {{ $domain->created_at->format('d M Y H:i') }}</p>
        <p><strong>Kedaluwarsa:</strong> {{ $domain->expired_at ? \Carbon\Carbon::parse($domain->expired_at)->format('d M Y') : '-' }}</p>
    </div>

    <form method="POST" action="#">
        @csrf
        {{-- Tambahkan tombol edit harga jika kamu mau nanti --}}
        <a href="{{ route('admin.domain.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
