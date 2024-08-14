<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Listerners\Role\RoleReadDBEvent;

use Source\User\Domain\Events\Role\RoleCreateEvent\RoleCreatedReadEvent;
use Source\User\Infrastructure\Repository\Role\Read\RoleReadRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class RoleCreatedReadEventListener implements ShouldQueue
{

    /**
     * @param RoleReadRepository $roleReadRepository
     */ 
    public function __construct(private RoleReadRepository $roleReadRepository)
    {
        
    }
    public function handle(RoleCreatedReadEvent $event): void  
    {
        $this->roleReadRepository->insertEvent($event->getRole());
    }

}