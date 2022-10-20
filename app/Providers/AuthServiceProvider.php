<?php

namespace App\Providers;

use App\Models\Content\Post;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // method 1
        // acl management - only the author of post can edit the post
//        Gate::define('update-post', function(User $user, Post $post) {
//            return $user->id === $post->author_id;
//        });

        // method 2
        // only admin can edit posts
//        Gate::define('update-post', function(User $user) {
//            return $user->user_type == 1 ? Response::allow() : Response::deny('شما اجازه دسترسی ندارید');
//        });

        // method 3
        // runs before any other gates
//        Gate::before(function($user, $ability) {
//            if ($user->user_type === 1) {
//                return true;
//            }
//        });
        // runs after any other gates
//        Gate::after(function($user, $ability) {
//            if ($user->user_type === 1) {
//                return true;
//            }
//        });

    }
}
