<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Listerners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserReadRepositoryInterface;

class UserDuplicationReadEventListener implements ShouldQueue {
    /**
     * @var UserReadRepositoryInterface  $userReadRepository
     */
    private UserReadRepositoryInterface $userReadRepository;
/**
 * UserDuplicationReadEventListener constructor.
 * @param UserReadRepositoryInterface $userReadRepository
 */
    public function __construct(UserReadRepositoryInterface $userReadRepository)
    {
        $this->userReadRepository = $userReadRepository;
    }
    //Duplicate event es para evitar el evento de creacion de usuario en la tabla de lectura
    /**
     * Method to insert user log in read table
     * @param UserCreatedReadEvent $event
     */
    public  function handle(UserCreatedReadEvent $event){

        $this->userReadRepository->insertUserReadDB($event);

    
    }
}