<?php 
namespace Source\User\App\Commands;

use Illuminate\Support\Facades\Event;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Interfaces\UserReadRepositoryInterface;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\Name;
use Source\User\Infrastructure\Repository\Read\UserReadRepository;
use Source\User\Infrastructure\Repository\UserRepositoryEloquentMySql;
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
        $this->userRepository = new UserRepositoryEloquentMySql();  
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