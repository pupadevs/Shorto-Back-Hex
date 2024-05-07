<?php

declare(strict_types=1);

namespace Source\User\App\Commands;

use Source\Shared\CQRS\Command\Command;

class ChangePasswordCommand implements Command
{
    /**
     * Email of user
     * @var string
     */
    private string $email;
/**
 * Password of user
 * @var string
 */
    private string $password_old;
/**
 * New password of user
 * @var string
 */
    private string $new_password;
/**
 * Command constructor.
 * @param string $email, string $password_old, string $new_password
 * 
 */
    public function __construct(string $email, string $password_old, string $new_password)
    {
        $this->email = $email;
        $this->password_old = $password_old;
        $this->new_password = $new_password;
    }

    /**
     * Method to get email
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Method to get old password
     *  @return string 
     */
    public function getOldPassword()
    {
        return password_hash($this->password_old, PASSWORD_DEFAULT);
    }
/**
 * Method to get new password
 * @return string
 */
    public function getNewPassword()
    {
        return password_hash($this->new_password, PASSWORD_DEFAULT);
    }
}
