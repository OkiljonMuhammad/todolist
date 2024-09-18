<?php

use Modules\Items\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::prefix('/item')->name('item.')->group(function () {
    Route::get('/', [ItemController::class, 'index'])->name('index');
    Route::post('/import', [ItemController::class, 'import'])->name('import');
    Route::get('/export', [ItemController::class, 'export'])->name('export');
    Route::post('/store', [ItemController::class, 'store'])->name('store');
    Route::put('/{id}', [ItemController::class, 'update'])->name('update');
    Route::delete('/{id}', [ItemController::class, 'destroy'])->name('destroy');
    // Routes for state-machine
    Route::patch('/{id}/start', [ItemController::class, 'start'])->name('start');
    Route::patch('/{id}/complete', [ItemController::class, 'complete'])->name('complete');
    Route::patch('/{id}/archive', [ItemController::class, 'archive'])->name('archive');
    Route::patch('/{id}/cancel', [ItemController::class, 'cancel'])->name('cancel');
    Route::patch('/{id}/restore', [ItemController::class, 'restore'])->name('restore');
});

