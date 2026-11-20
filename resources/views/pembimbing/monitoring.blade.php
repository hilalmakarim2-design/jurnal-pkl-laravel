<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Monitoring Jurnal Peserta PKL') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white dark:bg-gray-900 p-6 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Daftar Peserta PKL</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @forelse($pesertas as $peserta)
                        <div class="p-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/50 flex items-center justify-between">
                            <div>
                                <h4 class="font-bold text-gray-900 dark:text-white text-sm">{{ $peserta->name }}</h4>
                                <p class="text-xs text-gray-500">{{ $peserta->email }}</p>
                            </div>
                            <a href="{{ route('jurnal.index', ['user_id' => $peserta->id]) }}" class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-xs font-semibold shadow">
                                Lihat Jurnal
                            </a>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 col-span-3 text-center">Belum ada akun peserta terdaftar.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>