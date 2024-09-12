<?php

use Modules\Users\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->name('user.')->group(function () {
    Route::post('/register', [UserController::class, 'register'])->name('register');
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum')->name('logout');
    Route::get('/user', [UserController::class, 'user'])->middleware('auth:sanctum')->name('details');
});
