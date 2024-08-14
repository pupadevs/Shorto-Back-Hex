<?php 

declare(strict_types=1);

namespace Source\User\Domain\ValueObjects\Role;

use Source\Shared\StringValueObject\StringValueObject;

class RoleName implements StringValueObject
{

    private string $roleName;
    public function __construct(string $roleName)
    {
        $this->roleName = $roleName;
    }
    public function toString(): string
    {
        return (string) $this;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}