<?php

namespace App\Providers;

use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */

    /**
     * Register any authentication / authorization services.
     */

    public function boot()
    {
        Gate::define('delete-post', function (User $user, Post $post) {
            return $user->role === 'admin' || $user->id === $post->user_id;
        });
    }
    protected $policies = [
        Post::class => PostPolicy::class,
    ];

}
