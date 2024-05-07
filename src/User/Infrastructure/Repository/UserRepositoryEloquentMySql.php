<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository;

use Illuminate\Support\Facades\DB;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Infrastructure\Repository\Exception\TransactionErrorException;

class UserRepositoryEloquentMySql implements UserRepositoryInterface
{
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
