@extends('layouts.landing')

@section('title', 'Kebijakan Pengembalian Dana')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-3 mb-4">
            <nav>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('legal.kebijakan') }}" class="text-decoration-none text-primary">Privacy Policy</a>
                    <a href="{{ route('legal.sla') }}" class="text-decoration-none text-primary">Sla</a>
                    <a href="{{ route('legal.tos') }}" class="text-decoration-none text-primary">Tos</a>
                    <a href="{{ route('legal.refund') }}" class="text-decoration-none text-primary">Refund Policy</a>
                    <a href="{{ route('legal.migrasi') }}" class="text-decoration-none text-primary">Migrasi Layanan</a>
                </div>
            </nav>
        </div>

        <div class="col-md-9">
            <h1 class="fw-semibold mb-4">Kebijakan Pengembalian Dana</h1>
            <p>AksiHot menawarkan <strong>garansi uang kembali 7 hari</strong> untuk layanan hosting tertentu (tidak termasuk domain).</p>

            <h5 class="mt-4 fw-semibold">Ketentuan Pengembalian</h5>
            <ul>
                <li>Permintaan harus dilakukan dalam waktu 7 hari sejak tanggal pembelian</li>
                <li>Pengembalian tidak berlaku untuk domain, lisensi pihak ketiga, dan add-on tertentu</li>
                <li>Pelanggan harus menjelaskan alasan pembatalan</li>
            </ul>

            <h5 class="mt-4 fw-semibold">Proses Pengembalian</h5>
            <p>Proses refund dilakukan dalam waktu 7–14 hari kerja ke metode pembayaran awal.</p>

            <p class="mt-5 small text-muted">Terakhir diperbarui: 14 Juli 2025</p>
        </div>
    </div>
</div>
@endsection
