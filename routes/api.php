<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [UserController::class, 'user'])->middleware('auth:sanctum');


Route::get('/items', [ItemController::class, 'index']);
Route::prefix('/item')->group(function () {
    Route::post('/store', [ItemController::class, 'store']);
    Route::put('/{id}', [ItemController::class, 'update']);
    Route::delete('/{id}', [ItemController::class, 'destroy']);
});
