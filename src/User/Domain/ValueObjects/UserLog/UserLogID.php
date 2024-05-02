<?php

declare(strict_types=1);

namespace Source\User\Domain\ValueObjects\UserLog;

use Ramsey\Uuid\Uuid;
use Source\Shared\StringValueObject\StringValueObject;

class UserLogID implements StringValueObject
{
    private string $userLogId;

    public function __construct(?string $userLogId = null)
    {

        if ($userLogId === null) {
            $this->userLogId = Uuid::uuid4()->toString();
        }else{

            $this->userLogId = $userLogId;
        }
      //  $this->userLogId = $userLogId;
    }

    public function toString(): string
    {
        return $this->userLogId;

    }

    public function __toString(): string
    {
        return $this->userLogId;
    }
}
