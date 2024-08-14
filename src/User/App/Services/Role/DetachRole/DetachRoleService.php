<?php

declare(strict_types=1);

namespace Source\User\App\Services\Role\DetachRole;

use Source\Shared\CQRS\Command\CommandBus;
use Source\Shared\CQRS\Querys\QueryBus;
use Source\User\App\Commands\RoleCommands\DetachRole\DetachRoleToUserCommand;
use Source\User\App\Querys\RoleQuery\CheckUserRole\CheckUserRoleQuery;
use Source\User\Domain\Entity\Role\Role;
use Source\User\Domain\ValueObjects\Role\RoleID;
use Source\User\Domain\ValueObjects\User\UserID;

class DetachRoleService
{


    public function __construct(private CommandBus $command,private QueryBus $query){}


    public function execute(RoleID $roleID,UserID $userID): void
    {
      $temp=   $this->query->handle(new CheckUserRoleQuery($roleID, $userID));
      if($temp){
        $this->command->execute(new DetachRoleToUserCommand($userID, $roleID));

      }
    }
}

