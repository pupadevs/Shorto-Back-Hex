<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Listerners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Source\User\Domain\Entity\UserLog;
use Source\User\Domain\Events\UserCreatedLogEvent;
use Source\User\Domain\Interfaces\UserLogRepositoryInterface;
use Source\User\Domain\Interfaces\UserLogReadRepositoryInterface;
use Source\User\Domain\ValueObjects\UserID;
/**
 * Class UserCreatedLogEventListener to insert user log
 * 
 */
class UserCreatedLogEventListener  implements ShouldQueue
{
  /**
   * 
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
 * @param UserLogReadRepositoryInterface $userReadRepository
 */

    public function __construct(UserLogRepositoryInterface $userLogRepository, UserLogReadRepositoryInterface $userReadRepository)
    {
        $this->userLogRepository = $userLogRepository;
        $this->userLogReadRepository = $userReadRepository;

    }
///log event es para guardaer el evento de creacion de usuario
/**
 * Method to insert user log
 * @param UserCreatedLogEvent $event
 */
    public function handle(UserCreatedLogEvent $event)
    {
     
      $userLogEvent=  UserLog::createUserLog($event->getAction(),$event->getIp(),new UserID($event->getUserId()),$event->getEventType(),UserCreatedLogEventListener::class);
    //  var_dump($userLogEvent->getId());
   //   var_dump($userLogEvent);
        $this->userLogRepository->insertLogUserCreation($userLogEvent);

        $this->userLogReadRepository->insertUserLog($userLogEvent);
      /*   $this->userLogRepository->logUserUpdate($updateEvent);
        $this->userReadRepository->logUserUpdate($updateEvent); */


      

    }

}