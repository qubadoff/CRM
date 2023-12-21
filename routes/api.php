<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\General\CompartmentController;
use App\Http\Controllers\Api\General\DepartmentController;
use App\Http\Controllers\Api\General\PositionController;
use App\Http\Controllers\Api\General\RatingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Employee\EmployeeController;
use App\Http\Controllers\Api\Avans\AvansController;
use App\Http\Controllers\Api\Award\AwardController;
use App\Http\Controllers\Api\Deduction\DeductionController;
use App\Http\Controllers\Api\Salary\SalaryController;


Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth:sanctum')->group(function () {

    // General Controllers
   Route::apiResource('compartment', CompartmentController::class);
   Route::apiResource('department', DepartmentController::class);
   Route::apiResource('position', PositionController::class);
   Route::apiResource('rating', RatingController::class);

   // Employee Controllers
    Route::apiResource('employee', EmployeeController::class);

    //Avans Controllers
    Route::apiResource('avans', AvansController::class);

    //Award Controller
    Route::apiResource('award', AwardController::class);

    //Deduction controller
    Route::apiResource('deduction', DeductionController::class);

    //Salary Controllers
    Route::apiResource('salary', SalaryController::class);
});
