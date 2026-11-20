<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-xl text-gray-900 dark:text-gray-100 leading-tight">
            {{ __('Beranda Utama') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @guest
                <!-- Beranda Sebelum Login (Guest) -->
                <div class="relative overflow-hidden card-banner rounded-3xl p-8 sm:p-12 border shadow-lg transition-colors">
                    <div class="max-w-3xl space-y-6">
                        <div class="inline-flex items-center space-x-2 px-3.5 py-1 rounded-full bg-indigo-600 text-white text-xs font-black">
                            <span>🚀 Sistem Informasi Jurnal PKL</span>
                        </div>
                        <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight text-banner-title">
                            Kelola & Pantau Jurnal Harian PKL Secara Terstruktur
                        </h1>
                        <p class="text-banner-desc text-sm sm:text-base font-semibold leading-relaxed">
                            Platform resmi pencatatan jurnal kegiatan harian Praktik Kerja Lapangan (PKL) PT Metanouva Informatika. Memudahkan koordinasi antara peserta dan pembimbing dalam satu sistem terpadu.
                        </p>
                        <div class="flex flex-wrap gap-4 pt-2">
                            <a href="{{ route('login') }}" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-xl text-sm shadow-lg transition">
                                Masuk ke Akun (Log In)
                            </a>
                            <a href="{{ route('register') }}" class="px-6 py-3 bg-gray-100 dark:bg-slate-800 hover:bg-gray-200 dark:hover:bg-slate-700 text-gray-900 dark:text-gray-100 font-bold rounded-xl text-sm border border-gray-300 dark:border-slate-600 transition">
                                Daftar Akun Baru
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Feature Highlights -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="bg-white dark:bg-gray-900 p-6 rounded-2xl border border-gray-300 dark:border-gray-800 shadow-sm">
                        <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-950 text-indigo-700 dark:text-indigo-400 rounded-xl flex items-center justify-center font-bold text-2xl mb-4">📖</div>
                        <h3 class="text-base font-black text-gray-900 dark:text-white mb-2">Pencatatan Jurnal Harian</h3>
                        <p class="text-xs text-gray-700 dark:text-gray-400 font-medium">Peserta dapat mencatat kegiatan harian, kategori tugas, status progress, hingga melampirkan foto bukti kegiatan.</p>
                    </div>

                    <div class="bg-white dark:bg-gray-900 p-6 rounded-2xl border border-gray-300 dark:border-gray-800 shadow-sm">
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-950 text-purple-700 dark:text-purple-400 rounded-xl flex items-center justify-center font-bold text-2xl mb-4">👨‍🏫</div>
                        <h3 class="text-base font-black text-gray-900 dark:text-white mb-2">Monitoring & Feedback</h3>
                        <p class="text-xs text-gray-700 dark:text-gray-400 font-medium">Pembimbing dapat memantau jurnal peserta secara real-time dan memberikan catatan bimbingan atau masukan.</p>
                    </div>

                    <div class="bg-white dark:bg-gray-900 p-6 rounded-2xl border border-gray-300 dark:border-gray-800 shadow-sm">
                        <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-400 rounded-xl flex items-center justify-center font-bold text-2xl mb-4">📄</div>
                        <h3 class="text-base font-black text-gray-900 dark:text-white mb-2">Rekapitulasi PDF</h3>
                        <p class="text-xs text-gray-700 dark:text-gray-400 font-medium">Cetak dan ekspor laporan rekapitulasi jurnal harian ke format PDF dengan mudah untuk keperluan administrasi PKL.</p>
                    </div>
                </div>
            @endguest

            @auth
                <!-- Beranda Setelah Login (Auth) -->
                @if(Auth::user()->isPembimbing())
                    <!-- Kartu Pembimbing -->
                    <div class="card-banner rounded-3xl p-8 sm:p-10 shadow-lg space-y-4 border transition-colors">
                        <div class="inline-flex items-center space-x-2 px-3.5 py-1 rounded-full bg-purple-600 text-white text-xs font-black">
                            <span>👨‍🏫 Portal Akun Pembimbing</span>
                        </div>
                        <h1 class="text-3xl font-black text-banner-title">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                        <p class="text-banner-desc text-sm max-w-2xl font-bold leading-relaxed">
                            Anda masuk sebagai <span class="font-black text-indigo-600 dark:text-indigo-400 underline">Pembimbing PKL</span>. Pantau aktivitas harian peserta dan berikan arahan atau catatan bimbingan secara langsung.
                        </p>
                        <div class="pt-2 flex flex-wrap gap-3">
                            <a href="{{ route('pembimbing.monitoring') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-xl text-sm shadow transition">
                                👥 Monitoring Peserta
                            </a>
                            <a href="{{ route('dashboard') }}" class="px-5 py-2.5 bg-gray-100 dark:bg-slate-800 hover:bg-gray-200 dark:hover:bg-slate-700 text-gray-900 dark:text-slate-200 font-extrabold rounded-xl text-sm border border-gray-300 dark:border-slate-700 transition">
                                📊 Dashboard Ringkasan
                            </a>
                        </div>
                    </div>
                @else
                    <!-- Kartu Peserta -->
                    <div class="card-banner rounded-3xl p-8 sm:p-10 shadow-lg space-y-4 border transition-colors">
                        <div class="inline-flex items-center space-x-2 px-3.5 py-1 rounded-full bg-indigo-600 text-white text-xs font-black">
                            <span>🎓 Portal Akun Peserta</span>
                        </div>
                        <h1 class="text-3xl font-black text-banner-title">Halo, {{ Auth::user()->name }}! 👋</h1>
                        <p class="text-banner-desc text-sm max-w-2xl font-bold leading-relaxed">
                            Siap mencatat jurnal harian kamu hari ini? Pastikan kegiatan terisi dengan rapi agar mempermudah rekapitulasi laporan akhir PKL.
                        </p>
                        <div class="pt-2 flex flex-wrap gap-3">
                            <a href="{{ route('jurnal.create') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-xl text-sm shadow transition">
                                + Tambah Jurnal Hari Ini
                            </a>
                            <a href="{{ route('jurnal.index') }}" class="px-5 py-2.5 bg-gray-100 dark:bg-slate-800 hover:bg-gray-200 dark:hover:bg-slate-700 text-gray-900 dark:text-slate-200 font-extrabold rounded-xl text-sm border border-gray-300 dark:border-slate-700 transition">
                                📖 Lihat Jurnal Saya
                            </a>
                        </div>
                    </div>
                @endif
            @endauth

        </div>
    </div>
</x-app-layout>