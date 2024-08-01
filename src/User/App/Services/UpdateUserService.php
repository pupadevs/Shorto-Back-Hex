<?php

declare(strict_types=1);

namespace Source\User\App\Services;


use Source\Shared\CQRS\Command\CommandBus;
use Source\Shared\CQRS\Querys\QueryBus;
use Source\User\App\Commands\UpdateUserCommand;
use Source\User\App\Querys\FindUserByIdQuery;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\Name;

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
