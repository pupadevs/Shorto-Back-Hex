<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Controllers\Role;

use Illuminate\Http\Request;
use Source\Role\Domain\Entity\Role;
use Source\User\Domain\Interfaces\RoleRepository\RoleRepositoryInterface;
use Source\User\Domain\ValueObjects\Name;
use Source\User\Domain\ValueObjects\Role\RoleID;
use Source\User\Domain\ValueObjects\User\UserID;

class RoleDettachToUserController
{
    public function __construct(private RoleRepositoryInterface $roleRepository)
    {
        
    }
    public function __invoke(Request $request)
    {
        $this->roleRepository->detachRoleToUser(new UserID($request->get('user_id')),new RoleID($request->get('role_id')));
    }
}