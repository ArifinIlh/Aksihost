@extends('layouts.landing')

@section('title', 'Kebijakan Privasi')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Sidebar vertikal tanpa border -->
        <div class="col-md-3 mb-4">
            <nav>
                <p class="fw-semibold mb-2"></p>
                <div class="d-flex flex-column gap-2">
                    <a href="#" class="text-decoration-none text-primary">Privacy Policy</a>
                    <a href="#" class="text-decoration-none text-primary">kosong</a>
                    <a href="#" class="text-decoration-none text-primary">kosong</a>
                    <a href="#" class="text-decoration-none text-primary">kosong</a>
                    <a href="#" class="text-decoration-none text-primary">kosong</a>
                    <a href="#" class="text-decoration-none text-primary">kosong</a>
                </div>
            </nav>
        </div>

        <!-- Konten Utama -->
        <div class="col-md-9">
            <h1 class="fw-semibold mb-4">Kebijakan Privasi</h1>
            <p>
                Di <strong>AksiHot</strong>, kami berkomitmen untuk menjaga privasi dan keamanan informasi pribadi pelanggan.
                Kebijakan ini menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi data pribadi pengguna layanan kami.
                Dengan menggunakan layanan AksiHot, Anda menyetujui ketentuan dalam kebijakan ini.
            </p>

            <h5 class="mt-4 fw-semibold">Pengumpulan Informasi Pribadi</h5>
            <p>Kami mengumpulkan informasi dari pelanggan melalui berbagai cara, termasuk namun tidak terbatas pada:</p>
            <ol>
                <li>Formulir pendaftaran akun</li>
                <li>Pemesanan layanan hosting, domain, atau POS</li>
                <li>Kontak melalui formulir dukungan atau komunikasi lainnya</li>
                <li>Aktivitas transaksi dan pembayaran</li>
            </ol>

            <p>Jenis data yang dikumpulkan meliputi:</p>
            <ol>
                <li>Nama lengkap</li>
                <li>Alamat email</li>
                <li>Nomor telepon</li>
                <li>Alamat tempat tinggal atau kantor</li>
                <li>Informasi perusahaan (jika berlaku)</li>
                <li>Nomor identitas (jika diwajibkan oleh hukum atau otoritas domain)</li>
                <li>Data transaksi dan histori pembayaran</li>
            </ol>

            <h5 class="mt-4 fw-semibold">Penggunaan Informasi</h5>
            <ol>
                <li>Proses pemesanan dan pengelolaan layanan</li>
                <li>Validasi identitas dan pembuatan akun</li>
                <li>Komunikasi terkait layanan, tagihan, dan pembaruan</li>
                <li>Peningkatan sistem keamanan dan kualitas layanan</li>
                <li>Kepentingan analisis internal untuk pengembangan produk</li>
                <li>Pemenuhan kewajiban hukum dan audit</li>
            </ol>

            <h5 class="mt-4 fw-semibold">Dasar Hukum Pengolahan Data</h5>
            <ol>
                <li>Persetujuan eksplisit pelanggan</li>
                <li>Kewajiban kontraktual</li>
                <li>Kewajiban hukum</li>
                <li>Kepentingan sah seperti keamanan dan pencegahan penyalahgunaan</li>
            </ol>

            <h5 class="mt-4 fw-semibold">Penyimpanan dan Keamanan Data</h5>
            <ol>
                <li>Enkripsi data sensitif</li>
                <li>Akses terbatas oleh personel berwenang</li>
                <li>Pemantauan sistem</li>
                <li>Backup rutin</li>
            </ol>
            <p>Data disimpan hanya selama dibutuhkan atau sesuai hukum berlaku.</p>

            <h5 class="mt-4 fw-semibold">Pengungkapan kepada Pihak Ketiga</h5>
            <p>AksiHot tidak menjual data Anda. Namun, data dapat dibagikan ke:</p>
            <ol>
                <li>Mitra strategis yang mendukung operasional (misal registrar, payment gateway)</li>
                <li>Otoritas hukum bila diwajibkan</li>
                <li>Auditor atau penasihat hukum/keuangan</li>
            </ol>

            <h5 class="mt-4 fw-semibold">Hak Pelanggan</h5>
            <p>Anda berhak untuk:</p>
            <ol>
                <li>Mengakses dan memperbarui data Anda</li>
                <li>Meminta penghapusan data yang tidak relevan</li>
                <li>Menarik kembali persetujuan (bisa berdampak pada layanan)</li>
            </ol>
            <p>Hubungi kami melalui email: <a href="mailto:support@aksihost.com">support@aksihost.com</a></p>

            <h5 class="mt-4 fw-semibold">Cookie dan Teknologi Pelacakan</h5>
            <p>Kami menggunakan cookie untuk pengalaman yang lebih baik. Anda dapat menonaktifkan cookie melalui browser.</p>

            <h5 class="mt-4 fw-semibold">Perubahan Kebijakan</h5>
            <p>Kami dapat memperbarui kebijakan ini kapan saja. Harap periksa secara berkala.</p>

            <h5 class="mt-4 fw-semibold ">Kontak dan Bantuan</h5>
            <p>
                Email: support@aksihost.com<br>
                Alamat:<br>
                Layanan pelanggan tersedia 24/7 melalui sistem tiket pada portal kami.
            </p>

            <p class="mt-5 small text-muted">Terakhir diperbarui: 14 Juli 2025</p>
        </div>
    </div>
</div>
@endsection
