<?php

declare(strict_types=1);

namespace Source\User\Domain\ValueObjects;

class Password implements StringValueObject
{
    private string $password;

    public function __construct(?string $password = null)
    {
     
       $this->verifyPassword($password);
       
        $this->password = $password;
    }

    public function ToString(): string
    {

        return (string) $this;
    }

    public function __toString(): string
    {
        return $this->password;
    }

    private function verifyPassword(?string $password)
    {
        if ($password === null || strlen($password) < 8) {
            throw new \Exception('Password must be at least 8 characters long', 400);
        }
    }
}
