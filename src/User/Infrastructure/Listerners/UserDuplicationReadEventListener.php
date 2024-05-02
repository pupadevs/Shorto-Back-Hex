<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Listerners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Events\UserUpdatedReadEvent;
use Source\User\Infrastructure\Repository\Read\UserReadRepository;

class UserDuplicationReadEventListener implements ShouldQueue {
    private $userReadRepository;

    public function __construct(UserReadRepository $userReadRepository)
    {
        $this->userReadRepository = $userReadRepository;
    }
    //Duplicate event es para evitar el evento de creacion de usuario en la tabla de lectura
    public  function handle(UserCreatedReadEvent $event){

        $this->userReadRepository->insertUserReadDB($event);

    
    }
}