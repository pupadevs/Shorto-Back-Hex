<?php

declare(strict_types=1);

namespace Source\User\Domain\ValueObjects\User;

use Ramsey\Uuid\Uuid;
use Source\Shared\StringValueObject\StringValueObject;

class UserID implements StringValueObject
{
    private string $userID;

    public function __construct(?string $userID = null)
    {

        if ($userID === null) {
            $this->userID = Uuid::uuid4()->toString();
        }else{

            $this->userID = $userID;
        }
      //  $this->userID = $userID;
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
