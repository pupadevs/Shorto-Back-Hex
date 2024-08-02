<?php 

declare(strict_types=1);

namespace Source\Role\Domain;

use Source\Role\Domain\Entity\Role;
use Source\Role\Domain\ValueObjects\RoleID;
use Source\User\Domain\ValueObjects\UserID;

interface RoleRepositoryInterface
{
    public function save(Role $role): void;

    public function remove(Role $role): void;

    public function atttachRoleToUser(UserID $userID, RoleID $role): void;

    public function detachRoleToUser(UserID $userID, RoleID $role): void;

    public function insertRole(Role $role): bool;

}
