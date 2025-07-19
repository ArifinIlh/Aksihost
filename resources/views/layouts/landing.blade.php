<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'AksiHot - Hosting, Domain & POS')</title>
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

        footer {
            background-color: #f8f9fa;
        }

        
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar navbar-custom d-flex justify-content-between align-items-center">
        <div class="fw-bold text-primary fs-4">AksiHot</div>
        <div>
            <a href="{{ url('/') }}" class="mx-2 text-dark text-decoration-none">Beranda</a>
            <a href="#layanan" class="mx-2 text-dark text-decoration-none">Layanan</a>
            <a href="#domain" class="mx-2 text-dark text-decoration-none">Domain</a>
            <a href="#hosting" class="mx-2 text-dark text-decoration-none">Hosting</a>
            <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Masuk</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm">Daftar</a>
        </div>
    </div>

    @yield('content')


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
                    <li><a href="#" class="text-white text-decoration-none">Hosting</a></li>
                    <li><a href="{{ route('user.domain.index') }}" class="text-white text-decoration-none">Domain</a></li>
                </ul>
            </div>
            <div class="col-md-2 mb-4">
                <h6 class="fw-bold mb-3">Kebijakan</h6>
                <ul class="list-unstyled small">
                    <li><a href="/privacy-policy" class="text-white text-decoration-none">Kebijakan Privasi</a></li>
                    <li><a href="#" class="text-white text-decoration-none">SLA & ToS</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Refund Policy</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Migrasi Layanan</a></li>
                </ul>
            </div>
            <div class="col-md-3 mb-4">
                <h6 class="fw-bold mb-3">Kontak Kami</h6>
                <ul class="list-unstyled small">
                    <li>Email: support@aksihost.com</li>
                    <li>Telepon: +62 812-3456-7890</li>
                    <li>Alamat: Jl. Teknologi No.88<br>Jakarta, Indonesia</li>
                </ul>
            </div>
        </div>
        <div class="text-center mt-4 border-top pt-3 small">
            &copy; {{ date('Y') }} AksiHot. All rights reserved.
        </div>
    </div>
</footer>


    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
