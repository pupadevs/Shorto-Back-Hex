<?php

declare(strict_types=1);

namespace Source\User\App\Services;

use Source\Shared\CQRS\Command\CommandBus;
use Source\Shared\CQRS\Querys\QueryBus;
use Source\User\App\Commands\UserCreateCommand;
use Source\User\App\Querys\CheckEmailQuery;
use Source\User\Domain\ValueObjects\Email;

class CreateUserService
{
    /**
     * @var CommandBus $command
     */
    private  CommandBus $command;
    /**
     * @var QueryBus $query
     */
    private QueryBus $query;

    /**
     * CreateUserService constructor.
     * @param CommandBus $commandBus
     * @param QueryBus $queryBus
     */
    public function __construct(CommandBus $commandBus,QueryBus $queryBus)
    {
        $this->command = $commandBus;
        $this->query = $queryBus;
    }
    /**
     * Method to create user
     * @param string $name, string $email, string $password
     * @throws \InvalidArgumentException
     */
    public function execute(?string $name = null, ?string $email = null, ?string $password = null)
    {
    
            $this->query->handle(new CheckEmailQuery(new Email($email)));
      $this->command->execute(new UserCreateCommand($name, $email, $password));
        }
        
}
