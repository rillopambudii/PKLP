<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('super-admin', function ($user) {
            return $user->role === 'Super Admin';
        });

        Gate::define('qhse-access', function ($user) {
            return in_array($user->role, [
                'Super Admin',
                'Admin QHSE',
            ]);
        });

        Gate::define('operation-access', function ($user) {
            return in_array($user->role, [
                'Super Admin',
                'Admin Operation',
            ]);
        });
    }
}
