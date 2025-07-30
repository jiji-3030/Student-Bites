@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 shadow rounded">
    {{-- 🏷 Category badge --}}
    @php
        $themes = [
            'quick recipes' => ['bg' => 'bg-green-400', 'emoji' => '⚡'],
            'no-cook meals' => ['bg' => 'bg-yellow-300', 'emoji' => '🥗'],
            'leftover hacks' => ['bg' => 'bg-purple-300', 'emoji' => '♻️'],
            'budget meals' => ['bg' => 'bg-blue-300', 'emoji' => '💰'],
            '5-ingredient recipes' => ['bg' => 'bg-red-300', 'emoji' => '⏱'],
        ];

        $normalizedCategory = strtolower(trim($post->category));
        $theme = $themes[$normalizedCategory] ?? ['bg' => 'bg-gray-300', 'emoji' => '🍽️'];
    @endphp

    <div class="mb-4">
        <span class="text-xs font-semibold px-3 py-1 rounded-full text-white {{ $theme['bg'] }}">
            {{ $theme['emoji'] }} {{ $post->category }}
        </span>
    </div>

    {{-- 🖼 Image --}}
    @if ($post->image)
        <img src="{{ asset('storage/' . $post->image) }}"
             alt="Post image"
             class="w-full max-h-[400px] object-cover rounded mb-4">
    @else
        <img src="{{ asset('images/defaults/leftover.png') }}"
             alt="Default image"
             class="w-full max-h-[400px] object-cover rounded mb-4">
    @endif

    {{-- 📝 Post content --}}
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $post->title }}</h1>
    <p class="text-gray-700 dark:text-gray-300">{{ $post->body }}</p>

    {{-- 👤 Author --}}
    <div class="text-sm text-gray-500 dark:text-gray-400 mt-6">
        Posted by <span class="font-medium">{{ $post->user->name }}</span> • {{ $post->created_at->diffForHumans() }}
    </div>
</div>
@endsection
