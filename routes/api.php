<?php

use Illuminate\Support\Facades\Route;

/* Authentication */
Route::group(["prefix" => "auth"], function () {
    Route::post('login', [\App\Http\Controllers\v1\AuthController::class, 'login']);
    Route::group(["middleware" => "auth:api"], function () {
        Route::post('logout', [\App\Http\Controllers\v1\AuthController::class, 'logout']);
        Route::post('refresh', [\App\Http\Controllers\v1\AuthController::class, 'refresh']);
        Route::post('me', [\App\Http\Controllers\v1\AuthController::class, 'me']);
    });
});

Route::group(["middleware" => "auth:api"], function () {

});
