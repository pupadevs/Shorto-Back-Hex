<?php 

declare(strict_types=1);

namespace Source\Role\App\Command;

use Source\Role\Domain\Entity\Role;
use Source\Role\Domain\ValueObjects\RoleID;
use Source\Role\Domain\ValueObjects\RoleName;
use Source\Shared\CQRS\Command\Command;
use Source\User\Domain\ValueObjects\UserID;


 class AttachUserRoleCommand implements Command
{
  
    public function __construct( private UserID $userID,
    private RoleID $roleID)
    {
       
    }

    public function getUserID(): UserID
    {
        return $this->userID;
    }

    public function getRoleID(): RoleID
    {
        return $this->roleID;
    }

  

}