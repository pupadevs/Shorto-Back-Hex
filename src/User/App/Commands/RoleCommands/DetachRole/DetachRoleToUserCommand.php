<?php

declare(strict_types=1);

namespace Source\User\App\Commands\RoleCommands\DetachRole;

use Source\Shared\CQRS\Command\Command;
use Source\User\Domain\ValueObjects\Role\RoleID;
use Source\User\Domain\ValueObjects\User\UserID;

class DetachRoleToUserCommand implements Command
{
    public function __construct(
        private UserID $userID,
        private RoleID $roleID
    ) {
    }

    public function getUserID(): UserID
    {
        return $this->userID;
    }

    public function getRoleID(): RoleID
    {
        return $this->roleID;
    }
}