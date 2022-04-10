<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Quote\QuoteController as QuoteController;

Route::get('/quote', [QuoteController::class, 'index']);
