<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Controllers\Role;

use Illuminate\Http\Request;
use Source\Role\Domain\Entity\Role;
use Source\User\App\Services\Role\DetachRole\DetachRoleService;
use Source\User\Domain\Interfaces\RoleRepository\RoleRepositoryInterface;
use Source\User\Domain\ValueObjects\Name;
use Source\User\Domain\ValueObjects\Role\RoleID;
use Source\User\Domain\ValueObjects\User\UserID;

class RoleDettachToUserController
{
    public function __construct(private DetachRoleService $detachRoleService)
    {
        
    }
    public function __invoke(Request $request)
    {
        $this->detachRoleService->execute(new RoleID($request->get('role_id')),new UserID($request->get('user_id')));
        return response()->json(['message' => 'Role detached successfully'], 200);
    }
}