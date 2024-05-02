<?php 

declare(strict_types=1);

namespace Source\User\App\Events;

use Source\Shared\Event\Event;
use Source\Shared\Event\EventInterface;
use Source\User\Domain\Entity\User;

class UserCreatedReadEvent implements EventInterface{

    private $user;
   public function __construct(User $user)
   {

       $this->user = $user;
   }

   public function getUser(){

       return $this->user;
   }

   
}