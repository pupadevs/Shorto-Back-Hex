<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Listerners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Source\User\Domain\Entity\UserLog\UserLog;
use Source\User\Domain\Events\User\UserUpdatedEvent\UserUpdatedLogEvent;
use Source\User\Domain\Interfaces\UserLogRepositoryContracts\UserLogRepositoryInterface;
use Source\User\Domain\Interfaces\UserLogRepositoryContracts\UserLogReadRepositoryInterface;
use Source\User\Domain\ValueObjects\User\UserID;

class UserUpdateLogEventListerner  implements ShouldQueue
{
    /**
     * @var UserLogRepositoryInterface $userLogRepository
     */
    private UserLogRepositoryInterface $userLogRepository;
/**
 * @var UserLogReadRepositoryInterface $userLogReadRepository
 */
    private UserLogReadRepositoryInterface $userLogReadRepository;
   

/**
 * UserCreatedLogEventListener constructor.
 * @param UserLogRepositoryInterface $userLogRepository
 * @param UserLogReadRepositoryInterface $userLogReadRepository
 */
    public function __construct(UserLogRepositoryInterface $userLogRepository,UserLogReadRepositoryInterface $userLogReadRepository)   
    {
        $this->userLogRepository = $userLogRepository;

        $this->userLogReadRepository = $userLogReadRepository;
    

    }
///log event es para guardaer el evento de creacion de usuario
/**
 * Method to insert user log
 * @param UserUpdatedLogEvent $event
 */
    public function handle( UserUpdatedLogEvent $event)
    {
   
        $userLogEvent=  UserLog::createUserLog($event->getAction(),$event->getIp(),new UserID($event->getUserId()),$event->getEventType(),UserCreatedLogEventListener::class);
      
       
        $this->userLogRepository->save($userLogEvent);

        $this->userLogReadRepository->save($userLogEvent);


      

    }

}