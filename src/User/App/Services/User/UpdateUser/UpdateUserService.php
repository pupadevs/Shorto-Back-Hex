<?php

declare(strict_types=1);

namespace Source\User\App\Services\User\UpdateUser;


use Source\Shared\CQRS\Command\CommandBus;
use Source\Shared\CQRS\Querys\QueryBus;
use Source\User\App\Commands\UserCommands\UpdateUser\UpdateUserCommand;
use Source\User\App\Querys\UserQuery\FindUser\FindUserByIdQuery;
use Source\User\Domain\Entity\User\User;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\User\Email;
use Source\User\Domain\ValueObjects\User\Name;

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
     * @var CommandBus $command
     */

    private CommandBus $commandBus;
    /**
     * UpdateUserService constructor.
     * @param QueryBus $queryBus
     * @param UserRepositoryInterface $eloquentUserInterface
     */

    public function __construct( QueryBus $queryBus,CommandBus $commandBus)
    {
        $this->queryBus = $queryBus;

        $this->commandBus = $commandBus;
    }

    /**
     * Method to update user
     * @param string|null $email|null, string $name|null, string $id|null
     * @param string|null $ip
     * @return User
     * 
     */
    public function execute(?string $email,  ?string $name , ?string $id , ?string $ip):User
    {
   
        $user= $this->queryBus->handle(new FindUserByIdQuery( $id));
       $updateUser = $this->commandBus->execute(new UpdateUserCommand($user, new Name($name), new Email($email), $ip));
       

    
            
   return $updateUser;

    }
}
