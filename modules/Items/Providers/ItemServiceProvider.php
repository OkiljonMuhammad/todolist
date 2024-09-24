<?php

namespace Modules\Items\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Items\Http\Actions\File\ImportFileAction;
use Modules\Items\Http\Actions\File\ExportFileAction;
use Modules\Items\Http\Actions\Item\GetItemAction;
use Modules\Items\Http\Actions\Item\StoreItemAction;
use Modules\Items\Http\Contracts\File\ImportFileInterface;
use Modules\Items\Http\Contracts\File\ExportFileInterface;
use Modules\Items\Http\Contracts\Item\GetItemInterface;
use Modules\Items\Http\Contracts\Item\StoreItemInterface;

class ItemServiceProvider extends ServiceProvider
{
    
    // Register services.
    public function register()
    {
        $this->app->bind(ImportFileInterface::class, ImportFileAction::class);
        $this->app->bind(ExportFileInterface::class, ExportFileAction::class);
        $this->app->bind(GetItemInterface::class, GetItemAction::class);
        $this->app->bind(StoreItemInterface::class, StoreItemAction::class);



    }

    // Bootstrap services
    public function boot()
    {
        // Load web routes with 'web' middleware and a namespace for controllers
        if (file_exists(__DIR__.'/../Routes/web.php')) {
            Route::middleware('web')
                 ->namespace('Modules\Items\Http\Controllers')
                 ->group(__DIR__.'/../Routes/web.php');
        }

        // Load API routes with 'api' middleware and a namespace for controllers
        if (file_exists(__DIR__.'/../Routes/api.php')) {
            Route::prefix('api')
                 ->middleware('api')
                 ->namespace('Modules\Items\Http\Controllers')
                 ->group(__DIR__.'/../Routes/api.php');
        }

        // Load module-specific views
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'items');

        // Load module-specific migrations
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }
}
