<?php
declare(strict_types=1);

namespace Source\User\App\Querys\RoleQuery\CheckUserRole;
use Source\Shared\CQRS\Querys\Query;
use Source\User\Domain\ValueObjects\Role\RoleID;
use Source\User\Domain\ValueObjects\User\UserID;

class CheckUserRoleQuery implements Query
{
  


   
    /**
     * Summary of __construct
     * @param RoleID $roleID
     * @param UserID $userID
     */
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