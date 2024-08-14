<?php 

declare(strict_types=1);

namespace Source\User\Domain\Interfaces\UserLogRepositoryContracts;

use Source\User\Domain\Entity\UserLog\UserLog;


interface UserLogRepositoryInterface{


    public function save(UserLog $event);


}