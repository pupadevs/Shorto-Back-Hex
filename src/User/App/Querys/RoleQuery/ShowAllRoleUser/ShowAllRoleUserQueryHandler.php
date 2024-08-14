<?php

declare(strict_types=1);

namespace Source\User\App\Querys\RoleQuery\ShowAllRoleUser;

use Source\User\Domain\Interfaces\RoleRepository\RoleReadRepositoryInterface;

class ShowAllRoleUserQueryHandler
{
    public function __construct(private RoleReadRepositoryInterface $roleReadRepository){
        
    }

    public function handle(ShowAllRoleUserQuery $query): array
    {
        $role = $this->roleReadRepository->showAllRoleUser();
        return $role;
    }

}