@extends('layouts.app')

@section('title', 'Edit Harga Domain')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col">
            <h3>Edit Harga Domain</h3>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.domain-prices.index') }}">Kelola Harga Domain</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit Ekstensi</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Form Edit Ekstensi Domain
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.domain-prices.update', $domainPrice) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="extension" class="form-label">Ekstensi Domain</label>
                            <input type="text"
                                   name="extension"
                                   id="extension"
                                   class="form-control @error('extension') is-invalid @enderror"
                                   value="{{ old('extension', $domainPrice->extension) }}"
                                   required>
                            @error('extension')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Harga (Rupiah)</label>
                            <input type="number"
                                   name="price"
                                   id="price"
                                   class="form-control @error('price') is-invalid @enderror"
                                   value="{{ old('price', $domainPrice->price) }}"
                                   min="0"
                                   step="1000"
                                   required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.domain-prices.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
