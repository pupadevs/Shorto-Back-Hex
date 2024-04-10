<?php

declare(strict_types=1);

namespace Source\User\Domain\ValueObjects;

interface StringValueObject
{
    public function toString(): string;

    public function __toString(): string;
}
