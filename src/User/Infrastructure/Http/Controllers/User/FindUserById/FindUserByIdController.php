<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Http\Controllers\User\FindUserById;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Source\Shared\CQRS\Querys\QueryBus;
use Source\User\App\Querys\UserQuery\FindUser\FindUserByIdQuery;
use Source\User\Infrastructure\Repository\Exception\UserNotFoundException;

class FindUserByIdController
{

    private QueryBus $query;

    public function __construct(QueryBus $queryBus)
    {

        $this->query = $queryBus;
    }

    public function __invoke(string $userId): JsonResponse{
        try{
            $user=  $this->query->handle(new FindUserByIdQuery($userId));

            return response()->json(['id' => $user->getId()->toString(),'user' => $user->getName()->toString(), 'email' => $user->getEmail()->toString()], 200);

        }catch(\InvalidArgumentException $exception) {
            
            throw new HttpResponseException(response()->json(['message' => $exception->getMessage()], $exception->getCode()));
        }catch(UserNotFoundException $exception) {
            
            throw new HttpResponseException(response()->json(['message' => $exception->getMessage()], $exception->getCode()));
        }
     
    }
}
