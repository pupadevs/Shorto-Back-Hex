<?php

declare(strict_types=1);
 
namespace Tests\User\App\Service;

use App\Mail\RegisterNotification;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\TestCase;
use Source\Shared\CQRS\Command\CommandBus;
use Source\Shared\CQRS\Querys\QueryBus;
use Source\User\App\Commands\UserCreateCommand;
use Source\User\App\Querys\CheckEmailQuery;
use Source\User\App\Services\CreateUserService;
use Source\User\Domain\Entity\User;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\Name;
use Source\User\Domain\ValueObjects\Password;

class CreateUserServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        
    }


    public function testExecute()
    {
        // Mocking CommandBus and QueryBus
        $commandBusMock = $this->createMock(CommandBus::class);
        $queryBusMock = $this->createMock(QueryBus::class);
        
        // Creating the service with mocked dependencies
        $createUserService = new CreateUserService($commandBusMock, $queryBusMock);
        
        // Define test data
        $name = 'John Doe';
        $email = 'john.doe@example.com';
        $password = 'securepassword';
        $ip = '127.0.0.1';

        // Expect the QueryBus to handle CheckEmailQuery
        $queryBusMock->expects($this->once())
            ->method('handle')
            ->with($this->isInstanceOf(CheckEmailQuery::class));
        
        // Expect the CommandBus to execute UserCreateCommand
        $commandBusMock->expects($this->once())
            ->method('execute')
            ->with($this->isInstanceOf(UserCreateCommand::class))
            ->willReturn(User::createUser(new Name($name), new Email($email), new Password($password)));

     

        // Execute the service
        $createUserService->execute($name, $email, $password, $ip);

    }
}
