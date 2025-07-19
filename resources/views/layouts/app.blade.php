<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard AksiHot')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.0/css/all.min.css">

<!-- AdminLTE -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('layouts.navbar')
    @include('layouts.sidebar')

    <div class="content-wrapper p-3">
        @yield('content')
    </div>

    {{-- <footer class="main-footer text-center">
        <strong>&copy; {{ date('Y') }} AksiHot.</strong> All rights reserved.
    </footer> --}}
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
@stack('scripts')
</body>
</html>
