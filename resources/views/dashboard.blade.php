<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-xl text-gray-900 dark:text-gray-100 leading-tight">
            {{ Auth::user()->isPembimbing() ? __('Dashboard Monitoring Pembimbing') : __('Dashboard Ringkasan Peserta') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if(Auth::user()->isPembimbing())
                <!-- Banner Pembimbing (Warna Gelap Solid & Teks Putih Kontras Tajam) -->
                <div class="bg-slate-900 text-white rounded-3xl p-8 shadow-xl border border-slate-800 space-y-3">
                    <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-purple-500/20 text-purple-300 border border-purple-500/30 text-xs font-bold">
                        <span>👨‍🏫 Portal Akun Pembimbing</span>
                    </div>
                    <h1 class="text-3xl font-black text-white">Selamat Datang, Pembimbing PKL! 👋</h1>
                    <p class="text-slate-200 text-sm max-w-2xl font-semibold leading-relaxed">
                        Anda memiliki wewenang untuk memantau kegiatan harian peserta dan memberikan catatan bimbingan.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <a href="{{ route('pembimbing.monitoring') }}" class="p-6 bg-indigo-600 text-white rounded-3xl shadow-md hover:bg-indigo-700 transition flex justify-between items-center">
                        <div>
                            <h4 class="font-black text-lg">👥 Monitoring Peserta PKL</h4>
                            <p class="text-xs text-indigo-100 font-bold mt-1">Lihat daftar peserta dan kelola catatan jurnal mereka</p>
                        </div>
                        <span class="text-2xl font-bold">→</span>
                    </a>

                    <a href="{{ route('jurnal.export_pdf') }}" class="p-6 bg-slate-900 text-white rounded-3xl shadow-md border border-slate-800 hover:bg-slate-800 transition flex justify-between items-center">
                        <div>
                            <h4 class="font-black text-lg">📄 Export Rekap PDF</h4>
                            <p class="text-xs text-slate-200 font-bold mt-1">Cetak laporan rekapitulasi jurnal seluruh peserta</p>
                        </div>
                        <span class="text-2xl font-bold">📥</span>
                    </a>
                </div>

            @else
                <!-- Tampilan Peserta -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="bg-white dark:bg-gray-900 p-6 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm">
                        <p class="text-xs font-black text-gray-600 dark:text-gray-400 uppercase tracking-wider">TOTAL JURNAL SAYA</p>
                        <h3 class="text-3xl font-black text-gray-900 dark:text-white mt-1">{{ $totalJurnal }}</h3>
                    </div>

                    <div class="bg-white dark:bg-gray-900 p-6 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm">
                        <p class="text-xs font-black text-emerald-600 uppercase tracking-wider">SELESAI</p>
                        <h3 class="text-3xl font-black text-emerald-600 dark:text-emerald-400 mt-1">{{ $totalSelesai }}</h3>
                    </div>

                    <div class="bg-white dark:bg-gray-900 p-6 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm">
                        <p class="text-xs font-black text-amber-600 uppercase tracking-wider">PROSES / TODO</p>
                        <h3 class="text-3xl font-black text-amber-600 dark:text-amber-400 mt-1">{{ $totalProses }}</h3>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl border border-gray-200 dark:border-gray-800 shadow-sm space-y-3">
                    <div class="flex justify-between items-center">
                        <h3 class="text-base font-extrabold text-gray-900 dark:text-white">Progres Penyelesaian Jurnal Saya</h3>
                        <span class="text-xl font-black text-indigo-600 dark:text-indigo-400">{{ $persentaseSelesai }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 dark:bg-gray-800 h-3 rounded-full overflow-hidden">
                        <div class="bg-indigo-600 h-full rounded-full transition-all" style="width: {{ $persentaseSelesai }}%"></div>
                    </div>
                </div>

                <div class="flex space-x-4">
                    <a href="{{ route('jurnal.create') }}" class="px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-xl text-sm shadow">
                        + Tambah Jurnal Harian Baru
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>