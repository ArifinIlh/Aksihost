@extends('layouts.billing')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Billing</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card bg-light p-3">
                <h5>Menunggu Verifikasi:</h5>
                <p>{{ $pendingPayments }} pembayaran</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-success text-white p-3">
                <h5>Sudah Diverifikasi:</h5>
                <p>{{ $verifiedPayments }} pembayaran</p>
            </div>
        </div>
    </div>
</div>
@endsection
