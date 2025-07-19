@extends('layouts.app')

@section('title', 'Verifikasi Order Domain')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-3">Verifikasi Order Domain</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>User</th>
                            <th>Domain</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td><span class="badge bg-warning">{{ ucfirst($item->status) }}</span></td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.verifikasi.verify', $order->id) }}">
                                            @csrf
                                            <button class="btn btn-sm btn-success" onclick="return confirm('Verifikasi domain ini?')">Verifikasi</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted">Belum ada order domain yang perlu diverifikasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer text-center">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
