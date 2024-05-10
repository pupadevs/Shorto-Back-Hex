<?php

declare(strict_types=1);

namespace Source\User\Domain\ValueObjects;

use Source\Shared\StringValueObject\StringValueObject;

class Email implements StringValueObject
{
    /**
     * Email
     * @var string
     */
    private $email;

    /**
     * Email constructor.
     * @param string|null $email
     * @throws \InvalidArgumentException
     * 
     */

    public function __construct(?string $email = null)
    {
           if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $email === null) {
            throw new \InvalidArgumentException('Invalid email',400);
        }   
 
        $this->email = $email;
    }
/**
 * Method to get email
 * @return string
 * 
 */
    public function ToString(): string
    {

        return (string) $this;
    }
/**
 * Method to get email
 * @return string
 */
    public function __toString(): string
    {
        return $this->email;
    }
}
