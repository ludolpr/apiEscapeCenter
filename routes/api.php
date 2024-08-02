<?php

use App\Http\Controllers\API\AroundController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\ArCategoryController;
use App\Http\Controllers\API\EgCategoryController;
use App\Http\Controllers\API\EscapeGameController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;


// auth route
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//Seulement accessible via le JWT
// Route::middleware('auth:api')->group(function () {
    Route::get('/currentuser', [UserController::class, 'currentUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
// });



Route::apiResource("blog", BlogController::class);
Route::apiResource("around", AroundController::class);
Route::apiResource("escape", EscapeGameController::class);
Route::apiResource("categoryeg", EgCategoryController::class);
Route::apiResource("categoryar", ArCategoryController::class);
Route::apiResource("role", RoleController::class);
Route::apiResource("user", UserController::class);