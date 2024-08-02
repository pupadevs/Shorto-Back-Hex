<?php 

declare(strict_types=1);

namespace Source\Role\Infrastructure\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Source\Role\Domain\Entity\Role;
use Source\Role\Domain\RoleRepositoryInterface;
use Source\User\Domain\ValueObjects\UserID;
use Source\Role\Domain\ValueObjects\RoleID;
use Source\User\Infrastructure\Repository\Exception\TransactionErrorException;
use Illuminate\Support\Str;


class RoleRepository implements RoleRepositoryInterface{

    public function save(Role $role): void
    {
        // TODO: Implement save() method.
        var_dump("Guardando rol");
        var_dump($role->getRoleName());
      DB::table('roles')->insert([
          'id' => $role->getRoleID()->toString(),
          'name' => $role->getRoleName()->toString(),
          'created_at' => now(),
      ]);   
    }

    public function remove(Role $role): void{
        // TODO: Implement remove() method.
    }

    public function atttachRoleToUser(UserID $userID, RoleID $role): void
    {
        

        $user = $userID->toString();
        $role2 = $role->toString();
        if(is_string($user) && is_string($role)){
        
        }
         DB::table('role_user')->insert([
            'user_id' => $user,
            'role_id' => $role2,
            'created_at' => now(),
            'updated_at' => now(),
        ]); 

    }

    public function detachRoleToUser(UserID $userID, RoleID $role): void
    {


        $user = $userID->toString();
        $role2 = $role->toString();

        DB::table('role_user')->where('user_id', $user)->where('role_id', $role2)->delete();
    }

    public function insertRole(Role $role): bool{
        $result = false;
       
        $id = $role->getRoleID()->toString();
    

        DB::transaction(function () use ($role,$id, &$result) {
            $result =  DB::table('roles')->insert([
                'id' => $id, // Genera un UUID
                'name' => $role->getRoleName()->toString(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
           
        });
       
    
        if (!$result) {
            throw new TransactionErrorException();
        }
    
        return $result; 
    }

}