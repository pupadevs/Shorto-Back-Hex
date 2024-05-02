<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Listerners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Source\User\Domain\Entity\UserLog;
use Source\User\Domain\Events\UserCreatedLogEvent;
use Source\User\Domain\Events\UserUpdatedLogEvent;
use Source\User\Domain\Interfaces\UserLogRepositoryInterface;
use Source\User\Domain\Interfaces\UserLogReadRepositoryInterface;
use Source\User\Domain\ValueObjects\UserID;

class UserCreatedLogEventListener  implements ShouldQueue
{
    private $userLogRepository;
    private $userReadRepository;


    public function __construct(UserLogRepositoryInterface $userLogRepository, UserLogReadRepositoryInterface $userReadRepository)
    {
        $this->userLogRepository = $userLogRepository;
        $this->userReadRepository = $userReadRepository;

    }
///log event es para guardaer el evento de creacion de usuario
    public function handle(UserCreatedLogEvent $event)
    {
     
      $userLogEvent=  UserLog::createUserLog($event->getAction(),$event->getIp(),new UserID($event->getUserId()),$event->getEventType(),UserCreatedLogEventListener::class);
    //  var_dump($userLogEvent->getId());
   //   var_dump($userLogEvent);
        $this->userLogRepository->insertLogUserCreation($userLogEvent);

        $this->userReadRepository->insertUserLog($userLogEvent);
      /*   $this->userLogRepository->logUserUpdate($updateEvent);
        $this->userReadRepository->logUserUpdate($updateEvent); */


      

    }

}