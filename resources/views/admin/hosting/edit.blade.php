@extends('layouts.admin')

@section('title',)

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold">
            <i class="fas fa-edit text-warning me-2"></i> Edit Paket Hosting
        </h1>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.hosting.index') }}">Hosting</a></li>
                <li class="breadcrumb-item active">Edit Paket</li>
            </ol>
        </nav>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-gradient-warning text-white py-3 d-flex align-items-center">
            <i class="fas fa-server me-2"></i>
            <h5 class="mb-0">Informasi</h5>
            <span class="ms-auto badge bg-white text-warning">{{ $hosting->name }}</span>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.hosting.update', $hosting->id) }}" method="POST" id="hostingForm">
                @csrf
                @method('PUT')

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control form-control-modern @error('name') is-invalid @enderror" value="{{ old('name', $hosting->name) }}" placeholder="Nama Paket" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="disk_space" class="form-control form-control-modern @error('disk_space') is-invalid @enderror" value="{{ old('disk_space', $hosting->disk_space) }}" placeholder="Disk Space" required>
                        @error('disk_space') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="bandwidth" class="form-control form-control-modern @error('bandwidth') is-invalid @enderror" value="{{ old('bandwidth', $hosting->bandwidth) }}" placeholder="Bandwidth" required>
                        @error('bandwidth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="email_accounts" class="form-control form-control-modern @error('email_accounts') is-invalid @enderror" value="{{ old('email_accounts', $hosting->email_accounts) }}" placeholder="Email Accounts" required>
                        @error('email_accounts') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="databases" class="form-control form-control-modern @error('databases') is-invalid @enderror" value="{{ old('databases', $hosting->databases) }}" placeholder="Jumlah Database" required>
                        @error('databases') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div id="priceDurationWrapper" class="mb-4">
                    @foreach ($hosting->durations ?? [] as $index => $price)
                        <div class="row price-group mb-3 align-items-center">
                            <div class="col-md-3">
                               <input type="number" name="durations[0][duration_days]" class="form-control" placeholder="Durasi (hari)" required>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="durations[{{ $index }}][original_price]" class="form-control form-control-modern" value="{{ round($price['original_price']) }}" placeholder="Harga" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="durations[{{ $index }}][discounted_price]" class="form-control form-control-modern" value="{{ $price['discounted_price'] }}" placeholder="Diskon">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-outline-danger btn-sm remove-price d-block"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-outline-primary btn-sm mb-4" id="addPriceBtn"><i class="fas fa-plus me-1"></i> Tambah</button>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        @php
                            $checkboxes = [
                                'has_ssl' => 'SSL',
                                'has_backup' => 'Backup',
                                'has_wordpress' => 'WordPress',
                            ];
                        @endphp
                        @foreach ($checkboxes as $name => $label)
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="{{ $name }}" id="{{ $name }}" {{ old($name, $hosting->$name) ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $name }}">{{ $label }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-md-6">
                        <div id="featuresWrapper">
                            @for ($i = 1; $i <= 5; $i++)
                                @php 
                                    $featureKey = 'feature_' . $i; 
                                    $value = old($featureKey, $hosting->$featureKey);
                                @endphp
                                <div class="feature-field mb-2 {{ $value ? '' : 'd-none' }}" id="feature_{{ $i }}_wrapper">
                                    <input type="text" name="{{ $featureKey }}" placeholder="Fitur {{ $i }}" class="form-control form-control-modern @error($featureKey) is-invalid @enderror" value="{{ $value }}">
                                    @error($featureKey)
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endfor
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="addFeatureBtn"><i class="fas fa-plus me-1"></i> Tambah</button>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                    <a href="{{ route('admin.hosting.index') }}" class="btn btn-outline-secondary"><i class="fas fa-times me-1"></i> Batal</a>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let nextFeature = 1;
    for (let i = 1; i <= 5; i++) {
        const input = document.querySelector(`#feature_${i}_wrapper input`);
        if (input && input.value.trim() !== '') nextFeature = i + 1;
    }

    document.getElementById('addFeatureBtn').addEventListener('click', function () {
        if (nextFeature <= 5) {
            const field = document.getElementById(`feature_${nextFeature}_wrapper`);
            if (field) {
                field.classList.remove('d-none');
                field.querySelector('input').focus();
                nextFeature++;
                if (nextFeature > 5) {
                    this.disabled = true;
                    this.innerHTML = 'Maksimal';
                }
            }
        }
    });

    let priceIndex = {{ isset($hosting->durations) ? count($hosting->durations) : 1 }};
    const priceBtn = document.getElementById('addPriceBtn');
    const wrapper = document.getElementById('priceDurationWrapper');

    priceBtn.addEventListener('click', function () {
        const html = `
        <div class="row price-group mb-3 align-items-center">
            <div class="col-md-3"><input type="number" name="durations[${priceIndex}][duration_months]" class="form-control form-control-modern" placeholder="Durasi" required></div>
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" name="durations[${priceIndex}][original_price]" class="form-control form-control-modern" placeholder="Harga" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" name="durations[${priceIndex}][discounted_price]" class="form-control form-control-modern" placeholder="Diskon">
                </div>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-outline-danger btn-sm remove-price d-block"><i class="fas fa-times"></i></button>
            </div>
        </div>`;
        wrapper.insertAdjacentHTML('beforeend', html);
        priceIndex++;
    });

    wrapper.addEventListener('click', function (e) {
        if (e.target.closest('.remove-price')) {
            const group = e.target.closest('.price-group');
            if (wrapper.children.length > 1) group.remove();
            else alert('Minimal 1 durasi');
        }
    });
});
</script>
@endpush
