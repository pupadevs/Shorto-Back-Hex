<?php

declare(strict_types=1);

namespace Source\User\App\Services;

use Illuminate\Support\Facades\Event;
use Source\Shared\CQRS\Command\CommandBus;
use Source\Shared\CQRS\Querys\QueryBus;
use Source\User\App\Querys\CheckEmailQuery;
use Source\User\App\Querys\CheckPasswordQuery;
use Source\User\App\Querys\FindUserByIdQuery;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Events\UserUpdatedLogEvent;
use Source\User\Domain\Events\UserUpdatedReadEvent;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\Name;
use Source\User\Domain\ValueObjects\Password;

class UpdateUserService 
{
    /**
     * @var QueryBus
     * 
     */
    private QueryBus $queryBus;
/**
 * @var UserRepositoryInterface
 
 */
    private $eloquentUserInterface;
    /**
     * UpdateUserService constructor.
     * @param QueryBus $queryBus
     * @param UserRepositoryInterface $eloquentUserInterface
     */

    public function __construct( QueryBus $queryBus,UserRepositoryInterface $eloquentUserInterface)
    {
        $this->queryBus = $queryBus;

        $this->eloquentUserInterface = $eloquentUserInterface;
    }

    /**
     * Method to update user
     * @param string|null $email|null, string $name|null, string $id|null
     * @param string|null $password
     * @throws \InvalidArgumentException
     * @return User
     * 
     */
    public function execute(?string $email = null,  ?string $name = null,?string $password = null, ?string $id = null):User
    {
   
        $user= $this->queryBus->handle(new FindUserByIdQuery( $id));
        if($password === null) {
           throw new \InvalidArgumentException('Password is required',400);
        }

       if($user) {
        $this->queryBus->handle(new CheckEmailQuery(new Email($email)));
                $user->changeEmail(new Email ($email));
                $user->changeName(new Name($name)); 
        $this->queryBus->handle(new CheckPasswordQuery($user->getPassword()->toString(),new Password($password)));

   $this->eloquentUserInterface->save($user);
   event(new UserUpdatedReadEvent($user));

   event(new UserUpdatedLogEvent($user->getId()->toString()));
         
            }
            
   return $user;

    }
}
