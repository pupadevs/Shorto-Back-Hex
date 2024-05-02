<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Listerners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Source\User\Domain\Events\UserUpdatedReadEvent;
use Source\User\Domain\Interfaces\UserReadRepositoryInterface;

class UserUpdateReadEventListerner  implements ShouldQueue
{
    private UserReadRepositoryInterface $userReadRepository;


    public function __construct(UserReadRepositoryInterface $userReadRepository)
    {
        $this->userReadRepository = $userReadRepository;

    }


    public function handle( UserUpdatedReadEvent $event)
    {
        $this->userReadRepository->save($event);
    }
}