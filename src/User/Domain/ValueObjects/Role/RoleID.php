<?php

declare(strict_types=1);

namespace Source\User\Domain\ValueObjects\Role;

use Ramsey\Uuid\Uuid;
use Source\Shared\StringValueObject\StringValueObject;

class RoleID implements StringValueObject
{
    private string $roleID;

    public function __construct(?string $roleID = null)
    {

        if ($roleID === null) {
            $this->roleID = Uuid::uuid4()->toString();
        }else{

            $this->roleID = $roleID;
        }
      //  $this->userID = $userID;
    }

    public function toString(): string
    {
        return $this->roleID;

    }

    public function __toString(): string
    {
        return $this->roleID;
    }
}
