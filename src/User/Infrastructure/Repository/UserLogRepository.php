<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository;

use Illuminate\Support\Facades\DB;
use Source\Shared\Event\Event;
use Source\User\App\Events\UserCreatedEvent ;
use Source\User\Infrastructure\Repository\Eloquent\UserLogEloquentModel;

class UserLogRepository
{
    public function logUserCreation(UserCreatedEvent $event)
    {
       $user=  UserLogEloquentModel::create([
            'user_id' => $event->getUserID(),
            'action' => $event->getAction(),
            'event_type' => UserCreatedEvent::class ,
            'id' => (string) \Ramsey\Uuid\Uuid::uuid4(),
            'created_at' => date('Y-m-d H:i:s'),
        ]); 

   
      /*   DB::table('users_logs')->insert([
            'user_id' => $userId,
            'action' => 'User created',
            'event_type' => UserCreatedEvent::class,
           // 'id' => (string) \Ramsey\Uuid\Uuid::uuid4(),
        
        ]); */
    }
}