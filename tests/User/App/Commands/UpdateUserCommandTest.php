<?php 
namespace Source\User\Tests\App\Commands\UpdateUser;

use Illuminate\Support\Facades\Event;
use Source\User\App\Commands\UserCommands\UpdateUser\UpdateUserCommand;
use Source\User\App\Commands\UserCommands\UpdateUser\UpdateUserCommandHandler;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Entity\User\User;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserReadRepositoryInterface;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserRepositoryInterface;
use Source\User\Infrastructure\Repository\User\Read\UserReadRepository;
use Source\User\Infrastructure\Repository\User\Write\UserRepositoryDbFacades;
use Tests\Fixtures\Users;
use Tests\TestCase;

class UpdateUserCommandTest extends TestCase
{
    private User $user;
    private UpdateUserCommandHandler $updateUserCommandHandler;
    private UserRepositoryInterface $userRepository;
    private UserReadRepositoryInterface $userReadRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = Users::aUser();
        $this->userRepository = new UserRepositoryDbFacades();  
        $this->userReadRepository = new UserReadRepository();
        $this->updateUserCommandHandler = new UpdateUserCommandHandler($this->userRepository);
    }


    public function testCanInstantiate(): void
    {
        self::assertInstanceOf(UpdateUserCommandHandler::class, $this->updateUserCommandHandler);   
    }

    public function testCanUpdateUser(): void
    {
        $user = Users::aUser();
        $name = Users::aUser()->getName();
        $email = Users::aUser()->getEmail();

        Event::fake();

        $command = new UpdateUserCommand($user,$name,$email,"127.0.0.1");

        $this->updateUserCommandHandler->execute($command);

        $this->userRepository->save($user);
        event(new UserCreatedReadEvent($user));
      $this->userReadRepository->insertUserReadDB(new UserCreatedReadEvent($user));
       
        $actual = $this->userReadRepository->getUserByEmail($user->getEmail());
        Event::assertDispatched(UserCreatedReadEvent::class);
 

        self::assertEquals($name, $actual->getName());
    }

}