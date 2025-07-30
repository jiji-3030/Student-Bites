@extends('layouts.app')

@section('content')
    <div class="py-12 px-4 max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold mb-4">📝 Create a Post</h2>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Category -->
            <div>
                <label for="category" class="block text-sm font-medium">Category</label>
                <select name="category" id="category" class="w-full border rounded px-3 py-2" required>
                    <option value="">Select a Category</option>
                    <option value="quick recipes">Quick Recipes</option>
                    <option value="no-cook meals">No-Cook Meals</option>
                    <option value="leftover hacks">Leftover Hacks</option>
                    <option value="budget meals">Budget Meals</option>
                    <option value="5-ingredient recipes">5-Ingredient Recipes</option>
                </select>
            </div>
            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium">Title</label>
                <input type="text" name="title" id="title" class="w-full border rounded px-3 py-2" required>
            </div>


            <!-- Body -->
            <div>
                <label for="body" class="block text-sm font-medium">Body</label>
                <textarea name="body" id="body" rows="5" class="w-full border rounded px-3 py-2" required></textarea>
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-sm font-medium">Upload Image</label>
                <input type="file" name="image" id="image" accept="image/*" class="w-full border rounded px-3 py-2">
            </div>

            <!-- Submit -->
            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Upload Post
                </button>
            </div>
        </form>
    </div>
@endsection
