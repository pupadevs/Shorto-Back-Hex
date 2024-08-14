<?php 

declare(strict_types=1);

namespace Source\User\App\Commands\RoleCommands\AttachUser;

use Source\Role\Domain\Entity\Role;
use Source\Role\Domain\ValueObjects\RoleName;
use Source\Shared\CQRS\Command\Command;
use Source\User\Domain\ValueObjects\Role\RoleID;
use Source\User\Domain\ValueObjects\User\UserID;


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