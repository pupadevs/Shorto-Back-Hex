<?php 

declare(strict_types=1);

namespace Source\User\App\Querys\RoleQuery\CheckUserRole;
use Source\Shared\CQRS\Querys\QueryHandler;
use Source\User\Domain\Interfaces\RoleRepository\RoleReadRepositoryInterface;
use Source\User\Domain\ValueObjects\Role\RoleID;


class CheckUserRoleQueryHandler{

    /**
     * Summary of __construct
     * @param \Source\User\Domain\Interfaces\RoleRepository\RoleReadRepositoryInterface $roleReadRepository
     */
    public function __construct(private RoleReadRepositoryInterface $roleReadRepository){}


    public function handle(CheckUserRoleQuery $query): bool
    {
        $role = $this->roleReadRepository->verifyUserHasRole($query->getUserID(), $query->getRoleID());
        return $role;
    }

}