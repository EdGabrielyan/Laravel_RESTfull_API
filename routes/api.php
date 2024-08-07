<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::group(['prefix' => 'user'], function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::get('/{user}', [UserController::class, 'show']);
    Route::get('/', [UserController::class, 'index']);
});

Route::group(['middleware' => ['auth:api']], function () {

    Route::group(['prefix' => 'user'], function () {
        Route::delete('/', [UserController::class, 'destroy']);
        Route::put('/', [UserController::class, 'update']);
    });

    Route::group(['prefix' => 'product'], function () {
        Route::apiResource('/', ProductController::class)->parameters(['' => 'product']);
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});
