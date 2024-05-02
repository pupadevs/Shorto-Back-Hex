<?php

declare(strict_types=1);

namespace Source\User\App\Services;

use Source\Shared\CQRS\Command\CommandBus;
use Source\Shared\CQRS\Querys\QueryBus;
use Source\User\App\Querys\FindUserByIdQuery;
use Source\User\Domain\Events\UserUpdatedLogEvent;
use Source\User\Domain\Events\UserUpdatedReadEvent;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\Name;

class UpdateUserService 
{
    private $commandBus;

    private $queryBus;

    private $eloquentUserInterface;

    public function __construct(CommandBus $commandBus, QueryBus $queryBus,UserRepositoryInterface $eloquentUserInterface)
    {

        $this->queryBus = $queryBus;

        $this->eloquentUserInterface = $eloquentUserInterface;
    }

    public function execute(?string $email = null,  ?string $name = null, ?string $id = null)
    {
       $user= $this->queryBus->handle(new FindUserByIdQuery( $id));
            if($name != null) {
                $user->changeName(new Name($name));
            }
            if($email != null) {
                $user->changeEmail(new Email ($email));
            }
         
   $this->eloquentUserInterface->save($user);
  
 
   event(new UserUpdatedReadEvent($user));

   event(new UserUpdatedLogEvent($user->getId()->toString()));


      //  $this->commandBus->execute(new ChangePasswordCommand($email, $password_old, $new_password));


        
        // $user->changePassword($password->toString());

        //  $this->eloquentUserInterface->save($user);

    }
}
