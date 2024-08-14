<?php 

declare(strict_types=1);

namespace Source\User\App\Commands\RoleCommands\AttachUser;

use Source\Role\Domain\Entity\Role;
use Source\User\Domain\Events\Role\AttachUserReadEvent\AttachUserReadEvent;
use Source\User\Domain\Interfaces\RoleRepository\RoleReadRepositoryInterface;
use Source\User\Domain\Interfaces\RoleRepository\RoleRepositoryInterface;

 class AttachUserRoleCommandHandler
{   

    public function __construct(private RoleRepositoryInterface $roleRepository, private RoleReadRepositoryInterface $roleReadRepository)    
    {
        
        $this->roleRepository = $roleRepository;
        $this->roleReadRepository = $roleReadRepository;
    }
    

    public function execute(AttachUserRoleCommand $command): void
    {
        $role = $this->roleReadRepository->verifyUserHasRole($command->getUserID(), $command->getRoleID());
        if($role){
            return;
        }
        $this->roleRepository->atttachRoleToUser($command->getUserID(), $command->getRoleID());
        event(new AttachUserReadEvent($command->getRoleID(), $command->getUserID()));
    }
}