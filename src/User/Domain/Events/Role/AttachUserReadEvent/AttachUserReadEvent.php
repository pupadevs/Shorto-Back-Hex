<?php

declare(strict_types=1);

namespace Source\User\Domain\Events\Role\AttachUserReadEvent;

use Source\User\Domain\ValueObjects\Role\RoleID;
use Source\User\Domain\ValueObjects\User\UserID;

class AttachUserReadEvent
{
    public function __construct(private RoleID $roleID, private UserID $userID){

    }

    public function getRoleID(): RoleID
    {
        return $this->roleID;
    }

    public function getUserID(): UserID
    {
        return $this->userID;
    }
}