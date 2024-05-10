<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Source\User\Infrastructure\Controllers\ChangePasswordController;
use Source\User\Infrastructure\Controllers\DeleteUserController;
use Source\User\Infrastructure\Controllers\FindUserByIdController;
use Source\User\Infrastructure\Controllers\LoginController;
use Source\User\Infrastructure\Controllers\RegisterUserController;
use Source\User\Infrastructure\Controllers\TestController;
use Source\User\Infrastructure\Controllers\UpdateUserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', RegisterUserController::class)->name('register');   
Route::get('/show/{uuid}', FindUserByIdController::class); 
Route::put('/update/{uuid}', UpdateUserController::class);
Route::patch('/change-password/{uuid}', ChangePasswordController::class);
Route::delete('/delete/{uuid}', DeleteUserController::class);

Route::post('/login', LoginController::class)->name('login');

