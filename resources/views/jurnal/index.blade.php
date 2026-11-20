<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ Auth::user()->isPembimbing() ? __('Monitoring Jurnal Peserta PKL') : __('Daftar Jurnal Harian Saya') }}
            </h2>
            @if(Auth::user()->isPeserta())
                <a href="{{ route('jurnal.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow transition">
                    + TAMBAH JURNAL
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-10" x-data="{ openModal: false, selectedJurnal: {} }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 bg-green-100 dark:bg-green-900/50 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300 rounded-2xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Search, Filter Tanggal, Status, & Kategori -->
            <form method="GET" action="{{ route('jurnal.index') }}" class="bg-white dark:bg-gray-900 p-4 rounded-2xl border border-gray-200 dark:border-gray-800 grid grid-cols-1 md:grid-cols-5 gap-3 text-sm">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Judul..." class="rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white text-xs">
                
                <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white text-xs">

                <select name="status" class="rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white text-xs">
                    <option value="">Semua Status</option>
                    <option value="todo" {{ request('status') == 'todo' ? 'selected' : '' }}>Todo</option>
                    <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>

                <select name="kategori_id" class="rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white text-xs">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id }}" {{ request('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                    @endforeach
                </select>

                <div class="flex space-x-2">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl text-xs py-2">Filter</button>
                    <a href="{{ route('jurnal.index') }}" class="w-full text-center bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-xl text-xs py-2 flex items-center justify-center">Reset</a>
                </div>
            </form>

            <!-- Table Daftar Jurnal -->
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-800/50 text-xs font-semibold text-gray-500 uppercase border-b border-gray-200 dark:border-gray-800">
                                <th class="p-4">TANGGAL</th>
                                @if(Auth::user()->isPembimbing())
                                    <th class="p-4">PESERTA</th>
                                @endif
                                <th class="p-4">KATEGORI</th>
                                <th class="p-4">KEGIATAN & DESKRIPSI</th>
                                <th class="p-4">STATUS</th>
                                <th class="p-4">CATATAN PEMBIMBING</th>
                                <th class="p-4 text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-800 text-sm">
                            @forelse($jurnals as $j)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                    <td class="p-4 text-gray-600 dark:text-gray-400 font-medium whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($j->tanggal)->format('d M Y') }}
                                    </td>
                                    @if(Auth::user()->isPembimbing())
                                        <td class="p-4 font-bold text-indigo-600 dark:text-indigo-400">
                                            {{ $j->user->name }}
                                        </td>
                                    @endif
                                    <td class="p-4 text-gray-600 dark:text-gray-400 font-medium whitespace-nowrap">
                                        <span class="px-2.5 py-1 bg-indigo-50 dark:bg-indigo-950 text-indigo-600 dark:text-indigo-400 rounded-lg text-xs font-semibold">
                                            {{ $j->kategori?->nama ?? 'Tanpa Kategori' }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <div class="font-bold text-gray-900 dark:text-white">{{ $j->judul }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 line-clamp-2">{{ $j->deskripsi }}</div>
                                    </td>
                                    <td class="p-4 whitespace-nowrap">
                                        @if(strtolower($j->status) === 'selesai')
                                            <span class="px-3 py-1 text-xs font-bold bg-green-100 text-green-700 dark:bg-green-950 dark:text-green-300 rounded-full">SELESAI</span>
                                        @elseif(strtolower($j->status) === 'proses')
                                            <span class="px-3 py-1 text-xs font-bold bg-amber-100 text-amber-700 dark:bg-amber-950 dark:text-amber-300 rounded-full">PROSES</span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-bold bg-gray-200 text-gray-700 dark:bg-gray-800 dark:text-gray-300 rounded-full">TODO</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-xs font-semibold text-purple-600 dark:text-purple-400 whitespace-nowrap">
                                        💬 {{ $j->komentars->count() }} Catatan
                                    </td>
                                    <td class="p-4 text-center whitespace-nowrap space-x-2">
                                        <button @click="selectedJurnal = {
                                                    id: {{ $j->id }},
                                                    judul: '{{ addslashes($j->judul) }}',
                                                    peserta: '{{ addslashes($j->user->name) }}',
                                                    deskripsi: '{{ addslashes($j->deskripsi) }}',
                                                    komentars: {{ json_encode($j->komentars) }}
                                                }; openModal = true" 
                                                class="text-xs px-3 py-1.5 bg-indigo-600 text-white font-semibold rounded-lg shadow">
                                            {{ Auth::user()->isPembimbing() ? '💬 Beri Catatan' : '🔍 Lihat Catatan' }}
                                        </button>

                                        @if(Auth::user()->isPeserta())
                                            <a href="{{ route('jurnal.edit', $j->id) }}" class="text-xs px-3 py-1.5 bg-indigo-50 text-indigo-600 dark:bg-indigo-950 dark:text-indigo-400 font-semibold rounded-lg">Edit</a>
                                            <form action="{{ route('jurnal.destroy', $j->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus jurnal ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs px-3 py-1.5 bg-red-50 text-red-600 dark:bg-red-950 dark:text-red-400 font-semibold rounded-lg">Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ Auth::user()->isPembimbing() ? 7 : 6 }}" class="p-6 text-center text-gray-500 text-sm">Belum ada jurnal harian.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t border-gray-200 dark:border-gray-800">
                    {{ $jurnals->links() }}
                </div>
            </div>

            <!-- Modal Komentar & Catatan Pembimbing -->
            <div x-show="openModal" x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50" style="display: none;">
                <div @click.away="openModal = false" class="bg-white dark:bg-gray-900 rounded-2xl max-w-lg w-full p-6 shadow-xl border border-gray-200 dark:border-gray-800 space-y-4">
                    <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-800 pb-3">
                        <div>
                            <h3 class="font-bold text-lg text-gray-900 dark:text-white" x-text="selectedJurnal.judul"></h3>
                            <p class="text-xs text-indigo-600 dark:text-indigo-400">Peserta: <span x-text="selectedJurnal.peserta"></span></p>
                        </div>
                        <button @click="openModal = false" class="text-gray-400 hover:text-gray-600 font-bold">×</button>
                    </div>

                    <div class="space-y-2 max-h-48 overflow-y-auto pr-1">
                        <p class="text-xs font-bold text-gray-700 dark:text-gray-300">Riwayat Catatan Pembimbing:</p>
                        <template x-for="k in selectedJurnal.komentars" :key="k.id">
                            <div class="p-3 rounded-xl bg-purple-50 dark:bg-purple-950/50 border border-purple-200 dark:border-purple-800 text-xs">
                                <p class="text-gray-800 dark:text-gray-200" x-text="k.isi"></p>
                                <span class="text-[10px] text-purple-600 dark:text-purple-400 font-semibold mt-1 block" x-text="new Date(k.created_at).toLocaleString('id-ID')"></span>
                            </div>
                        </template>
                        <template x-if="!selectedJurnal.komentars || selectedJurnal.komentars.length === 0">
                            <p class="text-xs text-gray-400 italic">Belum ada catatan dari pembimbing.</p>
                        </template>
                    </div>

                    @if(Auth::user()->isPembimbing())
                        <form :action="'/jurnal/' + selectedJurnal.id + '/komentar'" method="POST" class="space-y-3 pt-3 border-t border-gray-200 dark:border-gray-800">
                            @csrf
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Tambah Catatan Bimbingan Baru:</label>
                                <textarea name="isi" rows="3" class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 text-xs" placeholder="Tuliskan arahan atau catatan bimbingan..." required></textarea>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold shadow">Kirim Catatan</button>
                            </div>
                        </form>
                    @endif

                    <div class="pt-2 text-right">
                        <button @click="openModal = false" class="px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-xl font-semibold text-xs">Tutup</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>