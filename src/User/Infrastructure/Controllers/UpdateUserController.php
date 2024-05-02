<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

use Source\User\App\Services\UpdateUserService;
use Source\User\Infrastructure\Repository\Exception\EmailExistsException;
use Source\User\Infrastructure\Repository\Exception\UserNotFoundException;

class UpdateUserController
{
    private UpdateUserService $updateUserService;

    public function __construct(UpdateUserService $updateUserService)
    {
        $this->updateUserService = $updateUserService;
    }

    public function __invoke(Request $request, string $id)
    {
        try{

        $this->updateUserService->execute($request->email,$request->name, $id);

            return response()->json(['message' => 'User updated successfully'], 200);
        }catch(UserNotFoundException $exception) {
            
            throw new HttpResponseException(response()->json(['message' => $exception->getMessage()], $exception->getCode()));
        }catch(\InvalidArgumentException $invalidArgumentException) {
            
            throw new HttpResponseException(response()->json(['message' => $invalidArgumentException->getMessage()], $invalidArgumentException->getCode()));
        }
    }

}