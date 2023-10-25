<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Product;
use App\Policies\ProductPolicy;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //

        Gate::define('register', function(User $user){
              return $user->role == "admin" ? Response::allow() : Response::deny('You must be an Admin');
        }) ;
    }
}
