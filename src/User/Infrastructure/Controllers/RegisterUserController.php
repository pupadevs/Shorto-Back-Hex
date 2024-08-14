<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Source\Shared\CQRS\Command\CommandBus;
use Source\User\App\Services\User\CreateUser\CreateUserService;
use Source\User\Infrastructure\Repository\Exception\EmailExistsException;

class RegisterUserController
{
    /**
     * @var CreateUserService $createUserService
     */
    private CreateUserService $createUserService;

    /**
     * @var CommandBus $commandBus
     */
    private CommandBus $commandBus;
/**
 * RegisterUserController constructor.
 * @param CreateUserService $createUserService
 */
    public function __construct(CreateUserService $createUserService)
    {
        $this->createUserService = $createUserService;

    }

    /**
     * Method to create user 
     * @param Request $request
     * @throws HttpResponseException
     * @throws EmailExistsException
     * @throws \InvalidArgumentException
     * @return JsonResponse
     */

    public function __invoke(Request $request): JsonResponse
    {
         try {
        
           $this->createUserService->execute($request->name ?? null, $request->email ?? null, $request->password ?? null, $request->ip() ?? null);

            return response()->json(['message' => 'User created successfully'], 201);
        }catch(\InvalidArgumentException  $exception) {
            
            throw new HttpResponseException(response()->json(['message' => $exception->getMessage()], $exception->getCode()));
        }catch( EmailExistsException $exception) {
            
            throw new HttpResponseException(response()->json(['message' => $exception->getMessage()], $exception->getCode()));
        }
       

    }
}
