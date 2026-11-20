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
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
    /* CSS Khusus Mode Pink */
    html.theme-pink body {
        background-color: #fdf2f8 !important;
        color: #831843 !important;
    }
    html.theme-pink .card-banner {
        background-color: #fff1f2 !important;
        border-color: #f472b6 !important;
    }
    html.theme-pink .text-banner-title {
        color: #831843 !important;
    }
    html.theme-pink .text-banner-desc {
        color: #9d174d !important;
    }

    /* CSS Khusus Mode Light */
    html:not(.dark):not(.theme-pink) body {
        background-color: #f8fafc !important;
        color: #0f172a !important;
    }
    html:not(.dark):not(.theme-pink) .card-banner {
        background-color: #ffffff !important;
        border-color: #cbd5e1 !important;
    }
    html:not(.dark):not(.theme-pink) .text-banner-title {
        color: #0f172a !important;
    }
    html:not(.dark):not(.theme-pink) .text-banner-desc {
        color: #334155 !important;
    }

    /* CSS Khusus Mode Dark (Kembali Sempurna Bawaan Tailwind) */
    html.dark .card-banner {
        background-color: #0f172a !important;
        border-color: #1e293b !important;
    }
    html.dark .text-banner-title {
        color: #ffffff !important;
    }
    html.dark .text-banner-desc {
        color: #e2e8f0 !important;
    }
</style>
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors min-h-screen">
        <div class="min-h-screen">
            @include('layouts.navigation')

            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow border-b border-gray-200 dark:border-gray-700">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>