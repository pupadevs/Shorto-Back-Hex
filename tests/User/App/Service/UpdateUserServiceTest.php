<?php
namespace Tests\User\App\Service;
use PHPUnit\Framework\TestCase;
use Source\Shared\CQRS\Command\CommandBus;
use Source\Shared\CQRS\Querys\QueryBus;
use Source\User\App\Commands\UserCommands\UpdateUser\UpdateUserCommand;
use Source\User\App\Querys\UserQuery\FindUser\FindUserByIdQuery;
use Source\User\App\Services\User\UpdateUser\UpdateUserService;
use Source\User\Domain\Entity\User\User;

class UpdateUserServiceTest extends TestCase
{

    private QueryBus $queryBus;
    private CommandBus $commandBus;
    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        

    }
    public function testExecute()
    {
        // Mock dependencies
        $queryBus = $this->createMock(QueryBus::class);
        $commandBus = $this->createMock(CommandBus::class);

        // Mock User entity
        $user = $this->createMock(User::class);

        // Configure the stub for the QueryBus handle method
        $queryBus->expects($this->once())
                 ->method('handle')
                 ->with($this->isInstanceOf(FindUserByIdQuery::class))
                 ->willReturn($user);

        // Configure the stub for the CommandBus execute method
        $commandBus->expects($this->once())
                   ->method('execute')
                   ->with($this->isInstanceOf(UpdateUserCommand::class))
                   ->willReturn($user);

        // Create an instance of the service with the mocked dependencies
        $service = new UpdateUserService($queryBus, $commandBus);

        // Define the test parameters
        $email = 'test@example.com';
        $name = 'Test User';
        $id = '123';
        $ip = '127.0.0.1';

        // Execute the service method and assert the result
        $result = $service->execute($email, $name, $id, $ip);

        // Assert that the returned user is the same as the mocked user
        $this->assertSame($user, $result);
    }
}