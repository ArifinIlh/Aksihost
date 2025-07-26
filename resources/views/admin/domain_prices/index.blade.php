@extends('layouts.admin')

@section('title',)

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Kelola Harga Domain</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.domain-prices.create') }}" class="btn btn-primary">Tambah Ekstensi</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row mb-3">
        <div class="col-md-3">
            <div class="border p-3">
                <div>Total Domain</div>
                <strong>{{ $prices->total() }}</strong>
            </div>
        </div>
        <div class="col-md-3">
            <div class="border p-3">
                <div>Harga Terendah</div>
                <strong>
                    @if($prices->count() > 0)
                        Rp{{ number_format($prices->min('price'), 0, ',', '.') }}
                    @else
                        -
                    @endif
                </strong>
            </div>
        </div>
        <div class="col-md-3">
            <div class="border p-3">
                <div>Harga Tertinggi</div>
                <strong>
                    @if($prices->count() > 0)
                        Rp{{ number_format($prices->max('price'), 0, ',', '.') }}
                    @else
                        -
                    @endif
                </strong>
            </div>
        </div>
        <div class="col-md-3">
            <div class="border p-3">
                <div>Rata-rata Harga</div>
                <strong>
                    @if($prices->count() > 0)
                        Rp{{ number_format($prices->avg('price'), 0, ',', '.') }}
                    @else
                        -
                    @endif
                </strong>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <form method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari ekstensi domain..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-secondary">Cari</button>
            </form>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-striped mb-0">
                <thead>
                    <tr>
                        <th>Ekstensi Domain</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($prices as $price)
                        <tr>
                            <td>{{ $price->extension }}</td>
                            <td class="text-center">Rp{{ number_format($price->price, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.domain-prices.edit', $price) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.domain-prices.destroy', $price) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus ekstensi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4">
                                @if(request('search'))
                                    Tidak ada ekstensi domain yang ditemukan
                                @else
                                    Belum ada data ekstensi domain
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($prices->hasPages())
            <div class="card-footer">
                {{ $prices->appends(['search' => request('search')])->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
