@extends('layouts.admin')

@section('title')

@section('content')
<div class="container-fluid">
    <h3 class="mb-3">Daftar Domain Pelanggan</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Multi Search Form --}}
    <form method="GET" action="{{ route('admin.domain.index') }}" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                placeholder="Cari domain atau nama pemilik...">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">-- Semua Status --</option>
                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Lunas</option>
                <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Belum Lunas</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100" type="submit">Cari</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('admin.domain.index') }}" class="btn btn-secondary w-100">Reset</a>
        </div>
    </form>

    {{-- Tabel Domain --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Domain</th>
                <th>Harga</th>
                <th>Pemilik</th>
                <th>Status</th>
                <th>Waktu Pembelian</th>
                <th>Kedaluwarsa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($domains as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                <td>{{ $item->order->user->name ?? 'Tidak Diketahui' }}</td>
                <td>
                    @if($item->status === 'paid' || $item->status === 'active')
                        <span class="badge bg-success">Lunas</span>
                    @else
                        <span class="badge bg-warning text-dark">Belum Lunas</span>
                    @endif
                </td>
                <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                <td>
                    {{ $item->expired_at ? \Carbon\Carbon::parse($item->expired_at)->format('d M Y') : '-' }}
                </td>
               
                    <td class="d-flex gap-1 flex-wrap">
    <a href="{{ route('admin.domains.renew', $item->id) }}" class="btn btn-sm btn-primary">Perpanjang</a>
    <a href="{{ route('admin.domains.invoice', $item->id) }}" class="btn btn-sm btn-secondary">Invoice</a>
</td>

            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data domain.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $domains->links() }}
    </div>
</div>
@endsection
