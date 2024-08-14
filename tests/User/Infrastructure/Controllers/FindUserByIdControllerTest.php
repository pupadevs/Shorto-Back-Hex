<?php

namespace Source\User\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Source\Shared\CQRS\Querys\QueryBus;
use Source\User\App\Querys\UserQuery\FindUser\FindUserByIdQuery;
use Source\User\Infrastructure\Controllers\FindUserByIdController;
use Source\User\Infrastructure\Repository\Exception\UserNotFoundException;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserReadRepositoryInterface;
use Tests\Fixtures\Users;
use Tests\TestCase;

class FindUserByIdControllerTest extends TestCase
{
    private $queryBus;
    private $responseFactory;
    private $controller;
private UserReadRepositoryInterface $userRepositoryInterface;
    protected function setUp(): void
    {
        parent::setUp();

        $this->queryBus = $this->createMock(QueryBus::class);

      $this->responseFactory = $this->createStub(ResponseFactory::class);

        $this->controller = new FindUserByIdController($this->queryBus);

    }

    public function test_can_instantiate()
    {
 
        $this->assertInstanceOf(FindUserByIdController::class, $this->controller);
    }

    public function test_user_is_found_successfully()
    {
        $user =Users::aUser();
    

        $this->queryBus->method('handle')
            ->willReturn($user);
        $response = $this->getJson('/api/show/' . $user->getId()->toString());

        $response = $this->controller->__invoke($user->getId()->toString());

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['id' => $user->getId()->toString(),'user' => $user->getName()->toString(), 'email' => $user->getEmail()->toString()], $response->getData(true));

    }
    

    public function test_user_not_found_exception_is_thrown()
    {
        $this->queryBus->expects($this->once())
            ->method('handle')
            ->with($this->isInstanceOf(FindUserByIdQuery::class))
            ->willThrowException(new UserNotFoundException());

        // Configurar el stub para que el método 'json' devuelva un JsonResponse
        $this->responseFactory->method('json')
            ->willReturnCallback(function ($data, $status) {
                return new JsonResponse($data, $status);
            });

        $this->expectException(HttpResponseException::class);

        // Llamar al método __invoke y esperar una excepción
        $this->controller->__invoke('invalid-uuid');
    }

    public function test_invalid_argument_exception_is_thrown()
    {
        // Configurar el stub para que el método 'handle' lance una InvalidArgumentException
        $this->queryBus->expects($this->once())
            ->method('handle')
            ->with($this->isInstanceOf(FindUserByIdQuery::class))
            ->willThrowException(new \InvalidArgumentException('Invalid argument', 400));

        // Configurar el stub para que el método 'json' devuelva un JsonResponse
        $this->responseFactory->method('json')
            ->willReturnCallback(function ($data, $status) {
                return new JsonResponse($data, $status);
            });

        $this->expectException(HttpResponseException::class);

        // Llamar al método __invoke y esperar una excepción
        $this->controller->__invoke('invalid-uuid');
    }
}
