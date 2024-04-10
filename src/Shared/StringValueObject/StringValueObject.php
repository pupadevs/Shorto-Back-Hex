<?php

declare(strict_types=1);

namespace Source\Shared\StringValueObject;

interface StringValueObject
{
    public function toString(): string;

    public function __toString(): string;
}
