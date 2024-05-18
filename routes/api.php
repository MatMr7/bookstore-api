<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('register', [UserController::class, 'create']);

Route::get('/', function () {
    return response()->json(['message' => 'ok']);
});
