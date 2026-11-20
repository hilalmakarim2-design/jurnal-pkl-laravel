<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ 
          theme: localStorage.getItem('theme') || 'light',
          setTheme(val) {
              this.theme = val;
              localStorage.setItem('theme', val);
              document.documentElement.classList.remove('dark', 'theme-pink');
              if (val === 'dark') document.documentElement.classList.add('dark');
              if (val === 'pink') document.documentElement.classList.add('theme-pink');
          }
      }"
      x-init="setTheme(theme)"
      :class="{ 'dark': theme === 'dark', 'theme-pink': theme === 'pink' }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Jurnal PKL') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 dark:text-gray-100 antialiased bg-gray-100 dark:bg-gray-900 transition-colors min-h-screen flex flex-col">
        <!-- Guest Navbar -->
        <nav class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50 transition-colors">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <!-- Nav Kiri: Hanya Brand & Beranda -->
                    <div class="flex items-center space-x-8">
                        <a href="{{ route('home') }}" class="font-bold text-xl text-indigo-600 dark:text-indigo-400">
                            Jurnal PKL
                        </a>
                        <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-indigo-600 transition">
                            Beranda
                        </a>
                    </div>

                    <!-- Nav Kanan: Switcher 3 Mode Tema & Auth -->
                    <div class="flex items-center space-x-4">
                        <!-- Dropdown 3 Mode Tema (Light, Dark, Pink) -->
                        <div class="relative" x-data="{ openTheme: false }">
                            <button @click="openTheme = !openTheme" type="button" class="p-2 rounded-xl text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition focus:outline-none flex items-center space-x-1" title="Pilih Tema Tampilan">
                                <span x-show="theme === 'light'">☀️</span>
                                <span x-show="theme === 'dark'">🌙</span>
                                <span x-show="theme === 'pink'">🌸</span>
                            </button>

                            <div x-show="openTheme" @click.away="openTheme = false" x-transition class="absolute right-0 mt-2 w-40 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 py-1 z-50">
                                <button @click="setTheme('light'); openTheme = false" class="w-full text-left px-4 py-2 text-xs font-semibold flex items-center space-x-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <span>☀️ Light Mode</span>
                                </button>
                                <button @click="setTheme('dark'); openTheme = false" class="w-full text-left px-4 py-2 text-xs font-semibold flex items-center space-x-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <span>🌙 Dark Mode</span>
                                </button>
                                <button @click="setTheme('pink'); openTheme = false" class="w-full text-left px-4 py-2 text-xs font-semibold flex items-center space-x-2 hover:bg-pink-100 dark:hover:bg-pink-950 text-pink-600 dark:text-pink-300">
                                    <span>🌸 Pink Mode</span>
                                </button>
                            </div>
                        </div>

                        <!-- Tombol Masuk / Daftar -->
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 dark:text-gray-300 hover:text-indigo-600">Masuk</a>
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition">Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Form Card Container -->
        <div class="flex-grow flex flex-col sm:justify-center items-center py-6 sm:py-12 bg-gray-100 dark:bg-gray-900">
            <div class="w-full sm:max-w-md px-6 py-6 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-2xl border border-gray-200 dark:border-gray-700">
                {{ $slot }}
            </div>
        </div>

        <footer class="py-4 text-center text-xs text-gray-500 dark:text-gray-400">
            &copy; {{ date('Y') }} Jurnal Harian PKL. All rights reserved.
        </footer>
    </body>
</html>