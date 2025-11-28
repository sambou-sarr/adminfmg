<?php

namespace App\Providers;

use App\Models\Tache;
use App\Observers\TacheObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
         Schema::defaultStringLength(91);
         Tache::observe(TacheObserver::class);
            // Gate pour le panel admin
        Gate::define('access-admin', function ($user) {
            return $user->hasRole('super_admin');
        });
    }
}
