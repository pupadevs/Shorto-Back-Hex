<?php 

declare(strict_types=1);

namespace Source\Role\App\Command;

use Source\Role\Domain\Entity\Role;
use Source\Role\Domain\Events\RoleCreatedReadEvent;
use Source\Role\Domain\RoleReadRepositoryInterface;
use Source\Role\Domain\RoleRepositoryInterface;
use Source\Role\Domain\ValueObjects\RoleName;
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