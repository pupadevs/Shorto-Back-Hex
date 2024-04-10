<?php

declare(strict_types=1);

namespace Source\User\Domain\ValueObjects;

use Ramsey\Uuid\Uuid;

class UserID implements StringValueObject
{
    private string $userID;

    public function __construct(?string $userID = null)
    {

        if ($userID === null) {
            $this->userID = Uuid::uuid4()->toString();
        }
        $this->userID = Uuid::uuid4()->toString();
    }

    public function toString(): string
    {
        return $this->userID;

    }

    public function __toString(): string
    {
        return $this->userID;
    }
}
