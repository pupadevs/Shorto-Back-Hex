<?php 

declare(strict_types=1);

namespace Source\User\App\Commands;

use Illuminate\Support\Facades\Event;
use Mockery;
use Mockery\Mock;
use Source\User\App\Commands\UserCreateCommand;
use Source\User\App\Commands\UserCreateCommandHandler;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Events\UserCreatedLogEvent;
use Source\User\Domain\Interfaces\UserReadRepositoryInterface;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\Name;
use Source\User\Domain\ValueObjects\Password;
use Source\User\Infrastructure\Repository\Memory\UserRepositoryInMemory;
use Source\User\Infrastructure\Repository\Read\UserReadRepository;
use Source\User\Infrastructure\Repository\UserRepositoryEloquentMySql;
use Tests\Fixtures\Users;
use Tests\TestCase;

class CreateUserCommandTest extends TestCase
{
    private UserCreateCommandHandler $commandHandler;
    private UserRepositoryInterface $userRepository;
    private UserReadRepositoryInterface $userReadRepository;
    private User $user;

  


    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new UserRepositoryEloquentMySql();
        $this->userReadRepository = new UserReadRepository();
        
        $this->commandHandler = new UserCreateCommandHandler($this->userRepository);
        $this->user = Users::aUser();
    }


    public function testCanInstantiate(): void
    {
        self::assertInstanceOf(UserCreateCommandHandler::class, $this->commandHandler);
    }

    public function testCanCreateAUser(): void
    {
    // Event::fake();
        $user = Users::aUser();
        $command = new UserCreateCommand( $user->getName()->toString(), $user->getEmail()->toString(), $user->getPassword()->toString());
        $this->commandHandler->execute($command);
       
        $actual = $this->userReadRepository->getUserByEmail($user->getEmail());
        
        self::assertEquals($user->getEmail(), $actual->getEmail());
        self::assertTrue(password_verify($user->getPassword()->toString(), $actual->getPassword()->toString()));
    }

   
}