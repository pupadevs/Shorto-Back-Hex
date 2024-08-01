<?php 

declare(strict_types=1);

namespace Source\User\App\Commands;
use Source\Shared\CQRS\Command\Command;
use Source\User\Domain\Entity\User;

class DeleteUserCommand implements Command
{
    /**
     * @var User $user
     */
    private User $user;
    /**
     * Command constructor.
     * @param User $user 
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Method to get uuid
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}