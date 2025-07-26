@extends('layouts.admin')

@section('title',)

@section('content')
<div class="container-fluid px-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="bg-primary text-black p-4 rounded shadow d-flex justify-between align-items-center">
                <div>
                    <h2 class="mb-0">Kelola Paket Hosting</h2>
                    <small>Kelola semua paket hosting dengan mudah</small>
                </div>
<a href="{{ route('admin.hosting.create') }}" class="btn btn-success btn-lg rounded-pill shadow-sm hover-lift">
    <i class="fas fa-plus me-2"></i> Tambah Paket Baru
</a>

            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm rounded-pill px-4 py-3 d-flex align-items-center justify-content-between">
            <div><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <i class="fas fa-server text-primary fa-2x mb-2"></i>
                    <h5 class="mb-0">Total</h5>
                    <h4 class="fw-bold text-primary">{{ $hostings->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <i class="fas fa-chart-line text-success fa-2x mb-2"></i>
                    <h5 class="mb-0">Aktif</h5>
                    <h4 class="fw-bold text-success">{{ $hostings->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <i class="fas fa-star text-warning fa-2x mb-2"></i>
                    <h5 class="mb-0">Premium</h5>
                    <h4 class="fw-bold text-warning">{{ $hostings->where('name', 'like', '%premium%')->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <i class="fas fa-globe text-info fa-2x mb-2"></i>
                    <h5 class="mb-0">Hosting</h5>
                    <h4 class="fw-bold text-info">{{ $hostings->count() }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0 fw-bold">Daftar Paket Hosting</h5>
            <div class="input-group w-50">
                <span class="input-group-text bg-light"><i class="fas fa-search text-muted"></i></span>
                <input type="text" class="form-control bg-light" placeholder="Cari paket...">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama Paket</th>
                        <th class="text-center">Disk</th>
                        <th class="text-center">Bandwidth</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Database</th>
                        <th>Harga</th>
                        <th>Fitur</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($hostings as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->name }}</strong><br>
                                <small class="text-muted">Paket Hosting</small>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-success-subtle text-success">{{ $item->disk_space }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info-subtle text-info">{{ $item->bandwidth }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-warning-subtle text-warning">{{ $item->email_accounts }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-danger-subtle text-danger">{{ $item->databases }}</span>
                            </td>
                            <td>
                                @foreach ($item->prices ?? [] as $price)
                                    <div class="mb-1">
                                        <span class="badge bg-primary">{{ $price->duration_months }} bln</span>
                                        <span class="fw-semibold">Rp{{ number_format($price->original_price, 0, ',', '.') }}</span>
                                        @if ($price->discounted_price)
                                            <span class="badge bg-warning text-dark ms-1">
                                                Promo Rp{{ number_format($price->discounted_price, 0, ',', '.') }}
                                            </span>
                                        @endif
                                    </div>
                                @endforeach
                            </td>
                            <td>
                                @for ($i = 1; $i <= 5; $i++)
                                    @php $feature = 'feature_' . $i; @endphp
                                    @if (!empty($item->$feature))
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-check-circle text-success me-1"></i>
                                            <small>{{ $item->$feature }}</small>
                                        </div>
                                    @endif
                                @endfor
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.hosting.show', $item->id) }}" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.hosting.edit', $item->id) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.hosting.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus paket ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="fas fa-box-open fa-3x text-muted mb-2"></i>
                                <div class="mb-3">Belum ada paket hosting</div>
                                <a href="{{ route('admin.hosting.create') }}" class="btn btn-primary rounded-pill">
                                    <i class="fas fa-plus me-1"></i>Tambah Paket
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
