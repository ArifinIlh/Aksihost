@extends('layouts.app')

@section('title', 'Kelola Pembayaran')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Kelola Pembayaran</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($payments->count())
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Invoice</th>
                        <th>User</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->invoice_number }}</td>
                            <td>{{ $payment->user->name ?? '-' }}</td>
                            <td>{{ ucfirst($payment->method) }}</td>
                            <td>
                                <span class="badge bg-{{ $payment->status == 'verified' ? 'success' : ($payment->status == 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </td>
                            <td>Rp{{ number_format($payment->total, 0, ',', '.') }}</td>
                            <td>
                                @if($payment->status === 'pending')
                                    <form action="{{ route('admin.payments.verify', $payment) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-success btn-sm">✅ Verifikasi</button>
                                    </form>
                                    <form action="{{ route('admin.payments.reject', $payment) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger btn-sm">❌ Tolak</button>
                                    </form>
                                @elseif($payment->status === 'verified')
                                    <form action="{{ route('admin.payments.refund', $payment) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-warning btn-sm">💸 Refund</button>
                                    </form>
                                @else
                                    <span class="text-muted">-</span>
                                @endif

                                 <!-- Tombol Tambahan -->
    <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-primary btn-sm mt-1">Detail</a>
    <a href="{{ route('admin.payments.invoice', $payment) }}" target="_blank" class="btn btn-secondary btn-sm mt-1"> Invoice</a>
    {{-- <a href="{{ route('admin.payments.edit', $payment) }}" class="btn btn-info btn-sm mt-1">✏️ Edit</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">Belum ada data pembayaran.</div>
    @endif
</div>
@endsection
