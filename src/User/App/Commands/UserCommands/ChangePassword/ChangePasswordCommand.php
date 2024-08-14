<?php

declare(strict_types=1);

namespace Source\User\App\Commands\UserCommands\ChangePassword;

use Source\Shared\CQRS\Command\Command;
use Source\User\Domain\Entity\User\User;
use Source\User\Domain\ValueObjects\User\Password;

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
 * Ip of user
 * @var string $ip
 */
    private string $ip = '127.0.0.1';
/**
 * Command constructor.
 * @param string $email, string $password_old, string $new_password
 * 
 */
    public function __construct(User $user, Password $new_password)
    {
        $this->user = $user;
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
 * Method to get ip
 * @return string
 */
    public function getIp(): string
    {
        return $this->ip;
    }


/**
 * Method to get new password
 * @return Password
 */
    public function getNewPassword(): Password
    {
        return $this->new_password;
    }
}
