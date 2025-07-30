@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">✏️ Edit Recipe</h1>

        <form method="POST" action="{{ route('posts.update', $post) }}">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block font-medium">Title</label>
                <input type="text" name="title" id="title" class="w-full border rounded px-3 py-2" value="{{ old('title', $post->title) }}" required>
            </div>

            <!-- Category -->
            <div class="mb-4">
                <label for="category" class="block font-medium">Category</label>
                <input type="text" name="category" id="category" class="w-full border rounded px-3 py-2" value="{{ old('category', $post->category) }}" required>
            </div>

            <!-- Body -->
            <div class="mb-4">
                <label for="body" class="block font-medium">Recipe</label>
                <textarea name="body" id="body" rows="6" class="w-full border rounded px-3 py-2" required>{{ old('body', $post->body) }}</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
@endsection
