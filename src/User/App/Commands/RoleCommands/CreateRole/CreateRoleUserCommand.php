<?php 

declare(strict_types=1);

namespace Source\User\App\Commands\RoleCommands\CreateRole;


use Source\Shared\CQRS\Command\Command;
use Source\User\Domain\Entity\Role\Role;

 class CreateRoleUserCommand implements Command
{
    
        public function __construct( private Role $role)
        {
             
        }

        public function getRole(): Role
        {
            return $this->role;
        }


}