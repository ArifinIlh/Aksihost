@extends('layouts.admin')

@section('title',)

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 fw-bold"><i class="fas fa-server text-primary me-2"></i>Tambah Paket Hosting</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.hosting.index') }}">Hosting</a></li>
                <li class="breadcrumb-item active">Tambah Paket</li>
            </ol>
        </nav>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-gradient-primary text-white py-3">
            <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Paket Hosting</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.hosting.store') }}" method="POST">
                @csrf

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control form-control-modern" placeholder="Nama Paket" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="disk_space" class="form-control form-control-modern" placeholder="Disk Space" value="{{ old('disk_space') }}" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="bandwidth" class="form-control form-control-modern" placeholder="Bandwidth" value="{{ old('bandwidth') }}" required>
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="email_accounts" class="form-control form-control-modern" placeholder="Email" value="{{ old('email_accounts') }}" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="databases" class="form-control form-control-modern" placeholder="Database" value="{{ old('databases') }}" required>
                    </div>
                </div>

                <div class="pricing-section bg-light rounded-3 p-4 mb-4">
                    <div id="durations-wrapper">
                        <div class="row duration-item mb-3 align-items-center">
                            <div class="col-md-3">
                               <input type="number" name="durations[0][duration_days]" class="form-control" placeholder="Durasi (hari)" required>

                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="durations[0][original_price]" class="form-control form-control-modern" placeholder="Harga Normal" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="durations[0][discounted_price]" class="form-control form-control-modern" placeholder="Diskon">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-outline-danger btn-sm remove-duration d-block"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm" id="addDuration"><i class="fas fa-plus me-1"></i>Tambah</button>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="feature-card h-100 p-4 border rounded-3 bg-light">
                            @foreach ([
                                'has_ssl' => ['label' => 'Gratis SSL', 'icon' => 'fas fa-lock'],
                                'has_backup' => ['label' => 'Backup Harian', 'icon' => 'fas fa-save'],
                                'has_wordpress' => ['label' => 'WordPress Support', 'icon' => 'fab fa-wordpress']
                            ] as $name => $config)
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" name="{{ $name }}" id="{{ $name }}">
                                    <label class="form-check-label" for="{{ $name }}">
                                        <i class="{{ $config['icon'] }} me-2"></i>{{ $config['label'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="feature-card h-100 p-4 border rounded-3 bg-light">
                            <div id="features-wrapper">
                                @for ($i = 1; $i <= 5; $i++)
                                    @php
                                        $featureKey = 'feature_' . $i;
                                        $value = old($featureKey);
                                    @endphp
                                    <div class="mb-2">
                                        <input type="text" name="{{ $featureKey }}" class="form-control form-control-modern feature-input {{ $i > 1 && !$value ? 'd-none' : '' }}" placeholder="Fitur {{ $i }}" value="{{ $value }}">
                                    </div>
                                @endfor
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="addFeatureBtn"><i class="fas fa-plus me-1"></i>Tambah Fitur</button>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                    <a href="{{ route('admin.hosting.index') }}" class="btn btn-outline-secondary"><i class="fas fa-times me-1"></i>Batal</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let durationIndex = 1;
        document.getElementById('addDuration').addEventListener('click', () => {
            const wrapper = document.createElement('div');
            wrapper.classList.add('row', 'duration-item', 'mb-3', 'align-items-center');
            wrapper.innerHTML = `
                <div class="col-md-3">
                    <input type="number" name="durations[${durationIndex}][duration_months]" class="form-control form-control-modern" placeholder="Durasi" required>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="durations[${durationIndex}][original_price]" class="form-control form-control-modern" placeholder="Harga" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="durations[${durationIndex}][discounted_price]" class="form-control form-control-modern" placeholder="Diskon">
                    </div>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-outline-danger btn-sm remove-duration d-block"><i class="fas fa-times"></i></button>
                </div>
            `;
            document.getElementById('durations-wrapper').appendChild(wrapper);
            durationIndex++;
        });

        document.getElementById('durations-wrapper').addEventListener('click', function (e) {
            if (e.target.closest('.remove-duration')) {
                e.target.closest('.duration-item').remove();
            }
        });

        let featureIndex = 2;
        document.getElementById('addFeatureBtn').addEventListener('click', function () {
            if (featureIndex <= 5) {
                const input = document.querySelector(`input[name="feature_${featureIndex}"]`);
                if (input) {
                    input.classList.remove('d-none');
                    input.focus();
                }
                featureIndex++;

                if (featureIndex > 5) {
                    this.disabled = true;
                    this.innerHTML = '<i class="fas fa-check me-1"></i>Maksimal';
                }
            }
        });
    });
</script>
@endpush
@endsection
