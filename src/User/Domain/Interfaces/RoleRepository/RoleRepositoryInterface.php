<?php 

declare(strict_types=1);

namespace Source\User\Domain\Interfaces\RoleRepository;

use Source\User\Domain\Entity\Role\Role;
use Source\User\Domain\ValueObjects\Role\RoleID;
use Source\User\Domain\ValueObjects\User\UserID;

interface RoleRepositoryInterface
{
    public function save(Role $role): void;

    public function remove(Role $role): void;

    public function atttachRoleToUser(UserID $userID, RoleID $role): void;

    public function detachRoleToUser(UserID $userID, RoleID $role): void;

    public function insertRole(Role $role): bool;

}
