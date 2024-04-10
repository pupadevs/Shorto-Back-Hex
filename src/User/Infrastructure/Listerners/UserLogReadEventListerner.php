<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Listerners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Source\User\App\Events\UserCreatedEvent;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Infrastructure\Repository\Read\UserLogReadRepisotory as ReadUserLogReadRepisotory;
use Source\User\Infrastructure\Repository\UserReadRepository;

class UserLogReadEventListerner implements ShouldQueue {
    private $userReadRepository;

    public function __construct(ReadUserLogReadRepisotory $userReadRepository)
    {
        $this->userReadRepository = $userReadRepository;
    }

    public  function handle(UserCreatedEvent $event){

        $this->userReadRepository->logUserCreation($event);
    }

  
}