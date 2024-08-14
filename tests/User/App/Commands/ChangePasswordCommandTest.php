<?php 

declare(strict_types=1);

namespace Source\User\App\Commands\UserCommands\ChangePassword;

use Source\User\App\Commands\UserCommands\ChangePassword\ChangePasswordCommand;
use Source\User\App\Commands\UserCommands\ChangePassword\ChangePasswordCommandHandler;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Entity\User\User;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserReadRepositoryInterface;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\User\Password;
use Source\User\Infrastructure\Repository\User\Read\UserReadRepository;
use Source\User\Infrastructure\Repository\User\Write\UserRepositoryDbFacades;
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
        $this->userRepository = new UserRepositoryDbFacades();
        $this->userReadRepository = new UserReadRepository();
        
        $this->commandHandler = new ChangePasswordCommandHandler($this->userRepository);
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