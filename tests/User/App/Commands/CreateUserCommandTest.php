<?php 

declare(strict_types=1);

namespace Source\User\App\Commands\UserCommands\CreateUser;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Source\User\App\Commands\UserCommands\CreateUser\UserCreateCommand;
use Source\User\App\Commands\UserCommands\CreateUser\UserCreateCommandHandler;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Entity\User\User;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserReadRepositoryInterface;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserRepositoryInterface;
use Source\User\Infrastructure\Repository\User\Read\UserReadRepository;
use Source\User\Infrastructure\Repository\User\Write\UserRepositoryDbFacades;
use Tests\Fixtures\Users;
use Tests\TestCase;
use Tests\Traits\RefreshMultipleDatabases;

class CreateUserCommandTest extends TestCase
{
    use RefreshMultipleDatabases;
    private UserCreateCommandHandler $commandHandler;
    private UserRepositoryInterface $userRepository;
    private UserReadRepositoryInterface $userReadRepository;
    private User $user;

  

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new UserRepositoryDbFacades();
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
        Event::fake();

        $user = Users::aUser();
        $command = new UserCreateCommand( $user,"127.0.0.1");
        $this->commandHandler->execute($command);
        $this->userRepository->save($user);
        event(new UserCreatedReadEvent($user));
        $this->userReadRepository->insertUserReadDB(new UserCreatedReadEvent($user));
       
        $actual = $this->userReadRepository->getUserByEmail($user->getEmail());
        Event::assertDispatched(UserCreatedReadEvent::class);
        self::assertEquals($user->getEmail(), $actual->getEmail());
      //  self::assertTrue(password_verify($user->getPassword()->toString(), $actual->getPassword()->toString()));
    }

   
}