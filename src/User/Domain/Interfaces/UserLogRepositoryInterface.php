<?php 

declare(strict_types=1);

namespace Source\User\Domain\Interfaces;

use Source\User\Domain\Entity\UserLog;


interface UserLogRepositoryInterface{


    public function save(UserLog $event);


}