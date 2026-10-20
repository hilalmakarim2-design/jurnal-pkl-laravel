<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Jurnal Harian PKL' }}</title>

    <!-- Import Tailwind CSS & JS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased min-h-screen flex flex-col justify-between">

    <!-- NAVBAR / HEADER -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            
            <!-- Logo & Brand -->
            <div class="flex items-center space-x-3">
                <a href="{{ url('/') }}" class="font-bold text-xl text-indigo-600 flex items-center gap-2">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <span>Jurnal PKL</span>
                </a>
            </div>

            <!-- Menu Navigasi Utama -->
            <nav class="hidden md:flex items-center space-x-6 text-sm font-medium">
                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'text-indigo-600 font-semibold' : 'text-gray-600 hover:text-indigo-600' }} transition">Beranda</a>
                <a href="{{ url('/tentang') }}" class="{{ request()->is('tentang') ? 'text-indigo-600 font-semibold' : 'text-gray-600 hover:text-indigo-600' }} transition">Tentang</a>
                <a href="{{ url('/kontak') }}" class="{{ request()->is('kontak') ? 'text-indigo-600 font-semibold' : 'text-gray-600 hover:text-indigo-600' }} transition">Kontak</a>
            </nav>

            <!-- Tombol Login / Register / Dashboard -->
            <div class="flex items-center space-x-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-sm transition">
                        Ke Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 transition">
                        Masuk
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-sm transition">
                            Daftar
                        </a>
                    @endif
                @endauth
            </div>

        </div>
    </header>

    <!-- CONTENT UTAMA -->
    <main class="mb-auto">
        {{ $slot }}
    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-gray-200 mt-12 py-6">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Jurnal Harian PKL. All rights reserved.
        </div>
    </footer>

</body>
</html>