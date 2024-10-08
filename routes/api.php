<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::group(['prefix' => 'user'], function () {
    Route::post('/registration', [UserController::class, 'register'])->name('api.user.registration');
    Route::get('/{user}', [UserController::class, 'show'])->name('api.user.show');
    Route::get('/', [UserController::class, 'index'])->name('api.user.index');
    Route::get('/name/{name}', [UserController::class, 'search'])->name('api.user.search');
});

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::group(['prefix' => 'user'], function () {
        Route::delete('/', [UserController::class, 'destroy'])->name('api.user.destroy');
        Route::put('/', [UserController::class, 'update'])->name('api.user.update');
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/data', [CategoryController::class, 'getData'])->name('api.category.data');
        Route::apiResource('/', CategoryController::class)->parameters(['' => 'category'])
            ->name('index', 'api.category.index')
            ->name('store', 'api.category.store');
    });

    Route::group(['prefix' => 'product'], function () {
        Route::apiResource('/', ProductController::class, ['as' => 'product'])->parameters(['' => 'product']);
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
});
