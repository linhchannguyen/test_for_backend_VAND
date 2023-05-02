<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Auth\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [UserController::class, 'login']);
Route::group(['middleware' => 'author'], function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::prefix('stores')->group(function () {
        Route::post('/', [StoreController::class, 'index']);
        Route::get('/{id}', [StoreController::class, 'show']);
        Route::post('/save', [StoreController::class, 'save']);
        Route::delete('/{id}', [StoreController::class, 'delete']);
    });
    Route::prefix('products')->group(function () {
        Route::post('/', [ProductController::class, 'index']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::post('/save', [ProductController::class, 'save']);
        Route::delete('/{id}', [ProductController::class, 'delete']);
    });
});
