<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Listerners\User\UserUpdate;

use Illuminate\Contracts\Queue\ShouldQueue;
use Source\User\Domain\Events\User\UserUpdatedEvent\UserUpdatedReadEvent;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserReadRepositoryInterface;

class UserUpdateReadEventListerner  implements ShouldQueue
{
    /**
     * @var UserReadRepositoryInterface $userReadRepository
     */
    private UserReadRepositoryInterface $userReadRepository;

/**
 * UserUpdateReadEventListerner constructor.
 * @param UserReadRepositoryInterface $userReadRepository
 */
    public function __construct(UserReadRepositoryInterface $userReadRepository)
    {
        $this->userReadRepository = $userReadRepository;

    }
/**
 * Method to insert user log in read table
 * @param UserUpdatedReadEvent $event
 */

    public function handle( UserUpdatedReadEvent $event)
    {
        $this->userReadRepository->save($event);
    }
}