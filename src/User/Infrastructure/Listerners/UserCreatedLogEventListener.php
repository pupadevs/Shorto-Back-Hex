<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Listerners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Source\User\Domain\Entity\UserLog\UserLog;
use Source\User\Domain\Events\User\UserCreatedEvent\UserCreatedLogEvent;
use Source\User\Domain\Interfaces\UserLogRepositoryContracts\UserLogRepositoryInterface;
use Source\User\Domain\Interfaces\UserLogRepositoryContracts\UserLogReadRepositoryInterface;
use Source\User\Domain\ValueObjects\User\UserID;

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
     
      $userLog=  UserLog::createUserLog($event->getAction(),$event->getIp(),new UserID($event->getUserId()),$event->getEventType(),self::class);
 
        $this->userLogRepository->save($userLog);

        $this->userLogReadRepository->save($userLog);
    

      

    }

}