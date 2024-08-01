<?php 

declare(strict_types=1);

namespace Source\User\App\Commands;

use Illuminate\Console\Scheduling\Event;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Events\DeleteUserReadEvent;
use Source\User\Domain\Interfaces\UserReadRepositoryInterface;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Infrastructure\Repository\Exception\UserNotFoundException;
use Source\User\Infrastructure\Repository\Read\UserReadRepository;
use Source\User\Infrastructure\Repository\UserRepositoryEloquentMySql;
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
        $this->userRepository = new UserRepositoryEloquentMySql();
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
      //  Event::fake();
        $this->expectException(UserNotFoundException::class);
        $user = Users::aUser();
        $this->userRepository->save($user);
        $this->userReadRepository->insertUserReadDB(new UserCreatedReadEvent($user));
        $command = new DeleteUserCommand($user);
        $this->commandHandler->execute($command);
        $this->userRepository->deleteUser($user);
        event(new DeleteUserReadEvent($user));
      //  Event::assertDispatched(DeleteUserReadEvent::class);
        $actual = $this->userReadRepository->getUserByEmail($user->getEmail());
        self::assertNull($actual);
    }

}