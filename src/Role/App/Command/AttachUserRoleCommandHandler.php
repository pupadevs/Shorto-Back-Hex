<?php 

declare(strict_types=1);

namespace Source\Role\App\Command;

use Source\Role\Domain\Entity\Role;
use Source\Role\Domain\RoleRepositoryInterface;

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
    }
}