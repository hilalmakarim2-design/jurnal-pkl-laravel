<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Buat Akun Baru</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Daftar untuk membuat Jurnal PKL Harian</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap</label>
            <input id="name" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Email</label>
            <input id="email" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Password</label>
            <input id="password" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Konfirmasi Password</label>
            <input id="password_confirmation" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit & Link -->
        <div class="pt-2 space-y-3">
            <button type="submit" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Daftar Akun
            </button>

            <div class="text-center text-sm">
                <a class="text-indigo-600 dark:text-indigo-400 hover:underline font-medium" href="{{ route('login') }}">
                    Sudah punya akun? Masuk
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>