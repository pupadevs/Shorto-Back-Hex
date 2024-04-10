<?php

declare(strict_types=1);

namespace Source\User\Domain\ValueObjects;

class Email implements StringValueObject
{
    private $email;

    public function __construct(?string $email = null)
    {
           if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $email === null) {
            throw new \InvalidArgumentException('Invalid email',400);
        }   
 
        $this->email = $email;
    }

    public function ToString(): string
    {

        return (string) $this;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
