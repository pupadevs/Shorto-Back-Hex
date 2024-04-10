<?php

declare(strict_types=1);

namespace Source\User\Domain\ValueObjects;

class Name implements StringValueObject
{
    private $name;

    public function __construct(?string $name = null)
    {
        $this->verifyName($name);
        $this->regexpr($name);

        $this->name = $name;

    }

    public function ToString(): string
    {

        return (string) $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    private function verifyName(?string $name)
    {

        if ($name === null || strlen($name) <= 3) {
            throw new \InvalidArgumentException('name too short or null', 400);
        }
    }

    private function regexpr(?string $name)
    {

        if (! preg_match('/^[a-zA-Z\s]+$/', $name)) {
            throw new \InvalidArgumentException('Invalid name', 400);
        }
    }
}
