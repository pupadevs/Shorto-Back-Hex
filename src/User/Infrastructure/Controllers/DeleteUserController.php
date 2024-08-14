<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Source\User\App\Services\User\DeleteUser\DeleteUserService;
use Source\User\Infrastructure\Repository\Exception\UserNotFoundException;

class DeleteUserController{

    private DeleteUserService $deleteUserService;

    public function __construct(DeleteUserService $deleteUserService)
    {
        $this->deleteUserService = $deleteUserService;
    }
    
    public function __invoke(string $uuid, Request $request): JsonResponse{
            try {
                $this->deleteUserService->execute($uuid,$request->ip ?? null);

                return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (UserNotFoundException $exception) {

            throw new HttpResponseException(response()->json(['message' => 'User not found'], 404));
        }
       
    }
}