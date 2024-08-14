<?php 

declare(strict_types=1);

namespace Source\User\App\Commands\RoleCommands\AttachUser;

use Source\Role\Domain\Entity\Role;
use Source\User\Domain\Events\Role\AttachUserReadEvent\AttachUserReadEvent;
use Source\User\Domain\Interfaces\RoleRepository\RoleRepositoryInterface;

 class AttachUserRoleCommandHandler
{   
    private RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)    
    {
        
        $this->roleRepository = $roleRepository;
    }
    

    public function execute(AttachUserRoleCommand $command): void
    {
        
        $this->roleRepository->atttachRoleToUser($command->getUserID(), $command->getRoleID());
        event(new AttachUserReadEvent($command->getRoleID(), $command->getUserID()));
    }
}