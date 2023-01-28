<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DealsController;

Route::get('/', [DealsController::class, 'index']);
