<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\General\CompartmentController;
use App\Http\Controllers\Api\General\DepartmentController;
use App\Http\Controllers\Api\General\PositionController;
use App\Http\Controllers\Api\General\RatingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Employee\EmployeeController;
use App\Http\Controllers\Api\Avans\AvansController;
use App\Http\Controllers\Api\Award\AwardController;
use App\Http\Controllers\Api\Deduction\DeductionController;
use App\Http\Controllers\Api\Salary\SalaryController;
use App\Http\Controllers\Api\Vacation\VacationController;


Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('user', UserController::class);
    Route::apiResource('compartment', CompartmentController::class);
    Route::apiResource('department', DepartmentController::class);
    Route::apiResource('position', PositionController::class);
    Route::apiResource('rating', RatingController::class);
    Route::apiResource('employee', EmployeeController::class);
    Route::apiResource('avans', AvansController::class);
    Route::apiResource('award', AwardController::class);
    Route::apiResource('deduction', DeductionController::class);
    Route::apiResource('salary', SalaryController::class);
    Route::apiResource('vacation', VacationController::class);
});
