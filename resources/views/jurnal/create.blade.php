<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Jurnal Baru') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6 sm:p-8">
                
                <form action="{{ route('jurnal.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label for="kategori_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Kategori Kegiatan</label>
                        <select name="kategori_id" id="kategori_id" class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 text-sm">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="tanggal" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 text-sm" required>
                        @error('tanggal') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="judul" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Judul Kegiatan</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}" placeholder="Contoh: Belajar Website Laravel" class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 text-sm" required>
                        @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Rincian / Deskripsi Kegiatan</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" placeholder="Jelaskan detail apa saja yang Anda kerjakan hari ini..." class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 text-sm" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Status Pekerjaan</label>
                        <select name="status" id="status" class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 text-sm" required>
                            <option value="todo" {{ old('status') === 'todo' ? 'selected' : '' }}>Todo</option>
                            <option value="proses" {{ old('status') === 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ old('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="kendala" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Kendala (Opsional)</label>
                        <textarea name="kendala" id="kendala" rows="2" placeholder="Tuliskan kendala jika ada..." class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 text-sm">{{ old('kendala') }}</textarea>
                        @error('kendala') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="lampiran" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Unggah Lampiran (Foto / Bukti)</label>
                        <input type="file" name="lampiran" id="lampiran" class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 text-sm p-2">
                        @error('lampiran') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-800">
                        <a href="{{ route('jurnal.index') }}" class="px-5 py-2.5 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 text-gray-700 dark:text-gray-300 rounded-xl font-semibold text-sm transition">
                            Batal
                        </a>
                        <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold text-sm shadow transition">
                            Simpan Jurnal
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>