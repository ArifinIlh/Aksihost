@extends('layouts.user')

@section('content')
<div class="container">
    <h2>Buat Permintaan Bantuan</h2>

    {{-- Flash message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error validation --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.support.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Subject --}}
        <div class="mb-3">
            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror"
                   value="{{ old('subject') }}" required>
            @error('subject')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                      rows="5" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Category --}}
        <div class="mb-3">
            <label for="category">Kategori Permintaan</label>
            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="teknikal" {{ old('category') == 'teknikal' ? 'selected' : '' }}>Teknis</option>
                <option value="billing" {{ old('category') == 'billing' ? 'selected' : '' }}>Billing</option>
            </select>
            @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Attachment --}}
        <div class="mb-3">
            <label for="attachment">Lampiran (opsional)</label>
            <input type="file" name="attachment" id="attachment"
                   class="form-control @error('attachment') is-invalid @enderror">
            <small class="text-muted">Maksimal 2MB (jpg, png, pdf, zip, docx)</small>
            @error('attachment')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-success">Kirim Permintaan</button>
    </form>
</div>
@endsection
