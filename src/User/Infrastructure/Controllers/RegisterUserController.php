<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Source\Shared\CQRS\Command\CommandBus;
use Source\User\App\Services\CreateUserService;
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
 * @param CommandBus $commandBus
 */
    public function __construct(CreateUserService $createUserService, CommandBus $commandBus)
    {
        $this->createUserService = $createUserService;

        $this->commandBus = $commandBus;
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
            $data = $request->all();
       
            $this->createUserService->execute($data['name'] ?? null, $request->email ?? null, $request->password ?? null);

            return response()->json(['message' => 'User created successfully'], 201);
        }catch(\InvalidArgumentException $exception) {
            
            throw new HttpResponseException(response()->json(['message' => $exception->getMessage()], $exception->getCode()));
        }
        catch (EmailExistsException $exception) {

            throw new HttpResponseException(response()->json(['message' => $exception->getMessage()], $exception->getCode()));
        } 
 

    }
}
