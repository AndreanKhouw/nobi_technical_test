<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController as LoginController;
use App\Http\Controllers\Auth\RegisterController as RegisterController;

Route::post('/login', [LoginController::class, 'index']);
Route::post('/register', [RegisterController::class, 'index']);
