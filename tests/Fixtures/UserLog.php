<?php 

declare(strict_types=1);

namespace Tests\Fixtures;

use Source\User\Domain\Entity\UserLog\UserLog as UserLogUserLog;
use Source\User\Domain\Events\User\UserCreatedEvent\UserCreatedLogEvent;
use Source\User\Domain\ValueObjects\User\UserID;

class UserLog
{

    public static function aUserCreatedLog(): UserLogUserLog
    {
       $user=  Users::aUser();
        $event = new UserCreatedLogEvent($user->getId()->toString(),"127.0.0.1");
      
        
      $userLog =  UserLogUserLog::createUserLog($event->getAction(),$event->getIp(),new UserID($event->getUserId()),$event->getEventType(),self::class);

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