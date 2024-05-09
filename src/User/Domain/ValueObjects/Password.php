<?php

declare(strict_types=1);

namespace Source\User\Domain\ValueObjects;

class Password implements StringValueObject
{
    /**
     * Password
     * @var string
     */
    private string $password;
/**
 * Password constructor.
 * @param string|null $password
 */
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

    /**
     * Verify password and throw exception if invalid or null
     * @param string|null $password
     * @throws \Exception
     */
    private function verifyPassword(?string $password)
    {
        if ($password === null || strlen($password) < 8) {
            throw new \InvalidArgumentException('Password must be at least 8 characters long', 400);
        }
    }
}
