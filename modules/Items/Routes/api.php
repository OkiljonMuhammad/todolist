<?php

use Modules\Items\Http\Controllers\ItemController;
use Modules\Items\Http\Controllers\File\ImportFileController;
use Modules\Items\Http\Controllers\File\ExportFileController;
use Modules\Items\Http\Controllers\Item\GetItemController;
use Modules\Items\Http\Controllers\Item\StoreItemController;
use Modules\Items\Http\Controllers\Item\UpdateItemController;
use Illuminate\Support\Facades\Route;

Route::prefix('/item')->name('item.')->group(function () {
    Route::get('/', GetItemController::class)->name('index');
    Route::post('/import', ImportFileController::class)->name('import');
    Route::get('/export', ExportFileController::class)->name('export');
    Route::post('/store', StoreItemController::class)->name('store');
    Route::put('/{id}', UpdateItemController::class)->name('update');
    Route::delete('/{id}', [ItemController::class, 'destroy'])->name('destroy');
    // Routes for state-machine
    Route::patch('/{id}/start', [ItemController::class, 'start'])->name('start');
    Route::patch('/{id}/complete', [ItemController::class, 'complete'])->name('complete');
    Route::patch('/{id}/archive', [ItemController::class, 'archive'])->name('archive');
    Route::patch('/{id}/cancel', [ItemController::class, 'cancel'])->name('cancel');
    Route::patch('/{id}/restore', [ItemController::class, 'restore'])->name('restore');
});

