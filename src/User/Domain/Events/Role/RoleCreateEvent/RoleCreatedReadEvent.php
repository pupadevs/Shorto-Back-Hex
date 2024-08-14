<?php 

declare(strict_types=1);

namespace Source\User\Domain\Events\Role\RoleCreateEvent;

use Source\User\Domain\Entity\Role\Role;

class RoleCreatedReadEvent{

    public function __construct(private Role $role){
        
    }

    public function getRole(): Role
    {
        return $this->role;
    }
}