<?php 

declare(strict_types=1);

namespace Source\User\Domain\Events\User\ChangePasswordEvent;

use Source\User\Domain\Entity\User\User;

class ChangePasswordReadEvent
{
    private User $user;

    public function __construct(User $user){

        $this->user = $user;

    }

    public function getUser(){

        return $this->user;
    }
}