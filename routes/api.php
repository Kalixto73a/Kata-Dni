<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DniCalculationController;

Route::get('/dni', [DniCalculationController::class, 'index'])->name('index');