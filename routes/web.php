<?php

use Illuminate\Support\Facades\Route;

Route::get("", [\App\Http\Controllers\WebController::class, "index"])->name("login");
Route::post("/login", [\App\Http\Controllers\WebController::class, "login"])->name("attempt");
