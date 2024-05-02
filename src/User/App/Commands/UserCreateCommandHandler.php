<?php

declare(strict_types=1);

namespace Source\User\App\Commands;

use Illuminate\Support\Facades\Event;
use Source\User\App\Commands\UserCreateCommand;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Events\UserCreatedLogEvent;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\Name;
use Source\User\Domain\ValueObjects\Password;

class UserCreateCommandHandler
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;


    }

    public function execute(UserCreateCommand $command)
    {
      
        $user = User::createUser(new Name($command->getName()), new Email($command->getEmail()), new Password($command->getPassword()));
        
    
        
        $this->userRepositoryInterface->insertUser($user);
   event(new UserCreatedReadEvent($user));
  
        
  event(new UserCreatedLogEvent($user->getId()->toString()));
//  Event::dispatch(new UserCreatedLogEvent($user->getId()->toString()));
 // event(new UserCreatedLogEvent($user->getId()->toString()));
 

    }
}
