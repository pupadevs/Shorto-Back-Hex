<?php 

declare(strict_types=1);

namespace Source\User\App\Events;

use Illuminate\Support\Facades\Event;
use Source\User\Domain\Entity\User\User;

class UserCreatedReadEvent extends Event {
/**
 * @param User $user
 */
    private User $user;
    /**
     * Command constructor.
     * @param User $user
     */
   public function __construct(User $user)
   {

       $this->user = $user;
   }
/**
 * Method to get user
 * @return User
 */
   public function getUser(){

       return $this->user;
   }

   
}