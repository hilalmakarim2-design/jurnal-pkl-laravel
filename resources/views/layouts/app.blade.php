<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'PKL Metanouva')</title>
    <!-- CSS dari latihan sebelumnya -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav>
        <a href="/">Beranda</a> | 
        <a href="/tentang">Tentang</a> | 
        <a href="/kontak">Kontak</a>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        <p>&copy; 2026 PKL PT Metanouva Informatika</p>
    </footer>
</body>
</html>