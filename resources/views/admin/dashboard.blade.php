@extends('layouts.app')

@section('content')
<div
    x-data="{
        tab: 'posts',
        showModal: false,
        showDeleteModal: false,
        activePost: {}
    }"
    class="max-w-6xl mx-auto px-4 py-8 font-sans"
    x-cloak
>

    {{-- 🔘 Tabs --}}
    <div class="flex justify-center space-x-4 mb-8">
        <button @click="tab = 'stats'"
            :class="tab === 'stats' ? 'bg-green-700 text-white' : 'bg-green-100 text-green-700'"
            class="px-4 py-2 rounded-full font-semibold transition-all">
            📊 Stats
        </button>
        <button @click="tab = 'posts'"
            :class="tab === 'posts' ? 'bg-green-700 text-white' : 'bg-green-100 text-green-700'"
            class="px-4 py-2 rounded-full font-semibold transition-all">
            📝 Posts
        </button>
    </div>

    {{-- 🔽 Category Filter --}}
    <div x-show="tab === 'posts'" class="flex justify-end mb-6">
        <form method="GET" action="{{ route('admin') }}" class="flex items-center space-x-2">
            <label for="category" class="text-sm font-medium text-gray-700 dark:text-gray-200">Filter:</label>
            <select name="category" id="category"
                onchange="this.form.submit()"
                class="rounded-md border border-green-100 bg-white text-green-900 px-3 py-1.5 text-sm focus:ring-green-500 focus:border-green-500 dark:bg-green-950 dark:text-white shadow-inner">
                <option value="">All</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat }}" {{ $cat === $category ? 'selected' : '' }}>
                        {{ ucfirst($cat) }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    {{-- 📊 Stats Tab --}}
    <div x-show="tab === 'stats'" x-transition>
    <section class="bg-[#2e4d2e] dark:bg-[#1e1e1e] p-10 rounded-3xl shadow-xl border border-white/10 dark:border-white/20 mb-10 text-center animate-fade-in">
        <h1 class="text-3xl font-bold text-white uppercase tracking-wide">Admin Dashboard</h1>
        <p class="text-green-100 mt-2 font-medium text-sm">Manage your platform effectively</p>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- 👥 Total Users --}}
        <div class="relative bg-green-50 dark:bg-green-900 p-6 rounded-3xl shadow-md aspect-square flex flex-col justify-center items-center hover:scale-105 transition-transform duration-300 ease-in-out group">
            <div class="absolute top-4 right-4 bg-green-100 dark:bg-green-800 p-3 rounded-full shadow-md">
                <svg class="w-10 h-10 text-green-700 dark:text-green-300" fill="none" stroke="currentColor" stroke-width="1.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 110-8 4 4 0 010 8zm6 4a4 4 0 00-3-3.87" />
                </svg>
            </div>
            <p class="text-md text-green-700 dark:text-green-200 font-medium mb-2">Total Users</p>
            <p class="text-6xl font-extrabold text-green-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-300">{{ $users->count() }}</p>
        </div>

        {{-- 📝 Total Posts --}}
        <div class="relative bg-green-50 dark:bg-green-900 p-6 rounded-3xl shadow-md aspect-square flex flex-col justify-center items-center hover:scale-105 transition-transform duration-300 ease-in-out group">
            <div class="absolute top-4 right-4 bg-green-100 dark:bg-green-800 p-3 rounded-full shadow-md">
                <svg class="w-10 h-10 text-green-700 dark:text-green-300" fill="none" stroke="currentColor" stroke-width="1.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 21H5a2 2 0 01-2-2V7a2 2 0 012-2h4l2-2h6a2 2 0 012 2v14a2 2 0 01-2 2z" />
                </svg>
            </div>
            <p class="text-md text-green-700 dark:text-green-200 font-medium mb-2">Total Posts</p>
            <p class="text-6xl font-extrabold text-green-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-300">{{ $posts->count() }}</p>
        </div>
    </div>
</div>





    {{-- 📄 Posts Tab --}}
    <div x-show="tab === 'posts'" x-transition>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <div class="bg-white dark:bg-[#2e4d2e] rounded-xl shadow hover:shadow-lg transition">
                    @php
                        $map = [
                            'budget meals' => 'budget.png',
                            'leftover hacks' => 'leftover.png',
                            '5-ingredient recipes' => 'five.png',
                            'no-cook meals' => 'nocook.png',
                            'quick recipes' => 'quick.png',
                        ];

                        $filename = $map[strtolower($post->category)] ?? 'default.png';
                        $image = asset('images/defaults/' . $filename);
                    @endphp
                    <img src="{{ $image }}" alt="{{ $post->title }}" class="w-full h-40 object-cover rounded-t-xl">
                    <div class="p-4 space-y-2">
                        <h2 class="text-lg font-bold text-gray-800 dark:text-white">{{ $post->title }}</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ Str::limit($post->body, 80) }}</p>
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            by {{ $post->user->name ?? 'Unknown' }}
                        </div>

                        <div class="flex justify-between items-center mt-3 space-x-2">
                            {{-- 🔍 View --}}
                            <button @click="activePost = {{ $post->toJson() }}; showModal = true"
                                class="text-blue-600 hover:underline text-sm font-medium flex items-center gap-1">
                                🔍 View
                            </button>

                            {{-- 🗑 Delete --}}
                            <button @click="activePost = {{ $post->toJson() }}; showDeleteModal = true"
                                class="text-red-500 hover:underline text-sm font-medium flex items-center gap-1">
                                🗑 Delete
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- 🔍 View Modal --}}
    <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50" x-transition>
        <div class="bg-white dark:bg-gray-800 w-full max-w-xl p-6 rounded-lg shadow-lg relative" @click.away="showModal = false">
            <button class="absolute top-2 right-2 text-gray-600 dark:text-gray-300 text-2xl" @click="showModal = false">&times;</button>

            <template x-if="activePost">
                <div>
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-2" x-text="activePost.title"></h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300 whitespace-pre-line mb-4" x-text="activePost.body || 'No description.'"></p>
                    <p class="text-xs mt-4 text-gray-500 dark:text-gray-400">
                        Posted by <span x-text="activePost.user?.name || 'Anonymous'"></span>
                    </p>
                </div>
            </template>
        </div>
    </div>

    {{-- 🗑 Delete Modal --}}
    <div x-show="showDeleteModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50" x-transition>
        <div class="bg-white dark:bg-[#2e4d2e] w-full max-w-md p-6 rounded-lg shadow-lg relative" @click.away="showDeleteModal = false">
            <button class="absolute top-2 right-2 text-gray-600 dark:text-gray-300 text-2xl" @click="showDeleteModal = false">&times;</button>

            <h2 class="text-2xl font-bold text-red-600 mb-4">Delete Post</h2>
            <p class="text-gray-700 dark:text-gray-300 mb-4">
                Are you sure you want to delete <span class="font-semibold" x-text="activePost.title"></span>?
            </p>

            <div class="flex justify-end space-x-3">
                <button @click="showDeleteModal = false"
                    class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-sm rounded hover:bg-gray-300 dark:hover:bg-gray-600">
                    Cancel
                </button>

                <form :action="'/posts/' + activePost.id" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                        Confirm Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- ✅ Success Toast --}}
    @if(session('success'))
        <div x-data="{ showToast: true }" x-init="setTimeout(() => showToast = false, 3000)" x-show="showToast"
             x-transition class="fixed bottom-5 right-5 bg-green-600 text-white px-4 py-2 rounded-lg shadow-xl z-50">
            {{ session('success') }}
        </div>
    @endif

</div>
@endsection
