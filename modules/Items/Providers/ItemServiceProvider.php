<?php

namespace Modules\Items\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Items\Http\Actions\File\ImportFileAction;
use Modules\Items\Http\Actions\File\ExportFileAction;
use Modules\Items\Http\Actions\Item\GetItemAction;
use Modules\Items\Http\Actions\Item\GetCategoryAction;
use Modules\Items\Http\Actions\Item\GetByCategoryAction;
use Modules\Items\Http\Actions\Item\StoreItemAction;
use Modules\Items\Http\Actions\Item\UpdateItemAction;
use Modules\Items\Http\Actions\Item\DestroyItemAction;
use Modules\Items\Http\Actions\Status\StartItemAction;
use Modules\Items\Http\Actions\Status\CompleteItemAction;
use Modules\Items\Http\Actions\Status\ArchiveItemAction;
use Modules\Items\Http\Actions\Status\CancelItemAction;
use Modules\Items\Http\Actions\Status\RestoreItemAction;
use Modules\Items\Http\Contracts\File\ImportFileInterface;
use Modules\Items\Http\Contracts\File\ExportFileInterface;
use Modules\Items\Http\Contracts\Item\GetItemInterface;
use Modules\Items\Http\Contracts\Item\GetCategoryInterface;
use Modules\Items\Http\Contracts\Item\GetByCategoryInterface;
use Modules\Items\Http\Contracts\Item\StoreItemInterface;
use Modules\Items\Http\Contracts\Item\UpdateItemInterface;
use Modules\Items\Http\Contracts\Item\DestroyItemInterface;
use Modules\Items\Http\Contracts\Status\StartItemInterface;
use Modules\Items\Http\Contracts\Status\CompleteItemInterface;
use Modules\Items\Http\Contracts\Status\ArchiveItemInterface;
use Modules\Items\Http\Contracts\Status\CancelItemInterface;
use Modules\Items\Http\Contracts\Status\RestoreItemInterface;

class ItemServiceProvider extends ServiceProvider
{
    
    // Register services.
    public function register()
    {
        $this->app->bind(ImportFileInterface::class, ImportFileAction::class);
        $this->app->bind(ExportFileInterface::class, ExportFileAction::class);
        $this->app->bind(GetItemInterface::class, GetItemAction::class);
        $this->app->bind(StoreItemInterface::class, StoreItemAction::class);
        $this->app->bind(UpdateItemInterface::class, UpdateItemAction::class);
        $this->app->bind(DestroyItemInterface::class, DestroyItemAction::class);
        $this->app->bind(StartItemInterface::class, StartItemAction::class);
        $this->app->bind(CompleteItemInterface::class, CompleteItemAction::class);
        $this->app->bind(ArchiveItemInterface::class, ArchiveItemAction::class);
        $this->app->bind(CancelItemInterface::class, CancelItemAction::class);
        $this->app->bind(RestoreItemInterface::class, RestoreItemAction::class);
        $this->app->bind(GetCategoryInterface::class, GetCategoryAction::class);
        $this->app->bind(GetByCategoryInterface::class, GetByCategoryAction::class);



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
