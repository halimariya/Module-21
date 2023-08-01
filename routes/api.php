<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// API Routes
Route::post('/user-login', [UserController::class, 'UserLogin']);
Route::post('/user-registration', [UserController::class, 'UserRegistration']);
Route::post('/user-send-otp-to-email', [UserController::class, 'UserSendOTPToEmail']);
Route::post('/otp-verify', [UserController::class, 'OTPVerify']);
Route::post('/set-password', [UserController::class, 'SetPassword'])->middleware(TokenVerificationMiddleware::class);
Route::get('/profile-details', [UserController::class, 'profileDetails'])->middleware(TokenVerificationMiddleware::class);
Route::post('/profile-update', [UserController::class, 'profileUpdate'])->middleware(TokenVerificationMiddleware::class);


// TODO API
Route::get('/todos', [TodoController::class, 'AllTodo'])->middleware(TokenVerificationMiddleware::class);
Route::post('/todos', [TodoController::class, 'StoreTodo'])->middleware(TokenVerificationMiddleware::class);
Route::get('/todos/{id}', [TodoController::class, 'SingleTodo'])->middleware(TokenVerificationMiddleware::class);
Route::put('todos/{id}', [TodoController::class, 'UpdateTodo'])->middleware(TokenVerificationMiddleware::class);
Route::delete('todos/{id}', [TodoController::class, 'DeleteTodo'])->middleware(TokenVerificationMiddleware::class);
