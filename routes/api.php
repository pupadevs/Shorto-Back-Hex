<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Source\User\Infrastructure\Controllers\RegisterUserController;
use Source\User\Infrastructure\Controllers\TestController;

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

