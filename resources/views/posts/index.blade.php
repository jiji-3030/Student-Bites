@extends('layouts.app')

@section('content')
<div x-data="{ showModal: false, activePost: {} }" class="max-w-6xl mx-auto px-4 py-8 font-sans">

{{-- 🏠 Hero Section --}}
<section
  class="bg-[#2e4d2e] dark:bg-[#1e1e1e] p-10 rounded-3xl shadow-xl border border-white/10 dark:border-white/20 mb-10 text-center animate-fade-in"
>
  <h1
    class="text-7xl font-extrabold text-white dark:text-green-300 tracking-wide uppercase drop-shadow-sm mb-4"
    style="font-family: 'Permanent Marker', cursive;"
  >
    Student Bites
  </h1>
  <p class="text-2xl text-white dark:text-green-100 font-semibold tracking-wide mt-3" style="font-family: 'Comic Neue', cursive;">
    Fast. Affordable. Delicious.
  </p>
  <p class="text-lg text-white/90 dark:text-white/70 italic mt-1" style="font-family: 'Comic Neue', cursive;">
    Designed for your student hustle.
  </p>
</section>



    {{-- 🔽 Category Filter --}}
    <form method="GET" action="{{ route('posts.index') }}" class="mb-6">
        <div class="flex flex-wrap justify-between items-center gap-4">
            {{-- Filter Dropdown (Left) --}}
            <div class="flex items-center gap-2">
                <label for="category" class="text-sm font-medium text-gray-700 dark:text-gray-200">Filter by category:</label>
                <select name="category" id="category"
                  class="rounded-md border border-green-100 bg-white-100 text-green-900 px-3 py-2 text-sm focus:ring-green-500 focus:border-green-500 dark:bg-green-950 dark:text-white shadow-inner"
                    onchange="this.form.submit()">
                    <option value="">All</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>
                            {{ ucfirst($category) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- 🍳 Add Recipe Button (Right) --}}
            @auth
            <a href="{{ route('posts.create') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#355e3b] hover:bg-[#4b7d5b] text-white font-semibold text-sm shadow-md transition-all duration-300">
                🍳 Add Recipe
            </a>
            @endauth
        </div>
    </form>



    {{-- 🧑‍🍳 Post Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($posts as $post)
            @php
                $categoryThemes = [
                    'quick recipes' => ['bg' => 'bg-green-400', 'emoji' => '⚡'],
                    'no-cook meals' => ['bg' => 'bg-yellow-300', 'emoji' => '🥗'],
                    'leftover hacks' => ['bg' => 'bg-purple-300', 'emoji' => '♻️'],
                    'budget meals' => ['bg' => 'bg-blue-300', 'emoji' => '💰'],
                    '5-ingredient recipes' => ['bg' => 'bg-red-300', 'emoji' => '⏱'],
                ];
                $defaultImages = [
                    'quick recipes' => asset('images/defaults/quick.png'),
                    'no-cook meals' => asset('images/defaults/nocook.png'),
                    'leftover hacks' => asset('images/defaults/leftover.png'),
                    'budget meals' => asset('images/defaults/budget.png'),
                    '5-ingredient recipes' => asset('images/defaults/five.png'),
                ];

                $category = $post->category ?? 'Unknown';
                $theme = $categoryThemes[strtolower($category)] ?? ['bg' => 'bg-gray-300', 'emoji' => '🍽️'];
                $liked = $post->likes->contains('user_id', auth()->id());
                $image = $post->image ? asset('storage/' . $post->image) : asset('images/defaults/' . str_replace(' ', '', $post->category) . '.png');
            @endphp

            <div class="bg-white dark:bg-[#2e4d2e] rounded-xl shadow hover:shadow-xl transition">
                @php
                $image = $post->image
                    ? asset('storage/' . $post->image)
                    : ($defaultImages[$post->category] ?? asset('images/defaults/default.jpg'));
            @endphp

            <img src="{{ $image }}" alt="{{ $post->title }}" class="w-full h-40 object-cover rounded-t-xl">
                <div class="p-4 space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-semibold px-2 py-1 rounded-full text-white {{ $theme['bg'] }}">
                            {{ $theme['emoji'] }} {{ ucwords($post->category) }}
                        </span>
                        <span class="text-xs text-gray-400">by {{ $post->user->name ?? 'Anonymous' }}</span>
                    </div>
                    <h2 class="text-lg font-bold text-gray-800 dark:text-white">
                        {{ $post->title }}
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        {{ Str::limit($post->body, 80) }}
                    </p>
{{-- 🔘 Buttons --}}
                    <div class="flex justify-between items-center mt-3 space-x-2 flex-wrap">
                        {{-- 👁 View --}}
                        <button @click="activePost = {{ $post->toJson() }}; showModal = true"
                            class="text-blue-600 hover:underline text-sm font-medium flex items-center gap-1">
                            🔍 View
                        </button>
                        <!-- Modal -->
    <x-modal name="view-post-modal" :show="false">
        <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">
                {{ $post->title }}
            </h2>

            <image_url: @json($post->image ? asset('storage/' . $post->image) : '')
                alt="Post Image"
                class="w-full h-auto rounded-lg mb-4">

            <p class="text-gray-700 dark:text-gray-300">
                {{ $post->body }}
            </p>
        </div>
    </x-modal>


                        {{-- ❤️ Like --}}
                        <form method="POST" action="{{ route('posts.like', $post) }}">
                            @csrf
                            <button type="submit"
                                class="text-sm font-medium flex items-center gap-1 transition-colors duration-150
                                    {{ $liked ? 'text-pink-500 hover:text-pink-600' : 'text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' }}">
                                {{ $liked ? '❤️' : '🤍' }} {{ $post->likes->count() }}
                            </button>
                        </form>

                        @auth
                        @if(auth()->id() === $post->user_id)
                            {{-- ✏️ Edit --}}
                            <a href="{{ route('posts.edit', $post) }}"
                                class="text-yellow-500 hover:underline text-sm font-medium flex items-center gap-1">
                                ✏️ Edit
                            </a>

                            {{-- 🗑 Delete --}}
                            <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-500 hover:underline text-sm font-medium flex items-center gap-1">
                                    🗑 Delete
                                </button>
                            </form>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-600 dark:text-gray-300 col-span-full">No posts found for this category.</p>
        @endforelse
    </div>

    {{-- 📄 Pagination--}}
    <div class="mt-10">
        <div class="flex justify-center">
            <div class="bg-white dark:bg-gray-800 px-6 py-4 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">
                {{ $posts->withQueryString()->links('pagination::tailwind') }}
            </div>
        </div>
    </div>

    {{-- 🔍 Modal View --}}
    <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50"
    x-transition style="display: none;">
    <div class="bg-white dark:bg-gray-800 w-full max-w-xl p-6 rounded-lg shadow-lg relative"
        @click.away="showModal = false">

        <!-- Close Button -->
        <button class="absolute top-2 right-2 text-gray-600 dark:text-gray-300 text-2xl"
            @click="showModal = false">&times;</button>

        <!-- Modal Content -->
        <template x-if="activePost">
            <div>
                <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-2"
                    x-text="activePost.title"></h2>

                <p class="text-sm text-gray-600 dark:text-gray-300 whitespace-pre-line mb-4"
                    x-text="activePost.body || 'No instructions provided.'"></p>

                <p class="text-xs mt-4 text-gray-500 dark:text-gray-400">
                    Posted by <span x-text="activePost.user?.name || 'Anonymous'"></span>
                </p>
            </div>
        </template>
    </div>
</div>

</div>
@endsection
