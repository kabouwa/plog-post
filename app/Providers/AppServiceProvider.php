<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Policies\UserPolicy;
use App\Policies\PostPolicy;
use App\Policies\CommentPolicy;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    // Not important
    protected $policies = [
        User::class => UserPolicy::class, 
        Post::class => PostPolicy::class, 
        Comment::class => CommentPolicy::class
    ];
    public function register(): void
    {
        // 
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        // Gates
        // Gate::define('update-user', function(User $authUser, User $toEditUser){
        //     // authUser injected by laravel - toEdit is comming from uri (Route model binding we give it when we call this get Gate::authorize)
        //     return $authUser->is_admin || $authUser->id === $toEditUser->id;
        // });
    }
}
