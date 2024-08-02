<?php 

declare(strict_types=1);

namespace Source\Role\Infrastructure\Listerners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Source\Role\Domain\Events\RoleCreatedReadEvent;
use Source\Role\Infrastructure\Repository\Read\RoleReadRepository;

class RoleCreatedReadEventListener implements ShouldQueue{

    public function __construct(private RoleReadRepository $roleReadRepository){
        
    }

    public function handle(RoleCreatedReadEvent $event): void
    {
       // var_dump($event->getRole());
        $this->roleReadRepository->insertEvent($event->getRole());
    }
}