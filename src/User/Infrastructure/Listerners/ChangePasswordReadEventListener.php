<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Listerners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Source\User\Domain\Events\ChangePasswordReadEvent;
use Source\User\Domain\Interfaces\UserReadRepositoryInterface;

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