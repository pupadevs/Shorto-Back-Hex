<?php 

declare(strict_types=1);

namespace Source\Role\Domain\Events;

use Source\Role\Domain\Entity\Role;

class RoleCreatedReadEvent{

    public function __construct(private Role $role){
        
    }

    public function getRole(): Role
    {
        return $this->role;
    }
}