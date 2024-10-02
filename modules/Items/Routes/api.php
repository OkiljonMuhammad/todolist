<?php

use Modules\Items\Http\Controllers\File\ImportFileController;
use Modules\Items\Http\Controllers\File\ExportFileController;
use Modules\Items\Http\Controllers\Item\GetItemController;
use Modules\Items\Http\Controllers\Item\StoreItemController;
use Modules\Items\Http\Controllers\Item\UpdateItemController;
use Modules\Items\Http\Controllers\Item\DestroyItemController;
use Modules\Items\Http\Controllers\Status\StartItemController;
use Modules\Items\Http\Controllers\Status\CompleteItemController;
use Modules\Items\Http\Controllers\Status\ArchiveItemController;
use Modules\Items\Http\Controllers\Status\CancelItemController;
use Modules\Items\Http\Controllers\Status\RestoreItemController;
use Modules\Items\Http\Controllers\Item\GetCategoryController;
use Modules\Items\Http\Controllers\Item\GetByCategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('/item')->name('item.')->middleware('auth:sanctum')->group(function () {
    Route::get('/', GetItemController::class)->name('index');
    Route::post('/import', ImportFileController::class)->name('import');
    Route::get('/export', ExportFileController::class)->name('export');
    Route::post('/store', StoreItemController::class)->name('store');
    Route::put('/{id}', UpdateItemController::class)->name('update');
    Route::delete('/{id}', DestroyItemController::class)->name('destroy');
    //Route for item category
    Route::get('/category', GetCategoryController::class)->name('category');
    Route::get('/bycategory', GetByCategoryController::class)->name('bycategory');
    // Routes for state-machine
    Route::put('/start/{id}', StartItemController::class)->name('start');
    Route::put('/complete/{id}', CompleteItemController::class)->name('complete');
    Route::put('/archive/{id}', ArchiveItemController::class)->name('archive');
    Route::put('/cancel/{id}', CancelItemController::class)->name('cancel');
    Route::put('/restore/{id}', RestoreItemController::class)->name('restore');
});

