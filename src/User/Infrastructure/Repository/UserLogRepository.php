<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Source\User\Domain\Entity\UserLog;
use Source\User\Domain\Events\UserCreatedLogEvent;
use Source\User\Domain\Events\UserUpdatedLogEvent;
use Source\User\Domain\Interfaces\UserLogRepositoryInterface;
use Source\User\Infrastructure\Listerners\UserCreatedLogEventListener;
use Source\User\Infrastructure\Listerners\UserUpdateLogEventListerner;

class UserLogRepository implements UserLogRepositoryInterface
{
  /**
   * save a new user in the database Write
   * @param UserLog $event
   */
    public function insertLogUserCreation(UserLog $event)
    {
       $user=   DB::connection('mysql')->table('users_logs')->insert([
        'user_id' => $event->getUserID(),
        'action' => $event->getAction(),
        'event_type' => UserCreatedLogEvent::class ,
        'id' => (string) $event->getId(),
        'created_at' => now(),
        'ip' => $event->getIp(),
        'event_handler' => UserCreatedLogEventListener::class
      ]);
     
    }
    /**
     *  save a new user in the database Write
     * @param UserLog $event
     */
    
    public function insertLogUserUpdate(UserLog $event){

         DB::connection('mysql')->table('users_logs')->insert([
            'user_id' => $event->getUserID(),
            'action' => $event->getAction(),
            'event_type' => UserUpdatedLogEvent::class ,
          'id' => (string) $event->getId(),
            'created_at' => now(),
            'ip' => $event->getIp(),
            'event_handler' => UserUpdateLogEventListerner::class
          ]);
    }

    public function save(UserLog $event)
    {

        DB::connection('mysql')->table('users_logs')->insert([
          'id' => $event->getId(),
            'user_id' => $event->getUserID(),
            'action' => $event->getAction(),
            'event_type' => $event->getEventType(),
            'created_at' => Carbon::now(),
            'ip' => $event->getIp(),
            'event_handler' => $event->getEventHandler()
        ]);
    }
}