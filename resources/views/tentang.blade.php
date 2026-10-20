<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tentang Aplikasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-700 space-y-4">
                <h3 class="text-2xl font-bold text-gray-900">Tentang Jurnal PKL</h3>
                <p class="leading-relaxed">
                    Aplikasi <strong>Jurnal Harian PKL</strong> dikembangkan untuk mempermudah peserta magang atau Praktik Kerja Lapangan dalam mendokumentasikan kegiatan harian, kendala teknis, serta rekapitulasi laporan magang secara terdigitalisasi.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>