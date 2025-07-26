@extends('layouts.landing')

@section('title', 'Kebijakan Migrasi Layanan')

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
            <h1 class="fw-semibold mb-4">Kebijakan Migrasi Layanan</h1>
            <p>AksiHot menyediakan bantuan migrasi layanan gratis dari provider lain ke platform kami.</p>

            <h5 class="mt-4 fw-semibold">Syarat Migrasi</h5>
            <ol>
                <li>Akun sumber harus aktif dan dapat diakses oleh tim kami</li>
                <li>Migrasi gratis terbatas pada akun shared hosting</li>
                <li>Pelanggan harus memberikan backup data jika tidak ingin berbagi akses</li>
            </ol>

            <h5 class="mt-4 fw-semibold">Batasan Migrasi</h5>
            <ul>
                <li>Waktu proses tergantung pada ukuran dan kompleksitas data</li>
                <li>Tidak berlaku untuk migrasi platform yang tidak kompatibel</li>
            </ul>

            <p>Untuk permintaan migrasi, silakan hubungi kami di <a href="mailto:support@aksihost.com">support@aksihost.com</a></p>

            <p class="mt-5 small text-muted">Terakhir diperbarui: 14 Juli 2025</p>
        </div>
    </div>
</div>
@endsection
