<?php

namespace Modules\Users\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    // Register services
    public function register()
    {
        // Register any module-specific bindings or services here
    }

    // Bootstrap services
    public function boot()
    {
        // Load web routes with 'web' middleware and a namespace for controllers
        if (file_exists(__DIR__.'/../Routes/web.php')) {
            Route::middleware('web')
                 ->namespace('Modules\Users\Http\Controllers')
                 ->group(__DIR__.'/../Routes/web.php');
        }

        // Load API routes with 'api' middleware and a namespace for controllers
        if (file_exists(__DIR__.'/../Routes/api.php')) {
            Route::prefix('api')
                 ->middleware('api')
                 ->namespace('Modules\Users\Http\Controllers')
                 ->group(__DIR__.'/../Routes/api.php');
        }

        // Load module-specific views
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'users');

        // Load module-specific migrations
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }
}
