<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            {{-- Left: Logo + Dark Mode Toggle --}}
            <div class="flex items-center gap-4">
                <!-- 🍳 Logo / Title -->
                <a href="{{ route('posts.index') }}" class="text-xl font-bold text-green-900 dark:text-green-400">
                    🍳 Student Bites
                </a>

                <!-- 🌗 Dark Mode Toggle -->
                <div x-data="{ darkMode: document.documentElement.classList.contains('dark') }">
                    <button
                        @click="
                            darkMode = !darkMode;
                            document.documentElement.classList.toggle('dark');
                        "
                        class="flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-100 dark:bg-gray-800 text-gray-800 dark:text-white text-sm font-semibold shadow hover:bg-yellow-200 dark:hover:bg-gray-700 transition-colors duration-300"
                    >
                        <span x-text="darkMode ? '🌞 Light Mode' : '🌙 Dark Mode'"></span>
                    </button>
                </div>
            </div>

            {{-- Right: Auth Controls --}}
            <div class="hidden sm:flex items-center gap-4">
                @auth
                    <span class="text-gray-700 dark:text-gray-300">👋 {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-green-900 hover:underline dark:text-green-400">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-pink-600 dark:hover:text-pink-400">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-700 dark:text-gray-300 hover:text-pink-600 dark:hover:text-pink-400">Register</a>
                @endauth
            </div>

            {{-- Hamburger (Mobile) --}}
            <div class="sm:hidden flex items-center">
                <button @click="open = !open" class="p-2 text-gray-400 dark:text-gray-300 hover:text-pink-600 dark:hover:text-pink-400">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('posts.index') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-pink-600 dark:hover:text-pink-400">Recipes</a>
            <a href="{{ route('posts.create') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-pink-600 dark:hover:text-pink-400">Create Post</a>
        </div>
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @auth
                <div class="px-4 text-gray-700 dark:text-gray-300">{{ Auth::user()->name }}</div>
                <form method="POST" action="{{ route('logout') }}" class="mt-3 px-4">
                    @csrf
                    <button class="text-pink-600 hover:underline dark:text-pink-400">Logout</button>
                </form>
            @else
                <div class="px-4">
                    <a href="{{ route('login') }}" class="block text-gray-700 dark:text-gray-300 hover:text-pink-600 dark:hover:text-pink-400 mb-2">Login</a>
                    <a href="{{ route('register') }}" class="block text-gray-700 dark:text-gray-300 hover:text-pink-600 dark:hover:text-pink-400">Register</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
