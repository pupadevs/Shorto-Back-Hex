<?php 

declare(strict_types=1);

namespace Source\Role\App\Service;

use Source\Role\App\Command\AttachUserRoleCommand;
use Source\Role\App\Command\CreateRoleUserCommand;
use Source\Role\Domain\Entity\Role;
use Source\Role\Domain\RoleRepositoryInterface;
use Source\Role\Domain\ValueObjects\RoleName;
use Source\User\Domain\ValueObjects\UserID;
use Source\Shared\CQRS\Command\CommandBus;
use Source\User\Domain\ValueObjects\Name;

class AssingRoleToUserService implements AssingRoleToUserServiceInterface
{

 

  public function __construct(  private CommandBus $command, private RoleRepositoryInterface $roleRepository){

  }

     public function assingRoleToUser(UserID $userID, ): Role
     {
      $user = Role::createRole(new Name('user'));
     $role = $this->command->execute(new CreateRoleUserCommand($user));
     
     var_dump($role);

     $this->command->execute(new AttachUserRoleCommand($userID, $role->getRoleID()));

      return$role;

        

     }

}