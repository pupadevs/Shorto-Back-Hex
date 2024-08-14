<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Source\User\Domain\Interfaces\RoleRepository\RoleReadRepositoryInterface;
use Source\User\Domain\Interfaces\RoleRepository\RoleRepositoryInterface;
use Source\User\Infrastructure\Controllers\Role\RoleCreateController;
use Source\User\Infrastructure\Controllers\Role\RoleDettachToUserController;
use Source\User\Infrastructure\Controllers\ShowAllLogsController;
use Source\User\Infrastructure\Http\Controllers\User\ChangePassword\ChangePasswordController;
use Source\User\Infrastructure\Http\Controllers\User\DeleteUser\DeleteUserController;
use Source\User\Infrastructure\Http\Controllers\User\FindUserById\FindUserByIdController;
use Source\User\Infrastructure\Http\Controllers\User\RegisterUser\RegisterUserController;
use Source\User\Infrastructure\Http\Controllers\User\UpdateUser\UpdateUserController;

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
Route::put('/role/detach', RoleDettachToUserController::class);
Route::post('/role', RoleCreateController::class)->name('role');

Route::get('/show-logs', ShowAllLogsController::class);

Route::get('/test-role', function () {
    $roleReadRepository = app(RoleReadRepositoryInterface::class);
    $roleRepository = app(RoleRepositoryInterface::class);

    return response()->json([
        'roleReadRepository' => get_class($roleReadRepository),
        'roleRepository' => get_class($roleRepository),
    ]);
});

Route::get('/test-cache', function () {
    Cache::put('test_key', 'test_value', 600); // Guarda el valor en cache por 10 minutos
    return Cache::get('test_key');
});


