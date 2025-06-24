<?php

namespace App\Providers;

use App\Models\User;
use Gate;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

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
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https'); // ✅ Sekarang ini akan jalan
        }
        //
        Model::preventLazyLoading();
        // Paginator::useBootstrapFive();

        Gate::define('is_admin', function(User $user){
             return $user->is_admin;
        });

    }
}
