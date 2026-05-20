<?php

namespace App\Providers;

use App\Support\AdminResourceMap;
use App\Support\AdminViewHelpers;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::share('qwResourceMap', AdminResourceMap::all());
        View::share(AdminViewHelpers::shared());

        Blade::if('permission', function (...$permissions) {
            return auth()->check() && auth()->user()->hasAnyPermission($permissions);
        });
    }
}
