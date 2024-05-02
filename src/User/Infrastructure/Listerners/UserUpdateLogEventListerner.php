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

class UserUpdateLogEventListerner  implements ShouldQueue
{
    private $userLogRepository;

    private $userReadRepository;
   


    public function __construct(UserLogRepositoryInterface $userLogRepository,UserLogReadRepositoryInterface $userReadRepository)   
    {
        $this->userLogRepository = $userLogRepository;

        $this->userReadRepository = $userReadRepository;
    

    }
///log event es para guardaer el evento de creacion de usuario
    public function handle( UserUpdatedLogEvent $event)
    {
   
        $userLogEvent=  UserLog::createUserLog($event->getAction(),$event->getIp(),new UserID($event->getUserId()),$event->getEventType(),UserCreatedLogEventListener::class);
      
       
        $this->userLogRepository->insertLogUserUpdate($userLogEvent);

        $this->userReadRepository->logUserUpdate($event);


      

    }

}