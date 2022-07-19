<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->register();
        Gate::define('isAdmin', function ($user) {
            return $user->role == 'admin';
        });
        Gate::define('isDosen', function ($user) {
            return $user->role == 'dosen';
        });
        return false;
    }
}
