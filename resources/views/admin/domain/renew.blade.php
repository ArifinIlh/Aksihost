@extends('layouts.app')

@section('title', 'Perpanjang Domain')

@section('content')
<div class="container">
    <h3 class="mb-4">Perpanjang Domain: {{ $domain->product_name }}</h3>

    <form method="POST" action="{{ route('admin.domains.renew.process', $domain->id) }}">
        @csrf
        <div class="form-group mb-3">
            <label for="duration">Durasi Perpanjangan (tahun)</label>
            <select name="duration" id="duration" class="form-control" required>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }} tahun</option>
                @endfor
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Perpanjang Sekarang</button>
    </form>
</div>
@endsection
