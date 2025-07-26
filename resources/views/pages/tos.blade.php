@extends('layouts.landing')

@section('title', 'Syarat dan Ketentuan Layanan (ToS)')

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
            <h1 class="fw-semibold mb-4">Syarat dan Ketentuan (Terms of Service)</h1>
            <p>Dengan menggunakan layanan <strong>AksiHot</strong>, Anda setuju untuk terikat pada syarat dan ketentuan berikut:</p>

            <h5 class="mt-4 fw-semibold">Ketentuan Umum</h5>
            <ol>
                <li>Pengguna dilarang menggunakan layanan untuk aktivitas ilegal</li>
                <li>Dilarang menghosting konten pornografi, bajakan, atau spam</li>
                <li>AksiHot berhak menangguhkan akun tanpa pemberitahuan jika ditemukan pelanggaran</li>
            </ol>

            <h5 class="mt-4 fw-semibold">Tanggung Jawab Pengguna</h5>
            <p>Pengguna bertanggung jawab atas keamanan akun dan data yang diunggah.</p>

            <h5 class="mt-4 fw-semibold">Pengakhiran Layanan</h5>
            <p>Kami dapat menghentikan layanan jika ada pelanggaran berat, atau berdasarkan permintaan pengguna.</p>

            <p class="mt-5 small text-muted">Terakhir diperbarui: 14 Juli 2025</p>
        </div>
    </div>
</div>
@endsection
