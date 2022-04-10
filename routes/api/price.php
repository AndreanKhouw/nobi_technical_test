<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Price\PriceController as PriceController;


Route::group(['middleware' => 'check_user_token'], function () {
    Route::get('/low-high', [PriceController::class, 'index']);
    Route::get('/history', [PriceController::class, 'history']);
});