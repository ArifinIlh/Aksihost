@extends('layouts.landing')

@section('title', 'Perjanjian Tingkat Layanan (SLA)')

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
            <h1 class="fw-semibold mb-4">Perjanjian Tingkat Layanan (SLA)</h1>
            <p><strong>AksiHot</strong> berkomitmen menyediakan layanan dengan ketersediaan minimum 99.9% uptime setiap bulan.</p>

            <h5 class="mt-4 fw-semibold">Cakupan SLA</h5>
            <ol>
                <li>Hosting Web & Domain</li>
                <li>Layanan POS Cloud</li>
                <li>Layanan Email Hosting</li>
            </ol>

            <h5 class="mt-4 fw-semibold">Pengecualian SLA</h5>
            <ul>
                <li>Downtime akibat pemeliharaan terjadwal (notifikasi sebelumnya minimal 24 jam)</li>
                <li>Gangguan dari pihak ketiga seperti ISP, kerusakan DNS eksternal, dll</li>
                <li>Kegagalan akibat kesalahan pengguna</li>
                <li>Force Majeure (bencana alam, serangan besar, dll)</li>
            </ul>

            <h5 class="mt-4 fw-semibold">Kompensasi SLA</h5>
            <p>Jika uptime jatuh di bawah 99.9% dalam sebulan, pelanggan berhak atas kompensasi berupa perpanjangan layanan secara gratis, sesuai kebijakan teknis kami.</p>

            <p class="mt-5 small text-muted">Terakhir diperbarui: 14 Juli 2025</p>
        </div>
    </div>
</div>
@endsection
