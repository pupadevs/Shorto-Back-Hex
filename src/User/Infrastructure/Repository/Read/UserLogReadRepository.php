<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository\Read;

use Source\User\App\Events\UserCreatedEvent;
use Source\User\Infrastructure\Repository\Eloquent\Read\UserLogReadEloquentModel;
use Source\User\Infrastructure\Repository\Eloquent\UserLogEloquentModel;

class UserLogReadRepisotory
{
    public function logUserCreation(UserCreatedEvent $event)
    {
       $user=  UserLogReadEloquentModel::create([
            'user_id' => $event->getUserID(),
            'action' => $event->getAction(),
            'event_type' => UserCreatedEvent::class ,
            'id' => (string) \Ramsey\Uuid\Uuid::uuid4(),
            'created_at' => date('Y-m-d H:i:s'),
        ]); 

    }
}