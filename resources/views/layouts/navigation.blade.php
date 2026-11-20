<nav x-data="{ 
    open: false, 
    theme: localStorage.getItem('theme') || 'light',
    setTheme(val) {
        this.theme = val;
        localStorage.setItem('theme', val);
        document.documentElement.classList.remove('dark', 'theme-pink');
        if (val === 'dark') {
            document.documentElement.classList.add('dark');
        } else if (val === 'pink') {
            document.documentElement.classList.add('theme-pink');
        }
    }
}" x-init="setTheme(theme)" class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 transition-colors relative z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="font-extrabold text-xl text-indigo-600 dark:text-indigo-400">
                        Jurnal PKL
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Beranda') }}
                    </x-nav-link>

                    @auth
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>

                        @if(optional(Auth::user())->isPembimbing())
                            <x-nav-link :href="route('pembimbing.monitoring')" :active="request()->routeIs('pembimbing.monitoring')">
                                {{ __('Monitoring Peserta') }}
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('jurnal.index')" :active="request()->routeIs('jurnal.*')">
                                {{ __('Jurnal Harian') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown / Profile & Theme Selector -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-3">
                
                <!-- Select Mode Tema (Teks Hitam Pekat di Light Mode, Teks Pink Gelap di Pink Mode) -->
                <div class="relative">
                    <select x-model="theme" @change="setTheme($event.target.value)" class="text-xs font-black py-1.5 px-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500 cursor-pointer shadow-sm">
                        <option value="light" class="text-gray-900 font-bold">☀️ Mode Light</option>
                        <option value="dark" class="text-gray-900 dark:text-gray-100 font-bold">🌙 Mode Dark</option>
                        <option value="pink" class="text-pink-950 font-bold">🌸 Mode Pink</option>
                    </select>
                </div>

                @auth
                    <!-- Dropdown Profile User -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-700 text-sm font-extrabold rounded-xl text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 hover:text-indigo-600 dark:hover:text-indigo-400 focus:outline-none transition space-x-2 shadow-sm">
                                <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-300 flex items-center justify-center bg-indigo-600 text-white font-bold text-xs uppercase shadow">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="w-full h-full object-cover" alt="Avatar">
                                    @else
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    @endif
                                </div>
                                <span class="max-w-[120px] truncate text-gray-900 dark:text-gray-100 font-black">{{ Auth::user()->name }}</span>
                                <svg class="fill-current h-4 w-4 ms-1 shrink-0 text-gray-700 dark:text-gray-300" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-800">
                                <p class="text-[10px] text-gray-500 uppercase font-bold">Login Sebagai:</p>
                                <p class="text-xs font-black text-indigo-600 dark:text-indigo-400 capitalize">{{ Auth::user()->role }}</p>
                            </div>

                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Pengaturan Profil') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="space-x-2 ms-2">
                        <a href="{{ route('login') }}" class="text-xs text-gray-900 dark:text-gray-100 hover:text-indigo-600 font-bold px-3 py-2">Log in</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-xs font-bold shadow">Register</a>
                    </div>
                @endauth
            </div>

            <!-- Mobile Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-xl text-gray-500 hover:text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>