<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("", [\App\Http\Controllers\WebController::class, "index"])->name("index");
Route::post("/login", [\App\Http\Controllers\WebController::class, "login"])->name("login");
