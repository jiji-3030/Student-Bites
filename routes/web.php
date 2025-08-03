<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;


// Public routes
Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.like');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');


// Admin-only dashboard
Route::middleware(['auth', 'role:admin'])->get('/admin', function (Request $request) {
    $category = request()->query('category');

    $posts = Post::with('user')
        ->when($category, fn($query) => $query->where('category', $category))
        ->latest()
        ->get();

    $users = User::all();
    $categories = Post::distinct()->pluck('category');

    return view('admin.dashboard', compact('users', 'posts', 'category', 'categories'));
})->name('admin');


require __DIR__.'/auth.php';
