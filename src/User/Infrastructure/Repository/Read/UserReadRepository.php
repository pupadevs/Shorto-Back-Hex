<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository\Read;

use Illuminate\Support\Facades\DB;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Events\UserUpdatedLogEvent;
use Source\User\Domain\Events\UserUpdatedReadEvent;
use Source\User\Domain\Interfaces\UserReadRepositoryInterface;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\UserID;
use Source\User\Infrastructure\Listerners\UserCreatedLogEventListener;
use Source\User\Infrastructure\Repository\Exception\EmailExistsException;
use Source\User\Infrastructure\Repository\Exception\UserNotFoundException;

class UserReadRepository implements UserReadRepositoryInterface{

    public function insertUserReadDB(UserCreatedReadEvent $event){

        DB::connection('mysql_read')->table('users')->insert([
            'id' => $event->getUser()->getId()->toString(),
            'name' => $event->getUser()->getName()->toString(),
            'email' => $event->getUser()->getEmail()->ToString(),
            'password' => $event->getUser()->getPassword()->ToString(),
            'created_at' => date('Y-m-d H:i:s'),

        ]);

    }

    public function save(UserUpdatedReadEvent $user)
    {
        $data= [
            'name' => $user->getUser()->getName()->toString(),
            'email' => $user->getUser()->getEmail()->toString(),
        ];
     //  var_dump($data);
        DB::connection('mysql_read')->table('users')->where('id', $user->getUser()->getId()->toString())->update($data);

     
        
      //  $saved = $this->userEloquentModel->save(get_object_vars($user))

    }
 

    public function getUserByID(UserID $userID): User
    {
        
      $user = DB::connection('mysql_read')->table('users')->where('id', $userID)->first();
    
        if (! $user) {

            throw new UserNotFoundException();
        }

        return User::fromArray(get_object_vars($user));

    }

    public function getUserByEmail(Email $email): User
    {
        
      $user = DB::connection('mysql_read')->table('users')->where('email', $email)->first();
    
        if (! $user) {

            throw new UserNotFoundException();
        }

        return User::fromArray(get_object_vars($user));

    }

    public function emailExists(Email $email): bool
    {

        $user =  DB::connection('mysql_read')->table('users')->where('email', $email->toString())->first();

        if ($user) {
            throw new EmailExistsException();
        }

        return true;
    }
}