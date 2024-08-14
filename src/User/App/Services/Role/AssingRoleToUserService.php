<?php 

declare(strict_types=1);

namespace Source\User\App\Services\Role;


use Source\Role\Domain\ValueObjects\RoleName;
use Source\Shared\CQRS\Command\CommandBus;
use Source\User\App\Commands\RoleCommands\AttachUser\AttachUserRoleCommand;
use Source\User\App\Commands\RoleCommands\CreateRole\CreateRoleUserCommand;
use Source\User\App\Services\Role\AssingRoleToUserServiceInterface;
use Source\User\Domain\Entity\Role\Role;
use Source\User\Domain\Interfaces\RoleRepository\RoleRepositoryInterface;
use Source\User\Domain\ValueObjects\User\Name;
use Source\User\Domain\ValueObjects\User\UserID;

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