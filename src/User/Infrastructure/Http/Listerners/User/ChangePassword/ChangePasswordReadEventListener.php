<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Listerners\User\ChangePassword;

use Illuminate\Contracts\Queue\ShouldQueue;
use Source\User\Domain\Events\User\ChangePasswordEvent\ChangePasswordReadEvent;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserReadRepositoryInterface;

class ChangePasswordReadEventListener implements ShouldQueue
{
    private UserReadRepositoryInterface $userReadRepositoryInterface;

    /**
     * ChangePasswordReadEventListener constructor.
     * @param UserReadRepositoryInterface $userReadRepositoryInterface
     */
    public function __construct(UserReadRepositoryInterface $userReadRepositoryInterface)
    {

        $this->userReadRepositoryInterface = $userReadRepositoryInterface;
    }


    /**
     * @param ChangePasswordReadEvent $event
     * @return void
     */
    public function handle(ChangePasswordReadEvent $event)
    {
        $this->userReadRepositoryInterface->changePassword($event);
    }   

}