<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DniCalculationController;


Route::get('/calculate-dni', [DniCalculationController::class, 'index'])->name('index');