<?php 

declare(strict_types=1);

namespace Source\Role\Infrastructure\Repository\Read;

use Illuminate\Support\Facades\DB;
use Source\Role\Domain\Entity\Role;
use Source\Role\Domain\Events\RoleCreatedReadEvent;
use Source\Role\Domain\RoleReadRepositoryInterface;
use Source\Role\Domain\ValueObjects\RoleID;
use Source\Role\Domain\ValueObjects\RoleName;
use Source\User\Domain\ValueObjects\Name;

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
}