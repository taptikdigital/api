<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\DashboardController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function () {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('refresh', [AuthController::class, 'refresh']);

    Route::middleware(['auth:api'])->group(function () {
        // Route::get('user', [AuthController::class, 'user']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('/get-user-profile', [UserController::class,'getUserProfile']);
        Route::post('/get-project', [DashboardController::class,'getProject']);
        Route::post('/get-dashboard', [DashboardController::class,'getDashboard']);
        Route::post('/get-dashboard-report', [DashboardController::class,'getDashboardReport']);
        
    });

});