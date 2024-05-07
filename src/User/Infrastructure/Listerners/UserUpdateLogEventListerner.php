<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Listerners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Source\User\Domain\Entity\UserLog;
use Source\User\Domain\Events\UserUpdatedLogEvent;
use Source\User\Domain\Interfaces\UserLogRepositoryInterface;
use Source\User\Domain\Interfaces\UserLogReadRepositoryInterface;
use Source\User\Domain\ValueObjects\UserID;

class UserUpdateLogEventListerner  implements ShouldQueue
{
    /**
     * @var UserLogRepositoryInterface $userLogRepository
     */
    private UserLogRepositoryInterface $userLogRepository;
/**
 * @var UserLogReadRepositoryInterface $userLogReadRepository
 */
    private UserLogReadRepositoryInterface $userReadRepository;
   

/**
 * UserCreatedLogEventListener constructor.
 * @param UserLogRepositoryInterface $userLogRepository
 * @param UserLogReadRepositoryInterface $userReadRepository
 */
    public function __construct(UserLogRepositoryInterface $userLogRepository,UserLogReadRepositoryInterface $userReadRepository)   
    {
        $this->userLogRepository = $userLogRepository;

        $this->userReadRepository = $userReadRepository;
    

    }
///log event es para guardaer el evento de creacion de usuario
/**
 * Method to insert user log
 * @param UserUpdatedLogEvent $event
 */
    public function handle( UserUpdatedLogEvent $event)
    {
   
        $userLogEvent=  UserLog::createUserLog($event->getAction(),$event->getIp(),new UserID($event->getUserId()),$event->getEventType(),UserCreatedLogEventListener::class);
      
       
        $this->userLogRepository->insertLogUserUpdate($userLogEvent);

        $this->userReadRepository->logUserUpdate($event);


      

    }

}