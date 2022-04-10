<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/v1/auth')->group(__DIR__.'/api/auth.php');
Route::prefix('/v1')->group(__DIR__.'/api/quote.php');
Route::prefix('/v1')->group(__DIR__.'/api/transaction.php');
Route::prefix('/v1/price')->group(__DIR__.'/api/price.php');

