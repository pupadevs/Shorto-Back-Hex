<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Listerners\Role\AttachUserReadDBEvent;

use Source\User\Domain\Events\Role\RoleCreateEvent\RoleCreatedReadEvent;
use Source\User\Infrastructure\Repository\Role\Read\RoleReadRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Source\User\Domain\Events\Role\AttachUserReadEvent\AttachUserReadEvent;

class AttachUserReadEventListener implements ShouldQueue
{
   
    public function __construct(private RoleReadRepository $roleReadRepository) 
    {
        $this->roleReadRepository = $roleReadRepository;
    }

    public function handle(AttachUserReadEvent $event): void
    {
        $this->roleReadRepository->atttachRoleToUserInReadDatabase($event->getUserID(), $event->getRoleID());
    }

}