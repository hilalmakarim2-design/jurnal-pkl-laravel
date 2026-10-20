<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Beranda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Kotak Utama dengan Dukungan Dark Mode -->
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-8 text-center border border-gray-200 dark:border-gray-800 transition-colors">
                <h1 class="text-3xl font-extrabold text-indigo-600 dark:text-indigo-400 mb-4">
                    Sistem Informasi Jurnal Harian PKL
                </h1>
                <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-6 leading-relaxed">
                    Aplikasi pencatatan rekapitulasi kegiatan Praktik Kerja Lapangan (PKL) harian secara terstruktur, terorganisir, dan efisien.
                </p>

                @auth
                    <div class="flex justify-center gap-4">
                        <a href="{{ route('dashboard') }}" class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 shadow transition">
                            Buka Dashboard
                        </a>
                        <a href="{{ route('jurnal.index') }}" class="px-5 py-2.5 text-sm font-medium text-white bg-gray-800 dark:bg-gray-700 rounded-lg hover:bg-gray-900 dark:hover:bg-gray-600 shadow transition">
                            Kelola Jurnal Harian
                        </a>
                    </div>
                @else
                    <div class="flex justify-center gap-4">
                        <a href="{{ route('login') }}" class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 shadow transition">
                            Masuk Ke Akun
                        </a>
                        <a href="{{ route('register') }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                            Daftar Akun Baru
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>