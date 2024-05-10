<?php 

declare(strict_types=1);

namespace Source\User\Domain\Events;

use Source\User\Domain\Entity\User;

class DeleteUserReadEvent
{
    /**
     * @var User
     */
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Method to get user
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}