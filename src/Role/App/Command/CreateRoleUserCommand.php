<?php 

declare(strict_types=1);

namespace Source\Role\App\Command;

use Source\Role\Domain\Entity\Role;
use Source\Role\Domain\ValueObjects\RoleID;
use Source\Role\Domain\ValueObjects\RoleName;
use Source\Shared\CQRS\Command\Command;

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