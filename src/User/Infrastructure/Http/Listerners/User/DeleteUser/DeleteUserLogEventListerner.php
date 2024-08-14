<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Listerners\User\DeleteUser;

use Illuminate\Contracts\Queue\ShouldQueue;
use Source\User\Domain\Entity\UserLog\UserLog;
use Source\User\Domain\Events\User\DeleteUserEvent\DeleteUserLogEvent;
use Source\User\Domain\Interfaces\UserLogRepositoryContracts\UserLogRepositoryInterface;
use Source\User\Domain\Interfaces\UserLogRepositoryContracts\UserLogReadRepositoryInterface;
use Source\User\Domain\ValueObjects\User\UserID;

class DeleteUserLogEventListerner  implements ShouldQueue
{
    /**
     * @var UserLogRepositoryInterface $userLogRepository
     */
    private UserLogRepositoryInterface $userLogRepository;
/**
 * @var UserLogReadRepositoryInterface $userLogReadRepository
 */
    private UserLogReadRepositoryInterface $userLogReadRepository;


    public function __construct(UserLogRepositoryInterface $userLogRepository,UserLogReadRepositoryInterface $userLogReadRepository)
    {
        $this->userLogRepository = $userLogRepository;
        $this->userLogReadRepository = $userLogReadRepository;
    }


    public function handle(DeleteUserLogEvent $event)
    {
      //  $this->userLogRepository->save(UserLog::createUserLog($event->getAction(),$event->getIp(),new UserID($event->getUserId(),$event->getEventType(),DeleteUserLogEventListerner::class));
      $this->userLogReadRepository->save(UserLog::createUserLog($event->getAction(),$event->getIp(),new UserID($event->getUserId()),$event->getEventType(),DeleteUserLogEventListerner::class));

        $this->userLogReadRepository->save(UserLog::createUserLog($event->getAction(),$event->getIp(),new UserID($event->getUserId()),$event->getEventType(),DeleteUserLogEventListerner::class));
    }
}