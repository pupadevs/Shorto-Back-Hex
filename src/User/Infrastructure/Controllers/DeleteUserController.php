<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Source\User\App\Services\DeleteUserService;
use Source\User\Infrastructure\Repository\Exception\UserNotFoundException;

class DeleteUserController{

    private DeleteUserService $deleteUserService;

    public function __construct(DeleteUserService $deleteUserService)
    {
        $this->deleteUserService = $deleteUserService;
    }
    
    public function __invoke(string $uuid){
            try {
                $this->deleteUserService->execute($uuid);

                return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (UserNotFoundException $exception) {

            throw new HttpResponseException(response()->json(['message' => 'User not found'], 404));
        }
       
    }
}