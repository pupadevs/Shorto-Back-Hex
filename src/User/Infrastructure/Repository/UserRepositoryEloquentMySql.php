<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository;

use Illuminate\Support\Facades\DB;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\UserID;
use Source\User\Infrastructure\Events\UserCreatedEvent;
use Source\User\Infrastructure\Repository\Eloquent\UserEloquentModel;
use Source\User\Infrastructure\Repository\Exception\EmailExistsException;
use Source\User\Infrastructure\Repository\Exception\UserNotFoundException;

class UserRepositoryEloquentMySql implements UserRepositoryInterface
{
    private UserEloquentModel $userEloquentModel;

    private \mysqli $mysqli;

    public function __construct(UserEloquentModel $userEloquentModel)
    {

        $this->userEloquentModel = $userEloquentModel;
    }


    public function insertUser(User $user)
    {
        $transaction = DB::transaction(function () use ($user) {
          $user=  UserEloquentModel::create([
                'id' => $user->getId()->toString(), 
                'name' => $user->getName()->toString(),
                'email' => $user->getEmail()->toString(),
                'password' => $user->getPassword()->toString(),
            ]);

            
            var_dump('guardado');
            $user->save();
            
        });

    
     


      /*   if (! $transaction) {

            throw new UserNotFoundException();
        } */
   
    }

 
    

    public function getUserById(UserID $userID): User
    {

        $user = UserEloquentModel::where('id', $userID->toString())->first();
        if(! $user) {

            throw new UserNotFoundException();
        }

        return User::fromArray($user->toArray());
    }

    public function getUserByEmail(Email $email): User
    {

        $usuario = UserEloquentModel::where('email', $email->toString())->select('id', 'name', 'email', 'password')->first();

        if (! $usuario) {
            throw new UserNotFoundException();
        }

        //var_dump($usuario);
        // Depuración
        $userObject = User::fromArray($usuario->toArray());
      

        return $userObject;
    }

    public function save(User $user)
    {

        $saved = $this->userEloquentModel->save(get_object_vars($user));

    }

    public function deleteUser(User $user)
    {

        $user = DB::table('users')->where('id', $user->getId())->delete();
    }

    public function emailExists(Email $email): bool
    {

        $user =  UserEloquentModel::where('email', $email->toString())->exists();

        if ($user) {
            throw new EmailExistsException();
        }

        return true;
    }
}
