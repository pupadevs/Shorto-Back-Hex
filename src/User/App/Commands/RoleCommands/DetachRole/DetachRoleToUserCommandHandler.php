<?php

declare(strict_types=1);

namespace Source\User\App\Commands\RoleCommands\DetachRole;

use Source\Shared\CQRS\Command\Command;
use Source\User\Domain\Interfaces\RoleRepository\RoleReadRepositoryInterface;
use Source\User\Domain\Interfaces\RoleRepository\RoleRepositoryInterface;

class DetachRoleToUserCommandHandler
{
    public function __construct(
        private RoleRepositoryInterface $roleRepository,
        private RoleReadRepositoryInterface $roleReadRepository,

    )
    {
    }
}