@extends('layouts.user')

@section('title', 'Tagihan Saya')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Tagihan Saya</h5>
    </div>
    <div class="card-body">
        @if ($payments->isEmpty())
            <div class="alert alert-info mb-0">Belum ada tagihan saat ini.</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Invoice</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $payment->invoice_number }}</td>
                                <td>{{ ucfirst($payment->method) }}</td>
                                <td>
                                    <span class="badge bg-{{ $payment->status === 'verified' ? 'success' : ($payment->status === 'pending' ? 'warning' : 'secondary') }}">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </td>
                                <td>Rp{{ number_format($payment->total, 0, ',', '.') }}</td>
                                <td>{{ $payment->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
