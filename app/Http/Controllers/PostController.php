<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Show paginated list of posts
    public function index(Request $request)
{
    $query = Post::with('likes'); // 👈 eager load likes

    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('body', 'like', '%' . $request->search . '%');
        });
    }

    $posts = $query->latest()->paginate(6);
    $posts->appends($request->all());

    $categories = Post::pluck('category')->unique()->filter()->values();
    $user = auth()->user(); // 👈 include logged-in user

    return view('posts.index', compact('posts', 'categories', 'user'));
}




    // Show a single post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Show form to create a new post
    public function create()
    {
        $categories = [
            'quick recipes',
            'no-cook meals',
            'leftover hacks',
            'study snacks',
            'budget meals',
        ];

        return view('posts.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $validated['image'] = $path;
        }

        $validated['user_id'] = auth()->id();

        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    // Show form to edit an existing post
    public function edit(Post $post)
    {
        $this->authorize('update', $post);  // Make sure user owns the post
        return view('posts.edit', compact('post'));

    }

    // Update post in database
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'body' => 'required',
        ]);

        $post->update($request->only('title', 'category', 'body'));

        return redirect()->route('posts.index')->with('success', 'Recipe updated successfully!');
    }

    // Delete a post
public function destroy(Post $post)
{

    if (auth()->id() !== $post->user_id && !auth()->user()->hasRole('admin')) {
        abort(403);
    }

    $post->delete();

    // Redirect based on role
    if (auth()->user()->hasRole('admin')) {
        return redirect()->route('admin')->with('success', 'Post deleted successfully.');
    } else {
        return redirect()->route('posts.index')->with('success', 'Your post was deleted.');
    }
}
    public function like(Post $post)
{
    // Ensure the user is authenticated
    if (auth()->check()) {
        $user = auth()->user();

        // Check if already liked
        if ($post->likes()->where('user_id', $user->id)->exists()) {
            return back()->with('message', 'You already liked this post.');
        }

        $post->likes()->create([
            'user_id' => $user->id,
        ]);

        return back()->with('message', 'Post liked!');
    }

    return redirect()->route('login');
}

}
