<?php 

declare(strict_types=1);

namespace Tests\User\App\Commands;

use Illuminate\Support\Facades\Event;
use PHPUnit\Framework\TestCase;
use Source\User\App\Commands\UserCreateCommand;
use Source\User\App\Commands\UserCreateCommandHandler;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Events\UserCreatedLogEvent;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Infrastructure\Repository\Memory\UserRepositoryInMemory;
use Source\User\Infrastructure\Repository\UserRepositoryEloquentMySql;
use Tests\Fixtures\Users;

class CreateUserCommandTest extends TestCase
{
    private UserCreateCommandHandler $commandHandler;
    private UserRepositoryInterface $userRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new UserRepositoryInMemory();
        $this->commandHandler = new UserCreateCommandHandler($this->userRepository);
    }


    public function testCanInstantiate(): void
    {
        self::assertInstanceOf(UserCreateCommandHandler::class, $this->commandHandler);
    }

    public function testCanCreateAUser(): void
    {
        Event::fake();
        $user = Users::aUser();
        $command = new UserCreateCommand( $user->getName()->toString(), $user->getEmail()->toString(), $user->getPassword()->toString());
        $this->commandHandler->execute($command);
       
        $actual = $this->userRepository->findByEmail($user->getEmail());
        
        self::assertEquals($user->getEmail(), $actual->getEmail());
        self::assertTrue(password_verify($user->getPassword()->toString(), $actual->getPassword()->toString()));
    }
}