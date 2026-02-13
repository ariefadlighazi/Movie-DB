<nav
    class="fixed top-0 left-0 right-0 w-full bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm border-b border-gray-200 dark:border-gray-800 z-50 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <a href="{{ route('movie.index') }}" class="flex items-center gap-2 group">
                    <div
                        class="bg-[#F5C518] text-black font-black px-2 py-1 rounded text-lg leading-none group-hover:scale-105 transition-transform">
                        Db
                    </div>
                    <span class="text-xl font-bold text-gray-800 dark:text-white tracking-tight">MovieDB</span>
                </a>

                @auth
                    <div class="hidden md:flex items-center gap-6 text-sm font-medium">
                        <a href="{{ route('movie.index') }}"
                            class="{{ request()->routeIs('movie.index') ? 'text-[#F5C518]' : 'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }} transition-colors">
                            Browse Movies
                        </a>
                        <a href="{{ route('favorites.index') }}"
                            class="{{ request()->routeIs('favorites.index') ? 'text-[#F5C518]' : 'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }} transition-colors">
                            My Favorites
                        </a>
                    </div>
                @endauth
            </div>
            <div class="flex items-center gap-4">
                @auth
                    <div class="hidden md:block text-sm text-gray-600 dark:text-gray-300 text-right">
                        <p class="text-xs text-gray-400">Signed in as</p>
                        <p class="font-semibold">{{ Auth::user()->name }}</p>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="text-sm font-medium text-red-500 hover:text-red-700 dark:hover:text-red-400 border border-transparent hover:border-red-100 rounded-md px-3 py-1.5 transition-colors">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-bold bg-[#F5C518] hover:bg-[#E2B616] text-black px-4 py-2 rounded transition-colors">
                        Log In
                    </a>
                @endauth
            </div>
        </div>
    </div>

    @auth
        <div
            class="md:hidden flex justify-center space-x-6 pb-2 border-t border-gray-100 dark:border-gray-800 pt-2 bg-white dark:bg-gray-900">
            <a href="{{ route('movie.index') }}"
                class="text-xs font-medium {{ request()->routeIs('movie.index') ? 'text-[#F5C518]' : 'text-gray-500' }}">
                Movies
            </a>
            <a href="{{ route('favorites.index') }}"
                class="text-xs font-medium {{ request()->routeIs('favorites.index') ? 'text-[#F5C518]' : 'text-gray-500' }}">
                Favorites
            </a>
        </div>
    @endauth
</nav>
