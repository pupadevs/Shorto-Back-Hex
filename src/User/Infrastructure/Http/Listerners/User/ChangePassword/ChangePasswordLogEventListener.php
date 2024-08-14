<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Listerners\User\ChangePassword;

use Source\User\Domain\Entity\UserLog\UserLog;
use Source\User\Domain\Events\User\ChangePasswordEvent\ChangePasswordLogEvent;
use Source\User\Domain\Interfaces\UserLogRepositoryContracts\UserLogRepositoryInterface;
use Source\User\Domain\Interfaces\UserLogRepositoryContracts\UserLogReadRepositoryInterface;
use Source\User\Domain\ValueObjects\User\UserID;

class ChangePasswordLogEventListener
{

    private UserLogRepositoryInterface $userLogRepositoryInterface;
    private UserLogReadRepositoryInterface $userLogReadRepositoryInterface;

    /**
     * ChangePasswordLogEventListener constructor.
     * @param UserLogRepositoryInterface $userLogRepositoryInterface
     * @param UserLogReadRepositoryInterface $userLogReadRepositoryInterface
     */
    public function __construct
    (UserLogRepositoryInterface $userLogRepositoryInterface,
     UserLogReadRepositoryInterface $userLogReadRepositoryInterface)
    {
        /**
         * Assign the interface to the attribute
         * @var UserLogRepositoryInterface $userLogRepositoryInterface
         */
        $this->userLogRepositoryInterface = $userLogRepositoryInterface;

        /**
         * Assign the interface to the attribute
         * @var UserLogReadRepositoryInterface $userLogReadRepositoryInterface
         */
        $this->userLogReadRepositoryInterface = $userLogReadRepositoryInterface;

    }


    /**
     *  
     *  
     *  @param ChangePasswordLogEvent $event
     * @return void
     */
    public function handle(ChangePasswordLogEvent $event)
    {
      //  $event->setEventHandler(self::class);
        $this->userLogRepositoryInterface->save(UserLog::createUserLog( $event->getAction(), $event->getIp(),new UserID($event->getUserID()), $event->getEventType(), self::class));
        $this->userLogReadRepositoryInterface->save(UserLog::createUserLog( $event->getAction(), $event->getIp(),new UserID($event->getUserID()), $event->getEventType(), self::class));
    }

}

