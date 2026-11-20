<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Selamat Datang</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Masuk ke akun Jurnal PKL Anda</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Email</label>
            <input id="email" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Password</label>
            <input id="password" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between text-sm">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-800" name="remember">
                <span class="ms-2 text-gray-600 dark:text-gray-400">Ingat Saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-indigo-600 dark:text-indigo-400 hover:underline font-medium" href="{{ route('password.request') }}">
                    Lupa Password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Masuk (Log In)
            </button>
        </div>
    </form>
</x-guest-layout>