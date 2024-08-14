<?php 

declare(strict_types=1);

namespace Source\User\App\Commands\RoleCommands\CreateRole;


use Source\Role\Domain\ValueObjects\RoleName;
use Source\User\App\Commands\RoleCommands\CreateRole\CreateRoleUserCommand;
use Source\User\Domain\Entity\Role\Role;
use Source\User\Domain\Events\Role\RoleCreateEvent\RoleCreatedReadEvent;
use Source\User\Domain\Interfaces\RoleRepository\RoleReadRepositoryInterface;
use Source\User\Domain\Interfaces\RoleRepository\RoleRepositoryInterface;
use Source\User\Domain\ValueObjects\Name;

 class CreateRoleUserCommandHandler
{
    private RoleReadRepositoryInterface $roleReadRepository;
    private RoleRepositoryInterface $roleRepository;
    public function __construct(  RoleRepositoryInterface $roleRepository, RoleReadRepositoryInterface $roleReadRepository)
    {
      
        $this->roleRepository = $roleRepository;
        $this->roleReadRepository = $roleReadRepository;
    }
    public function execute(CreateRoleUserCommand $command): Role
    {
        $role =  $this->roleReadRepository->getRoleByName($command->getRole()->getRoleName());
         if($role){
            return $role;
        } 
        
           
            
      $this->roleRepository->insertRole($command->getRole());
     // $this->roleReadRepository->insertEvent($command->getRole());
    event(new RoleCreatedReadEvent($command->getRole()));
        return $command->getRole();

        
        
    }

}