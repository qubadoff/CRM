<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\General\CompartmentController;
use App\Http\Controllers\Api\General\DepartmentController;
use App\Http\Controllers\Api\General\PositionController;
use App\Http\Controllers\Api\General\RatingController;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth:sanctum')->group(function () {
   Route::apiResource('compartment', CompartmentController::class);
   Route::apiResource('department', DepartmentController::class);
   Route::apiResource('position', PositionController::class);
   Route::apiResource('rating', RatingController::class);
});
