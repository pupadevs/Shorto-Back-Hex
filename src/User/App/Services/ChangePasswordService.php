<?php

declare(strict_types=1);

namespace Source\User\App\Services;

use Source\Shared\CQRS\Command\CommandBus;
use Source\Shared\CQRS\Querys\QueryBus;
use Source\User\App\Commands\ChangePasswordCommand;
use Source\User\App\Querys\CheckPasswordQuery;
use Source\User\App\Services\Contracts\ChangePasswordInterface;

class ChangePasswordService implements ChangePasswordInterface
{
    private $commandBus;

    private $queryBus;

    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;

        $this->queryBus = $queryBus;
    }

    public function execute(?string $email = null, ?string $password_old = null, ?string $new_password = null)
    {
        $this->queryBus->handle(new CheckPasswordQuery( $password_old, $new_password));

        $this->commandBus->execute(new ChangePasswordCommand($email, $password_old, $new_password));


        
        // $user->changePassword($password->toString());

        //  $this->eloquentUserInterface->save($user);

    }
}
