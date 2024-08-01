<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository\Read;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Source\User\Domain\Entity\UserLog;
use Source\User\Domain\Events\UserCreatedLogEvent;
use Source\User\Domain\Events\UserUpdatedLogEvent;
use Source\User\Domain\Interfaces\UserLogReadRepositoryInterface;
use Source\User\Infrastructure\Listerners\UserCreatedLogEventListener;
use Source\User\Infrastructure\Listerners\UserUpdateLogEventListerner;

class UserLogReadRepository implements UserLogReadRepositoryInterface
{
    /**
     * get all logs from database read
     * @return Collection
     */
    public function getUserLogs():array
    {
        $logs= DB::connection('mysql_read')->table('users_logs')->get();
        return get_object_vars($logs);
    }
/**
 * save a new user in the database Read
 * @param UserLog $event
 * 
 */


  

   /**
    * get user logs by action from database read
    * @param string $action
    */
    public function getLogByAction(string $action){

        return DB::connection('mysql_read')->table('users_logs')->where('action', $action)->get();
    }

    public function save(UserLog $event)
    {

        DB::connection('mysql_read')->table('users_logs')->insert([
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