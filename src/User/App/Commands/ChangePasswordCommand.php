<?php

declare(strict_types=1);

namespace Source\User\App\Commands;

use Source\Shared\CQRS\Command\Command;
use Source\User\Domain\Entity\User;
use Source\User\Domain\ValueObjects\Password;

class ChangePasswordCommand implements Command
{
    /**
     * Email of user
     * @var User $user
     */
    private User $user;

/**
 * New password of user
 * @var Password $new_password
 */
    private Password $new_password;
/**
 * Command constructor.
 * @param string $email, string $password_old, string $new_password
 * 
 */
    public function __construct(User $user, Password $new_password)
    {
        $this->user = $user;
       // $this->password_old = $password_old;
        $this->new_password = $new_password;
    }

    /**
     * Method to get email
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }


/**
 * Method to get new password
 * @return string
 */
    public function getNewPassword()
    {
        return password_hash($this->new_password->toString(), PASSWORD_DEFAULT);
    }
}
