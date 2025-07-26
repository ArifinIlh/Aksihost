<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>AksiHost - Hosting, Domain & POS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- AdminLTE + Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: #fff;
            scroll-behavior: smooth;
        }

        .navbar-custom {
            padding: 1rem 2rem;
            background-color: #ffffff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        .btn-auth {
            margin: 0 6px;
            border-radius: 50px;
            padding: 6px 18px;
            font-weight: 500;
        }

        .hero {
            background: linear-gradient(135deg, #007bff, #00c6ff);
            color: white;
            text-align: center;
            padding: 100px 20px 60px;
        }

        .domain-search {
            margin-top: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .features, .price-section {
            padding: 60px 20px;
            text-align: center;
        }

        .feature-box, .pricing-box {
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: 0.3s;
            height: 100%;
        }

        .feature-box:hover, .pricing-box:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 40px;
            color: #007bff;
            margin-bottom: 20px;
        }

        .alert-floating {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1055;
            min-width: 300px;
            max-width: 90%;
            text-align: center;
            animation: fadeInDown 0.6s ease-out;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        @keyframes fadeInDown {
            0% { opacity: 0; transform: translate(-50%, -20px); }
            100% { opacity: 1; transform: translate(-50%, 0); }
        }
    </style>
</head>
<body>
@if(session('success'))
    <div class="alert alert-success alert-floating">
        {{ session('success') }}
    </div>
@endif

<!-- Navbar -->
<div class="navbar navbar-custom d-flex justify-content-between align-items-center">
    <div class="fw-bold text-primary fs-4">AksiHot</div>
    <div>
        <a href="#layanan" class="mx-2 text-dark text-decoration-none">Layanan</a>
        <a href="#domain" class="mx-2 text-dark text-decoration-none">Domain</a>
        <a href="#hosting" class="mx-2 text-dark text-decoration-none">Hosting</a>
        <a href="{{ route('login') }}" class="btn btn-primary btn-sm btn-auth">Masuk</a>
        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm btn-auth">Daftar</a>
    </div>
</div>

<!-- Hero -->
<section class="hero">
    <div class="container">
        <h1>Solusi Hosting, Domain & POS</h1>
        <p>Satu platform untuk semua kebutuhan digital bisnismu.</p>

<form class="domain-search" method="POST" action="#">
    @csrf
    <div class="row g-2 align-items-center">
        <div class="col-md-5">
            <input type="text" name="name" class="form-control rounded-pill" placeholder="Cari nama domain ideal..." required value="{{ old('name') }}">
        </div>
        <div class="col-md-4">
            <select name="extension_id" class="form-control rounded-pill" required>
                <option value="">Pilih Ekstensi</option>
                @foreach ($extensions as $ext)
                    <option value="{{ $ext->id }}">{{ $ext->extension }} - Rp{{ number_format($ext->price, 0, ',', '.') }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-light text-primary fw-bold w-100 rounded-pill">Cari Domain</button>
        </div>
    </div>
</form>


    </div>
</section>

<!-- Layanan -->
<section class="features" id="layanan">
    <div class="container">
        <h2>Layanan Kami</h2>
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="feature-box">
                    <div class="feature-icon"><i class="fas fa-globe"></i></div>
                    <h5>Pendaftaran Domain</h5>
                    <p>Daftarkan nama domain untuk bisnismu dalam hitungan menit.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-box">
                    <div class="feature-icon"><i class="fas fa-server"></i></div>
                    <h5>Web Hosting</h5>
                    <p>Hosting cepat, aman, dan stabil untuk semua kebutuhan website.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Harga Domain -->
<section class="price-section" id="domain">
    <div class="container text-center">
        <h2 class="mb-4">Harga Domain</h2>
        <div class="row justify-content-center">
            <div class="col-md-3 mb-4">
                <div class="pricing-box">
                    <div class="pricing-title">.com</div>
                    <div class="pricing-price">Rp 145.000</div>
                    <p>Populer dan profesional</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="pricing-box">
                    <div class="pricing-title">.id</div>
                    <div class="pricing-price">Rp 220.000</div>
                    <p>Domain Indonesia resmi</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="pricing-box">
                    <div class="pricing-title">.co.id</div>
                    <div class="pricing-price">Rp 275.000</div>
                    <p>Untuk perusahaan di Indonesia</p>
                </div>
            </div>
        </div>
    </div>
</section>
@if(isset($results))
    <div class="mt-5">
        <h4>Hasil untuk: <span class="text-primary">{{ $searchedName }}</span></h4>
        <div class="row justify-content-center mt-3">
            @foreach ($results as $res)
                <div class="col-md-4 mb-3">
                    <div class="pricing-box border {{ $res['available'] ? 'border-success' : 'border-danger' }}">
                        <h5>{{ $res['domain'] }}</h5>
                        <p class="mb-1">Harga: Rp{{ number_format($res['price'], 0, ',', '.') }}</p>
                        <span class="badge {{ $res['available'] ? 'badge-success' : 'badge-danger' }}">
                            {{ $res['available'] ? 'Tersedia' : 'Tidak tersedia' }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

<!-- Harga Hosting -->
<section class="price-section" id="hosting">
    <div class="container text-center">
        <h2 class="mb-4">Paket Hosting</h2>
        <div class="row justify-content-center">
            <div class="col-md-3 mb-4">
                <div class="pricing-box">
                    <div class="pricing-title">Shared Hosting</div>
                    <div class="pricing-price">Rp 15.000 / bulan</div>
                    <p>Cocok untuk pemula dan UMKM</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="pricing-box">
                    <div class="pricing-title">Cloud Hosting</div>
                    <div class="pricing-price">Rp 50.000 / bulan</div>
                    <p>Skalabilitas dan uptime tinggi</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="pricing-box">
                    <div class="pricing-title">VPS Hosting</div>
                    <div class="pricing-price">Rp 150.000 / bulan</div>
                    <p>Full kontrol dengan resource terjamin</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-black text-white pt-5 pb-4 mt-5 shadow-sm">
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold">AksiHot</h5>
                <p class="small">
                    Web Hosting, Domain & layanan digital dengan dukungan akses cepat dan bantuan teknis 24/7.
                </p>
                <img src="{{ asset('asset/img/ChatGPT_Image_12_Jul_2025__11.11.57-removebg-preview.png') }}" alt="" width="80">
            </div>
            <div class="col-md-2 mb-4">
                <h6 class="fw-bold mb-3">Tentang Kami</h6>
                <ul class="list-unstyled small">
                    <li><a href="#" class="text-white text-decoration-none">Profil Perusahaan</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Kenapa Pilih AksiHot?</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Karir</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Media</a></li>
                </ul>
            </div>
            <div class="col-md-2 mb-4">
                <h6 class="fw-bold mb-3">Layanan</h6>
                <ul class="list-unstyled small">
                    <li><a href="{{ route('user.hosting.index') }}" class="text-white text-decoration-none">Hosting</a></li>
                    <li><a href="{{ route('user.domain.index') }}" class="text-white text-decoration-none">Domain</a></li>
                </ul>
            </div>
<div class="col-md-2 mb-4">
    <h6 class="fw-bold mb-3">Kebijakan</h6>
    <ul class="list-unstyled small">
   <li><a href="{{ route('legal.kebijakan') }}" class="text-white text-decoration-none">Kebijakan Privasi</a></li>
<li><a href="{{ route('legal.sla') }}" class="text-white text-decoration-none">SLA</a></li>
<li><a href="{{ route('legal.tos') }}" class="text-white text-decoration-none">ToS</a></li>
<li><a href="{{ route('legal.refund') }}" class="text-white text-decoration-none">Refund Policy</a></li>
<li><a href="{{ route('legal.migrasi') }}" class="text-white text-decoration-none">Migrasi Layanan</a></li>

    </ul>
</div>

            <div class="col-md-3 mb-4">
                <h6 class="fw-bold mb-3">Kontak Kami</h6>
                <ul class="list-unstyled small">
                    <li>Email: support@aksihost.com</li>
                    <li>Telepon:</li>
                    <li>Alamat:<br></li>
                </ul>
            </div>
        </div>
        <div class="text-center mt-4 border-top pt-3 small">
            &copy; {{ date('Y') }} AksiHost. All rights reserved.
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- Auto-hide alert -->
<script>
    setTimeout(() => {
        const alert = document.querySelector('.alert-floating');
        if (alert) {
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000);

        // Redirect jika ada hash (#) di URL root
    if (window.location.pathname === "/" && (window.location.hash === "#" || window.location.search === "?#")) {
        window.location.replace("/welcome");
    }
</script>

</body>
</html>
