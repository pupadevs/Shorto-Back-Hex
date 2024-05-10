<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository;

use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Events\ChangePasswordReadEvent;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Infrastructure\Repository\Exception\TransactionErrorException;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserRepositoryEloquentMySql implements UserRepositoryInterface
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

        var_dump($user->getPassword()->ToString());
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

    public function changePassword(ChangePasswordReadEvent $event): void
     {
       // var_dump($event->getUser()->getPassword()->ToString());

        $data= [
           
            'password' => $event->getUser()->getPassword()->ToString(),
        ];
        DB::connection('mysql_read')->table('users')->where('id', $event->getUser()->getId()->toString())->update($data);
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
