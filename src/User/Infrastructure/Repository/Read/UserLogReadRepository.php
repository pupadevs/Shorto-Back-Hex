<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository\Read;

use Illuminate\Support\Facades\DB;
use Source\User\Domain\Entity\UserLog;
use Source\User\Domain\Events\UserCreatedLogEvent;
use Source\User\Domain\Events\UserUpdatedLogEvent;
use Source\User\Domain\Interfaces\UserLogReadRepositoryInterface;
use Source\User\Infrastructure\Listerners\UserCreatedLogEventListener;
use Source\User\Infrastructure\Listerners\UserUpdateLogEventListerner;

class UserLogReadRepository implements UserLogReadRepositoryInterface
{
    public function getUserLogs()
    {
        return DB::connection('mysql')->table('users_logs')->get();
    }


    public function insertUserLog(UserLog $event){
       
        $user = DB::connection('mysql_read')->table('users_logs')->insert([
            'user_id' => $event->getUserID(),
            'action' => $event->getAction(),
            'event_type' => UserCreatedLogEvent::class ,
            'id' => (string) $event->getId(),
            'created_at' => date('Y-m-d H:i:s'),
            'ip' => $_SERVER['REMOTE_ADDR'],
            'event_handler' => UserCreatedLogEventListener::class
        
        ]); 
       
    }

    public function logUserUpdate(UserUpdatedLogEvent $event){

        DB::connection('mysql_read')->table('users_logs')->insert([
           'user_id' => $event->getUserID(),
           'action' => $event->getAction(),
           'event_type' => UserUpdatedLogEvent::class ,
           'id' => (string) $event->getId(),
           'created_at' => now(),
           'ip' => $_SERVER['REMOTE_ADDR'],
           'event_handler' => UserUpdateLogEventListerner::class
         ]);
   }

    public function getLogByAction(string $action){

        return DB::connection('mysql_read')->table('users_logs')->where('action', $action)->get();
    }


}