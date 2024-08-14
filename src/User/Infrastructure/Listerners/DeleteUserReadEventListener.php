<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Listerners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Source\User\Domain\Events\User\DeleteUserEvent\DeleteUserReadEvent;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserReadRepositoryInterface;

class DeleteUserReadEventListener implements ShouldQueue
{
    /**
     * @var UserReadRepositoryInterface  $userReadRepository
     * 
     * 
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

    /**
     * Method to insert user log in read table
     * @param DeleteUserReadEvent $event
     */
    public  function handle(DeleteUserReadEvent $event){

        $this->userReadRepository->deleteUser($event);
        

    }

}