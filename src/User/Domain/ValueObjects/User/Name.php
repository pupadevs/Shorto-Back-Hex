<?php

declare(strict_types=1);

namespace Source\User\Domain\ValueObjects\User;

use Source\Shared\StringValueObject\StringValueObject;

class Name implements StringValueObject
{
    /**
     * Name
     * @var string
     */
    private $name;
    /**
     * Name constructor.
     * @param string|null $name
     */
    public function __construct(?string $name = null)
    {
        $this->verifyName($name);
        $this->regexpr($name);

        $this->name = $name;

    }

    /**
     * Method to get name
     * @return string
     * 
     */
    public function ToString(): string
    {

        return (string) $this;
    }
/**
 * Method to get name 
 * @return string
 */
    public function __toString(): string
    {
        return $this->name;
    }
/**
 * Verify name and throw exception if invalid or null 
 * @param string|null $name
 * @throws \InvalidArgumentException
 */
    private function verifyName(?string $name)
    {

        if ($name === null || strlen($name) <= 3) {
            throw new \InvalidArgumentException('name too short or null', 400);
        }
    }
/**
 * regexpr to verify name and throw exception if invalid
 * @param string|null $name
 * @throws \InvalidArgumentException
 */
    private function regexpr(?string $name)
    {

        if (! preg_match('/^[a-zA-Z\s]+$/', $name)) {
            throw new \InvalidArgumentException('Invalid name', 400);
        }
    }
}
