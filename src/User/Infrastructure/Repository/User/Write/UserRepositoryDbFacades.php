<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository\User\Write;

use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Source\Role\Domain\ValueObjects\RoleID;
use Source\Role\Domain\ValueObjects\RoleName;
use Source\User\Domain\Entity\User\User;
use Source\User\Domain\Events\ChangePasswordReadEvent;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserRepositoryInterface;
use Source\User\Infrastructure\Repository\Exception\TransactionErrorException;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Source\Role\Domain\Entity\Role;

class UserRepositoryDbFacades implements UserRepositoryInterface
{

 /*    protected $table = 'users';
    protected $conecction = 'mysql'; */
   
    /**
     * save a new user in the database Write
     * @param User $user
     * @return bool
     * @throws TransactionErrorException
     */

    public function insertUser(User $user): bool
{
    $result = false;


    DB::transaction(function () use ($user, &$result) {
        $result = DB::connection('mysql')->table('users')->insert([
            'id' => $user->getId()->toString(), 
            'name' => $user->getName()->toString(),
            'email' => $user->getEmail()->toString(),
            'password' => $user->getPassword()->toString(),
            'created_at' => date('Y-m-d H:i:s'),
        ]); 
       
    });
   

    if (!$result) {
        throw new TransactionErrorException();
    }

    return $result; // Devuelve true si la inserción fue exitosa, false si falló
}

/**
 * save a new user in the database Write
 * @param User $user
 * @return void
 */

    public function save(User $user)
    {
        $result = false;

        $data= [
            'name' => $user->getName()->toString(),
            'email' => $user->getEmail()->toString(),
            'password' => $user->getPassword()->toString(),
        ];
      $result =  DB::transaction(function () use ($user, $data) {
            DB::connection('mysql')->table('users')->where('id', $user->getId()->toString())->update($data);
        });

       /*  if (!$result) {
            throw new TransactionErrorException();
        } */
       
    }



    /**
     * delete user in the database Write
     * @param User $user
     * @return bool
     */

   public function deleteUser(User $user): bool
    {

        $user = DB::connection('mysql')->table('users')->where('id', $user->getId()->toString())->delete();

        return true;
    }
}
