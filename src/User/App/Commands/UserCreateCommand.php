<?php

declare(strict_types=1);

namespace Source\User\App\Commands;

use Source\Shared\CQRS\Command\Command;
use Source\User\Domain\Entity\User;

class UserCreateCommand implements Command
{
   
    /**
     * Ip of user
     * @var string
     */
    private $ip;

    private User $user;

    public function __construct(User $user, $ip)
    {

        $this->user = $user;
        $this->ip = $ip;
    }


    public function getIp()
    {
        return $this->ip;
    }

    public function getUser()
    {
        return $this->user;
    }

}