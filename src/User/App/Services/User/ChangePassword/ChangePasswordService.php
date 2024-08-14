<?php

declare(strict_types=1);

namespace Source\User\App\Services\User\ChangePassword;

use Source\Shared\CQRS\Command\CommandBus;
use Source\Shared\CQRS\Querys\QueryBus;
use Source\User\App\Commands\UserCommands\ChangePassword\ChangePasswordCommand;
use Source\User\App\Querys\UserQuery\CheckPassword\CheckPasswordQuery;
use Source\User\App\Querys\UserQuery\FindUser\FindUserByIdQuery;
use Source\User\App\Services\Contracts\ChangePasswordInterface;
use Source\User\Domain\ValueObjects\User\Password;

class ChangePasswordService implements ChangePasswordInterface
{
    /**
     * @var CommandBus $command
     */
    private CommandBus $commandBus;
    /**
     * @var QueryBus $query
     */
    private QueryBus $queryBus;
/** 
 * ChangePasswordService constructor.
 * @param CommandBus $commandBus
 * @param QueryBus $queryBus
 */
    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;

        $this->queryBus = $queryBus;
    }
/**
 * Method to change password
 * @param string|null $password_old,
 * @param string|null $new_password, 
 * @param string|null $uuid
 * @param string|null $ip
 * @return void
 */
    public function execute( ?string $password_old , ?string $new_password , ?string $uuid , ?string $ip ):void
    {
      $user=   $this->queryBus->handle(new FindUserByIdQuery($uuid));
    

      
        $this->queryBus->handle(new CheckPasswordQuery( $user->getPassword(), $password_old));
        $this->commandBus->execute(new ChangePasswordCommand($user, new Password($new_password )));


        
   

    }
}
