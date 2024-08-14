<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Controllers\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Source\User\Domain\Entity\Role\Role;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\User\Name;
use Source\User\Infrastructure\Repository\Role\RoleRepository;

class RoleCreateController{


    private RoleRepository $roleRepository;
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository, RoleRepository $roleRepository)
    {
      //  $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|min:5',
        ]);
    
       $role = Role::createRole(new Name($request->input('name')));
    
        $this->roleRepository->insertRole($role);
    
        return response()->json(['message' => 'Role created successfully.'], 201);
    }
}