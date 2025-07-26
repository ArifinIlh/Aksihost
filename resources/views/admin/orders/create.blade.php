@extends('layouts.admin')

@section('title',)

@section('content')
<div class="container">
    <h3 class="mb-4">Buat Pembelian Domain</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form id="domainCheckForm" method="POST" action="{{ route('admin.orders.check') }}">
        @csrf

        {{-- Pilih User --}}
        <div class="mb-3">
            <label class="js-example-basic-single">Pilih Pengguna</label>
            <select name="user_id" class="form-control" required>
                <option value="">-- Pilih Pengguna --</option>
                @foreach($users as $user)
                    @if($user->role === 'user')
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endif
                @endforeach
            </select>
        </div>

        {{-- Domain --}}
        <div class="mb-3 row">
            <div class="col-md-6">
                <input type="text" name="domain_name" class="form-control" placeholder="Nama domain" required>
            </div>
            <div class="col-md-4">
                <select name="extension_id" class="form-control" required>
                    <option value="">-- Pilih Ekstensi --</option>
                    @foreach($extensions as $ext)
                        <option value="{{ $ext->id }}">{{ $ext->extension }} - Rp{{ number_format($ext->price, 0, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Cek Domain</button>
            </div>
        </div>
    </form>

    @if(isset($result))
        <div class="card mt-4">
            <div class="card-body">
                <h5>Domain: <strong>{{ $result['full'] }}</strong></h5>
                @if($result['available'])
                    <p class="text-success">Domain tersedia</p>

                    {{-- Form Simpan --}}
                    <form method="POST" action="{{ route('admin.orders.store') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $old['user_id'] }}">
                        <input type="hidden" name="domain_name" value="{{ $old['domain_name'] }}">
                        <input type="hidden" name="extension_id" value="{{ $old['extension_id'] }}">

                        <button type="submit" class="btn btn-success">Simpan Pembelian</button>
                    </form>
                @else
                    <p class="text-danger">❌ Domain sudah digunakan</p>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection
