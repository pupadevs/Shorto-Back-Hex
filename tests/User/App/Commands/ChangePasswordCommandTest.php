<?php 

declare(strict_types=1);

namespace Source\User\App\Commands;

use Source\User\App\Commands\ChangePasswordCommand;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Interfaces\UserReadRepositoryInterface;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\Password;
use Source\User\Infrastructure\Repository\Read\UserReadRepository;
use Source\User\Infrastructure\Repository\UserRepositoryEloquentMySql;
use Tests\Fixtures\Users;
use Tests\TestCase;

class ChangePasswordCommandTest extends TestCase
{
    private ChangePasswordCommandHandler $commandHandler;
    private UserRepositoryInterface $userRepository;
    private UserReadRepositoryInterface $userReadRepository;
    private User $user;

  

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new UserRepositoryEloquentMySql();
        $this->userReadRepository = new UserReadRepository();
        
        $this->commandHandler = new ChangePasswordCommandHandler($this->userRepository, $this->userReadRepository);
        $this->user = Users::aUser();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->commandHandler);
        unset($this->userRepository);
        unset($this->userReadRepository);
        unset($this->user);
    }


    public function testCanInstantiate(): void
    {
        self::assertInstanceOf(ChangePasswordCommandHandler::class, $this->commandHandler);
    }

    public function testChangePasswordCommand()
    {
        $this->userRepository->save($this->user);
        event(new UserCreatedReadEvent($this->user));
       $handle= $this->userReadRepository->getUserByID($this->user->getId());
       $command = new ChangePasswordCommand($handle, new Password("12345678"));
       $this->commandHandler->execute($command);
       self::assertTrue(password_verify("12345678", $handle->getPassword()->ToString()));
     
    }

     
}