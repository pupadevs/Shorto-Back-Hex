<?php

declare(strict_types=1);

namespace Source\User\App\Services;

use Illuminate\Support\Facades\Event;
use Source\Shared\CQRS\Command\CommandBus;
use Source\Shared\CQRS\Querys\QueryBus;
use Source\User\App\Commands\UserCreateCommand;
use Source\User\App\Events\UserCreatedEvent;
use Source\User\App\Querys\CheckEmailQuery;


class CreateUserService
{
    private $command;

    private $query;

    private $event;

    public function __construct(CommandBus $commandBus,QueryBus $queryBus)
    {

        $this->command = $commandBus;

        $this->query = $queryBus;

    }

    public function execute(?string $name = null, ?string $email = null, ?string $password = null)
    {
        if($name == null || $email == null || $password == null) {
            throw new \InvalidArgumentException('Name, email and password are required',400);
        }
        
            $this->query->handle(new CheckEmailQuery($email));
        $this->command->execute(new UserCreateCommand($name, $email, $password));

     //   $this->event->dispatch(new UserCreatedEvent($email, $name, $password));


     



    
        }
        
        



    
}
