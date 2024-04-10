<?php

declare(strict_types=1);

namespace Source\User\App\Commands;

//use Source\Shared\CQRS\Event\EventBus;

use Illuminate\Support\Facades\Event;
use Source\User\App\Commands\UserCreateCommand;
use Source\User\App\Events\UserCreatedEvent;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\Name;
use Source\User\Domain\ValueObjects\Password;

class UserCreateCommandHandler
{
    private UserRepositoryInterface $userRepositoryInterface;
    private $event;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;

       // $this->event = $event;

    }

    public function execute(UserCreateCommand $command)
    {
      
        $user = User::createUser(new Name($command->getName()), new Email($command->getEmail()), new Password($command->getPassword()));
        
    
        
        $this->userRepositoryInterface->insertUser($user);
     //   $this->event->dispatch(new EventsUserCreatedEvent($user->getId()->toString()));
       // event(new UserCreatedEvent($user->getId()->toString()));
      //  var_dump(event(new UserCreatedEvent($user->getId()->toString())));
//$this->event->dispatch(new UserCreatedEvent($user->getId()->toString()));
        
  //  event(new UserCreatedEvent($user->getId()->toString())); 
    event(new UserCreatedReadEvent($user));
    Event::dispatch(new UserCreatedEvent($user->getId()->toString()));
      

    }
}
