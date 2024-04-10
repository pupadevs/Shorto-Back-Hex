<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Source\Shared\CQRS\Command\CommandBus;
use Source\User\App\Commands\UserCreateCommand;
use Source\User\App\Services\CreateUserService;

class RegisterUserController
{
    private CreateUserService $createUserService;

    private CommandBus $commandBus;

    public function __construct(CreateUserService $createUserService, CommandBus $commandBus)
    {
        $this->createUserService = $createUserService;

        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request)
    {
         try {
            $data = $request->all();
       
            $this->createUserService->execute($data['name'] ?? null, $request->email ?? null, $request->password ?? null);

            return response()->json(['message' => 'User created successfully'], 201);
        }catch(\InvalidArgumentException $exception) {
            
            throw new HttpResponseException(response()->json(['message' => $exception->getMessage()], $exception->getCode()));
        }
        catch (\Exception $exception) {

            throw new HttpResponseException(response()->json(['message' => $exception->getMessage()], $exception->getCode()));
        }  
/* 
         $this->commandBus->execute(new UserCreateCommand($request->name, $request->email, $request->password));
        return response()->json(['message' => 'User created successfully'], 201); */
 


    }
}
