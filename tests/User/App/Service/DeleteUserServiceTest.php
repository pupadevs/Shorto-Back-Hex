<?php

namespace Tests\User\App\Service;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;
use Source\Shared\CQRS\Command\CommandBus;
use Source\Shared\CQRS\Querys\QueryBus;
use Source\User\App\Commands\UserCommands\DeleteUser\DeleteUserCommand;
use Source\User\App\Querys\UserQuery\FindUser\FindUserByIdQuery;
use Source\User\App\Services\User\DeleteUser\DeleteUserService;
use Source\User\Domain\Entity\User\User;

class DeleteUserServiceTest extends TestCase
{
    use RefreshDatabase;
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createMock(User::class);

    }
    
    public function testExecute()
    {
        $queryBus = $this->createMock(QueryBus::class);
        $commandBus = $this->createMock(CommandBus::class);
        $userId = '123';

        // Mock User entity
        $user = $this->createMock(User::class);

        // Configure the stub for the QueryBus handle method
        $queryBus
        ->expects($this->once())
        ->method('handle')
        ->with($this->isInstanceOf(FindUserByIdQuery::class))
        ->willReturn($this->user);

    // Configurar el comportamiento esperado del commandBus para DeleteUserCommand
    $commandBus
        ->expects($this->once())
        ->method('execute')
        ->with($this->isInstanceOf(DeleteUserCommand::class))
        ->willReturnCallback(function (DeleteUserCommand $command) {
            $this->assertSame($this->user, $command->getUser());
        });
        $deleteUserService = new DeleteUserService($commandBus, $queryBus);
        $ipAddress = '127.0.0.1';

    // Ejecutar el servicio de eliminación de usuario
    $deleteUserService->execute($userId, $ipAddress);
    }
}