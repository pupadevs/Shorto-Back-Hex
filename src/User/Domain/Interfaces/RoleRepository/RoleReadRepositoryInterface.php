<?php 

declare(strict_types=1);

namespace Source\User\Domain\Interfaces\RoleRepository;

use Source\Role\Domain\Events\RoleCreatedReadEvent;
use Source\Role\Domain\ValueObjects\RoleName;
use Source\User\Domain\Entity\Role\Role;
use Source\User\Domain\ValueObjects\Role\RoleID;
use Source\User\Domain\ValueObjects\User\Name;
use Source\User\Domain\ValueObjects\User\UserID;

interface RoleReadRepositoryInterface{

    public function insertEvent(Role $role): void;

    public function getRoleByID(RoleID $roleID): Role;

    public function getRoleByName(Name $roleName): ?Role;

    public function roleExists(Name $roleName): bool;
    
    public function verifyUserHasRole(UserID $userID, RoleID $roleID): bool;

    public function atttachRoleToUserInReadDatabase(UserID $userID, RoleID $role): void;

    public function detachRoleToUserInReadDatabase(UserID $userID, RoleID $role): void;
}