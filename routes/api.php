<?php

use App\Http\Controllers\ApplianceController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/appliances', [ApplianceController::class, 'index']);
Route::get('/appliances/{id}', [ApplianceController::class, 'show']);
Route::post('/appliances', [ApplianceController::class, 'store']);
Route::put('/appliances/{id}', [ApplianceController::class, 'update']);
Route::delete('/appliances/{id}', [ApplianceController::class, 'destroy']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

