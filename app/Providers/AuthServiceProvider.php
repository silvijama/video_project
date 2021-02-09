<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-routes', function($user) {
            if ($user->type == 'admin') {
                return $user;
            }
        });

        Gate::define('editor-routes', function($user) {
            if ($user->type == 'editor') {
                return $user;
            }
        });

        Gate::define('user-routes', function($user) {
            if ($user->type !== 'admin' && $user->type !== 'editor') {
                return $user;
            }
        });

        Gate::define('edit-users', function($user) {
            if ($user->type == 'admin') {
                return $user;
            }
        });

        Gate::define('delete-users', function($user) {
            if ($user->type == 'admin') {
                return $user;
            }
        });

    }
}
