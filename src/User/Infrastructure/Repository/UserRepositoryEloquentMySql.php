<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository;

use Illuminate\Support\Facades\DB;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\UserID;
use Source\User\Infrastructure\Repository\Eloquent\UserEloquentModel;
use Source\User\Infrastructure\Repository\Exception\UserNotFoundException;

class UserRepositoryEloquentMySql implements UserRepositoryInterface
{
    

    public function insertUser(User $user)
    {
        $transaction = DB::transaction(function () use ($user) {
          $user=  DB::connection('mysql')->table('users')->insert([
                'id' => $user->getId()->toString(), 
                'name' => $user->getName()->toString(),
                'email' => $user->getEmail()->toString(),
                'password' => $user->getPassword()->toString(),
                'created_at' => date('Y-m-d H:i:s'),
            ]); 

            return $user;
          
        });
        if (!$transaction) {

           // throw new TransactionError();   
        }

   
    }

    public function save(User $user)
    {
        $data= [
            'name' => $user->getName()->toString(),
            'email' => $user->getEmail()->toString(),
        ];
        //metodo save con DB::
        DB::connection('mysql')->table('users')->where('id', $user->getId()->toString())->update($data);
        
      //  $saved = $this->userEloquentModel->save(get_object_vars($user));

    }

    public function findbyId(UserID $userID): User
    {

        $user = DB::connection('mysql')->table('users')->where('id', $userID)->first();
        if (! $user) {
            throw new UserNotFoundException();
        }
        $data = json_decode(json_encode($user), true);
        return User::fromArray($data);
    }

    public function findByEmail(Email $email)
    {

        $user = DB::connection('mysql')->table('users')->where('email', $email)->first();
        if (! $user) {
            throw new UserNotFoundException();
        }
        $data = json_decode(json_encode($user), true);
        return User::fromArray($data);
    }

    public function deleteUser(User $user)
    {

        $user = DB::connection('mysql')->table('users')->where('id', $user->getId()->toString())->delete();
    }

   
}
