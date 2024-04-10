<?php

declare(strict_types=1);

namespace Source\User\App\Commands;

use Source\Shared\CQRS\Command\Command;

class UserCreateCommand implements Command
{
    private $name;

    private $email;

    private $password;

    public function __construct($name, $email, $password)
    {

        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function getName()
    {
        return $this->name;

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
