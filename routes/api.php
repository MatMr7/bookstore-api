<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('register', [UserController::class, 'create']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::delete('logout', [AuthController::class, 'logOut']);

    Route::resource('stores', StoreController::class)
        ->only('index','store', 'show', 'update', 'destroy');

    Route::resource('books', BookController::class)
        ->only('index','store', 'show', 'update', 'destroy');
});

Route::get('/', function () {
    return response()->json(['message' => 'ok']);
});
