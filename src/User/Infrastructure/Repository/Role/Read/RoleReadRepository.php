<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository\Role\Read;

use Illuminate\Support\Facades\DB;
use Source\User\Domain\Entity\Role\Role;
use Source\User\Domain\Interfaces\RoleRepository\RoleReadRepositoryInterface;
use Source\User\Domain\ValueObjects\Role\RoleID;
use Source\User\Domain\ValueObjects\User\Name;
use Source\User\Domain\ValueObjects\User\UserID;

class RoleReadRepository implements RoleReadRepositoryInterface{

    public function insertEvent(Role $role): void
    {
        
        // TODO: Implement insertEvent() method.
        $string1 = $role->getRoleName()->toString();
        $string2 = $role->getRoleID()->toString();
   
      
        
         DB::connection('mysql_read')->table('roles')->insert([
            'id' => $role->getRoleID(),
            'name' => $role->getRoleName()->toString(),
            'created_at' => now(),
        ]); 
    }
    public function getRoleByName(Name $roleName): ?Role{
        
        // TODO: Implement getRoleByName() method.
        $role =DB::connection('mysql_read')->table('roles')->where('name', $roleName)->first();
        if(!$role){
            return null;
        }
        return  Role::fromArray(get_object_vars($role));
    }

    public function getRoleByID(RoleID $roleID): Role{
        
     $role =   DB::connection('mysql_read')->table('roles')->where('id', $roleID)->first();
     return  Role::fromArray(get_object_vars($role));
    }

    public function roleExists(Name $roleName): bool{

        // TODO: Implement roleExists() method.
        $role = DB::connection('mysql_read')->table('roles')->where('name', $roleName)->first();
        if($role === null){
            return false;
        }
        return true;
    }

    public function atttachRoleToUserInReadDatabase(UserID $userID, RoleID $role): void{
        $user = $userID->toString();
        $role2 = $role->toString();
      
         DB::connection('mysql_read')->table('role_user')->insert([
            'user_id' => $user,
            'role_id' => $role2,
            'created_at' => now(),
            'updated_at' => now(),
        ]); 

    }

    public function verifyUserHasRole(UserID $userID, RoleID $roleID): bool{

        $user = $userID->toString();
        $role = $roleID->toString();
        $role = DB::connection('mysql_read')->table('role_user')->where('user_id', $user)->where('role_id', $role)->first();
        if($role === null){
            return false;   
        }
        return true;
    }

    public function detachRoleToUserInReadDatabase(UserID $userID, RoleID $role): void{
        
    }

    public function showAllRoleUser(): array{
        return DB::table('roles')
        ->join('role_user', 'roles.id', '=', 'role_user.role_id')
        ->join('users', 'users.id', '=', 'role_user.user_id')
        ->select('roles.id as role_id', 'roles.name as role_name', 'users.id as user_id', 'users.name as user_name')
        ->get()
        ->groupBy('role_id')->toArray();
    }
}