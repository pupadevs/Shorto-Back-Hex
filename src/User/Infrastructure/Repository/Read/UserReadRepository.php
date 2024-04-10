<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository\Read;

use Illuminate\Support\Facades\DB;
use Source\User\App\Events\UserCreatedEvent;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Infrastructure\Repository\Eloquent\Read\UserReadEloquentModel;

class UserReadRepository {

    public function insert (UserCreatedReadEvent $event){

        $user = UserReadEloquentModel::create([
            'id' => $event->getUser()->getId()->toString(),
            'name' => $event->getUser()->getName()->toString(),
            'email' => $event->getUser()->getEmail()->ToString(),
            'password' => $event->getUser()->getPassword()->ToString(),
        ]);

      /*  DB::connection('mysql_read')->table('users')->insert([
           'id' => $event->getUser()->getId()->toString(),
           'name' => $event->getUser()->getName()->toString(),
           'email' => $event->getUser()->getEmail()->ToString(),
           'password' => $event->getUser()->getPassword()->ToString(),
       ]); */

      //  var_dump($user);
    }

    public function insertUserLog(UserCreatedEvent $event){
        var_dump($event);
        $user = DB::connection('mysql_read')->table('users_logs')->create([
            'user_id' => $event->getUserID(),
            'action' => $event->getAction(),
            'event_type' => UserCreatedEvent::class ,
            'id' => (string) \Ramsey\Uuid\Uuid::uuid4(),
            'created_at' => date('Y-m-d H:i:s'),
        
        ]);

        var_dump($user);
    }
}