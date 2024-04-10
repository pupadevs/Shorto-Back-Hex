<?php

declare(strict_types=1);

namespace Source\User\App\Querys;

use Source\Shared\CQRS\Querys\Query;

class CheckPasswordQuery implements Query
{
    private string $email;

    private string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return password_hash($this->password, PASSWORD_DEFAULT);
    }
}
