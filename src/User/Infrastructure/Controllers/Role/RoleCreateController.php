<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Controllers\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Source\Role\Domain\ValueObjects\RoleName;
use Source\Role\Infrastructure\Repository\RoleRepository;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Infrastructure\Repository\Memory\UserRepositoryInMemory;
use Tests\Fixtures\Users;
use Illuminate\Support\Str;
use Source\User\Domain\Entity\Role;
use Source\User\Domain\ValueObjects\User\Name;

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
    
        // Debug: Imprimir datos
       // dd($request->name);

       $role = Role::createRole(new Name($request->input('name')));
    
        // Crear el rol
       /*  DB::table('roles')->insert([
            'id' => Str::uuid()->toString(), // Genera un UUID
            'name' => $request->input('name'),
            'created_at' => now(),
            'updated_at' => now(),
        ]); */

        $this->roleRepository->insertRole($role);
    
        return response()->json(['message' => 'Role created successfully.'], 201);
    }
}