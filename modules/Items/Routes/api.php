<?php

use Modules\Items\Http\Controllers\ItemController;
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
use Illuminate\Support\Facades\Route;

Route::prefix('/item')->name('item.')->group(function () {
    Route::get('/', GetItemController::class)->name('index');
    Route::post('/import', ImportFileController::class)->name('import');
    Route::get('/export', ExportFileController::class)->name('export');
    Route::post('/store', StoreItemController::class)->name('store');
    Route::put('/{id}', UpdateItemController::class)->name('update');
    Route::delete('/{id}', DestroyItemController::class)->name('destroy');
    // Routes for state-machine
    Route::put('/{id}/start', StartItemController::class)->name('start');
    Route::put('/{id}/complete', CompleteItemController::class)->name('complete');
    Route::put('/{id}/archive', ArchiveItemController::class)->name('archive');
    Route::put('/{id}/cancel', CancelItemController::class)->name('cancel');
    Route::put('/{id}/restore', RestoreItemController::class)->name('restore');
});

