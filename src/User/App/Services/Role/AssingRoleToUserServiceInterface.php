<?php 

declare(strict_types=1);

namespace Source\User\App\Services\Role;

use Source\User\Domain\Entity\Role\Role;
use Source\User\Domain\ValueObjects\User\UserID;

interface AssingRoleToUserServiceInterface  
{
    public function assingRoleToUser(UserID $userID): Role;
}