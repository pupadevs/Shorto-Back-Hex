<?php 

declare(strict_types=1);

namespace Source\User\App\Commands\UserCommands\DeleteUser;

use Illuminate\Support\Facades\Event;
use Source\User\App\Commands\UserCommands\DeleteUser\DeleteUserCommand;
use Source\User\App\Commands\UserCommands\DeleteUser\DeleteUserCommandHandler;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Entity\User\User;
use Source\User\Domain\Events\User\DeleteUserEvent\DeleteUserReadEvent;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserReadRepositoryInterface;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserRepositoryInterface;
use Source\User\Infrastructure\Repository\Exception\UserNotFoundException;
use Source\User\Infrastructure\Repository\User\Read\UserReadRepository;
use Source\User\Infrastructure\Repository\User\Write\UserRepositoryDbFacades;
use Tests\Fixtures\Users;
use Tests\TestCase;

class DeleteUserCommantTest extends TestCase{

    private DeleteUserCommandHandler $commandHandler;
    private UserRepositoryInterface $userRepository;
    private UserReadRepositoryInterface $userReadRepository;
    private User $user;

  

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new UserRepositoryDbFacades();
        $this->userReadRepository = new UserReadRepository();
        
        $this->commandHandler = new DeleteUserCommandHandler($this->userRepository);
        $this->user = Users::aUser();
    }


    public function testCanInstantiate(): void
    {
        self::assertInstanceOf(DeleteUserCommandHandler::class, $this->commandHandler);
    }

    public function testCanDeleteUser(): void
    { 
        Event::fake();
        $this->expectException(UserNotFoundException::class);
        $user = Users::aUser();
        $this->userRepository->save($user);
        $this->userReadRepository->insertUserReadDB(new UserCreatedReadEvent($user));
        $command = new DeleteUserCommand($user);
        $this->commandHandler->execute($command);
      //  $this->userRepository->deleteUser($user);
        event(new DeleteUserReadEvent($user));
      //  Event::assertDispatched(DeleteUserReadEvent::class);
        $actual = $this->userReadRepository->getUserByEmail($user->getEmail());
        self::assertNull($actual);
    }

}