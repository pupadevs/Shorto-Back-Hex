<?php 

declare(strict_types=1);

namespace Source\Role\Domain;

use Source\Role\Domain\Entity\Role;
use Source\Role\Domain\Events\RoleCreatedReadEvent;
use Source\Role\Domain\ValueObjects\RoleID;
use Source\Role\Domain\ValueObjects\RoleName;
use Source\User\Domain\ValueObjects\Name;

interface RoleReadRepositoryInterface{

    public function insertEvent(Role $role): void;

    public function getRoleByID(RoleID $roleID): Role;

    public function getRoleByName(Name $roleName): ?Role;

    public function roleExists(Name $roleName): bool;
}