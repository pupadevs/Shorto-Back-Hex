<?php 

declare(strict_types=1);

namespace Source\Role\App\Service;

use Source\Role\Domain\Entity\Role;
use Source\User\Domain\ValueObjects\UserID;

interface AssingRoleToUserServiceInterface  
{
    public function assingRoleToUser(UserID $userID): Role;
}