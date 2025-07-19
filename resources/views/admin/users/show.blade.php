@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
<div class="container-fluid">
    <h3 class="mb-3">Detail User</h3>

    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Login Terakhir</th>
            <td>{{ $user->last_login_at ?? '-' }}</td>
        </tr>
        <tr>
            <th>Dibuat pada</th>
            <td>{{ $user->created_at->format('d M Y H:i') }}</td>
        </tr>
    </table>

    <hr>
    <h5>🧾 Riwayat Pembelian</h5>
    @if ($user->orders->isEmpty())
        <p>Belum ada riwayat pembelian.</p>
    @else
        <ul class="list-group">
            @foreach ($user->orders as $order)
                <li class="list-group-item">
                    #{{ $order->invoice_number }} - {{ $order->service_type }} - Rp{{ number_format($order->total, 0, ',', '.') }}
                    <small class="d-block text-muted">Tanggal: {{ $order->created_at->format('d M Y H:i') }}</small>
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
