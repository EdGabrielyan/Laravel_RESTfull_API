<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::group(['prefix' => 'user'], function () {
    Route::post('/registration', [UserController::class, 'register'])->name('api.user.registration');
    Route::get('/{user}', [UserController::class, 'show']);
    Route::get('/', [UserController::class, 'index']);
    Route::get('/name/{name}', [UserController::class, 'search']);
});

Route::group(['middleware' => ['auth:api']], function () {

    Route::group(['prefix' => 'user'], function () {
        Route::delete('/', [UserController::class, 'destroy']);
        Route::put('/', [UserController::class, 'update']);
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/data', [CategoryController::class, 'getData']);
        Route::apiResource('/', CategoryController::class)->parameters(['' => 'category']);
    });

    Route::group(['prefix' => 'product'], function () {
        Route::apiResource('/', ProductController::class, ['as' => 'product'])->parameters(['' => 'product']);
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});
