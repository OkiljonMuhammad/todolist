<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->name('user.')->group(function () {
    Route::post('/register', [UserController::class, 'register'])->name('register');
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum')->name('logout');
    Route::get('/user', [UserController::class, 'user'])->middleware('auth:sanctum')->name('details');
});

Route::prefix('/item')->name('item.')->group(function () {
    Route::get('/', [ItemController::class, 'index'])->name('index');
    Route::post('/import', [ItemController::class, 'import'])->name('import');
    Route::get('/export', [ItemController::class, 'export'])->name('export');
    Route::post('/store', [ItemController::class, 'store'])->name('store');
    Route::put('/{id}', [ItemController::class, 'update'])->name('update');
    Route::delete('/{id}', [ItemController::class, 'destroy'])->name('destroy');
});
