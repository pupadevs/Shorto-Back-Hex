<?php

declare(strict_types=1);

namespace Source\User\App\Commands;

use Source\Shared\CQRS\Command\Command;

class ChangePasswordCommand implements Command
{
    private string $email;

    private string $password_old;

    private string $new_password;

    public function __construct(string $email, string $password_old, string $new_password)
    {
        $this->email = $email;
        $this->password_old = $password_old;
        $this->new_password = $new_password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getOldPassword()
    {
        return password_hash($this->password_old, PASSWORD_DEFAULT);
    }

    public function getNewPassword()
    {
        return password_hash($this->new_password, PASSWORD_DEFAULT);
    }
}
