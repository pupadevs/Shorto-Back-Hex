<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Controllers;


use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Source\User\App\Services\UpdateUserService;
use Source\User\Infrastructure\Repository\Exception\EmailExistsException;
use Source\User\Infrastructure\Repository\Exception\TransactionErrorException;
use Source\User\Infrastructure\Repository\Exception\UserNotFoundException;

class UpdateUserController
{
    /**
     * @var UpdateUserService $updateUserService
     */
    private UpdateUserService $updateUserService;
/**
 * UpdateUserController constructor.
 * @param UpdateUserService $updateUserService
 */
    public function __construct(UpdateUserService $updateUserService)
    {
        $this->updateUserService = $updateUserService;
    }
/**
 * Method to invokate update user service
 * @param Request $request
 * @param string $uuid
 * @throws HttpResponseException
 * @throws TransactionErrorException
 * @throws UserNotFoundException
 * @throws \InvalidArgumentException
 * @throws EmailExistsException
 * @return JsonResponse
 */
    public function __invoke(Request $request, string $uuid): JsonResponse
    {
       
        try{

       $user=  $this->updateUserService->execute($request->email,$request->name,$request->ip, $uuid);

            return response()->json(['message' => 'User updated successfully', 'user' => ["id" => $user->getId()->toString(), "name" => $user->getName()->toString(), "email" => $user->getEmail()->toString()]], 200);
            
        }catch(UserNotFoundException | EmailExistsException | \InvalidArgumentException $exception) {
            
            throw new HttpResponseException(response()->json(['message' => $exception->getMessage()], $exception->getCode()));
        }catch(TransactionErrorException $exception) {

            throw new HttpResponseException(response()->json(['message' => $exception->getMessage()], $exception->getCode()));
        }
    }

}