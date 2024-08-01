<?php 

declare(strict_types=1);

namespace Tests\Fixtures;

use Source\User\Domain\Events\UserCreatedLogEvent;
use Source\User\Domain\Events\UserUpdatedLogEvent;
use Source\User\Domain\Entity\UserLog as EntityUserLog;
use Source\User\Domain\ValueObjects\UserID;

class UserLog
{

    public static function aUserCreatedLog(): EntityUserLog
    {
       $user=  Users::aUser();
        $event = new UserCreatedLogEvent($user->getId()->toString(),"127.0.0.1");
      
        
      $userLog =  EntityUserLog::createUserLog($event->getAction(),$event->getIp(),new UserID($event->getUserId()),$event->getEventType(),self::class);

        return $userLog;
    }

   /*  public static function aUserUpdatedLog(): UserLog
    {
        $event = new UserUpdatedLogEvent();
        $event->setUserID(1);
        $event->setAction('updated');
        $event->setId(123);

        return new UserLog($event);
    } */
}