<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Listerners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Source\User\App\Events\UserCreatedEvent;
use Source\User\Infrastructure\Repository\UserLogRepository;
use Source\User\Infrastructure\Repository\UserReadRepository;

class UserCreatedEventListerner  implements ShouldQueue
{
    private $userLogRepository;

    public function __construct(UserLogRepository $userLogRepository)
    {
        $this->userLogRepository = $userLogRepository;

     //   $this->userReadRepository = $userReadRepository;
    }

    public function handle(UserCreatedEvent $event)
    {
     
      
        $this->userLogRepository->logUserCreation($event);

    }

}