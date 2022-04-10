<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Transaction\TransactionController as TransactionController;

Route::group(['middleware' => 'check_user_token'], function () {
    Route::post('/transaction', [TransactionController::class, 'index']);
});