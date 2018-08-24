<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerViewsPolicies();

        //
    }

    public function registerViewsPolicies()
    {
        Gate::define('show-views', function ($user) {
            return $user->hasAccess(['show-views']);
        });
        Gate::define('super-admin', function ($user) {
            return $user->hasAccess(['super-admin']);
        });
    }
}
