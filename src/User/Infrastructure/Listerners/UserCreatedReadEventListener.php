<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Listerners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Source\User\App\Events\UserCreatedEvent;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Infrastructure\Repository\Read\UserReadRepository;

class UserCreatedReadEventListener implements ShouldQueue {
    private $userReadRepository;

    public function __construct(UserReadRepository $userReadRepository)
    {
        $this->userReadRepository = $userReadRepository;
    }

    public  function handle(UserCreatedReadEvent $event){

        $this->userReadRepository->insert($event);
    }
}