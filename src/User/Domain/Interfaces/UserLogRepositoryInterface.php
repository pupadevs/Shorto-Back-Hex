<?php 

declare(strict_types=1);

namespace Source\User\Domain\Interfaces;

use Source\User\Domain\Entity\UserLog;
use Source\User\Domain\Events\UserCreatedLogEvent;
use Source\User\Domain\Events\UserUpdatedLogEvent;

interface UserLogRepositoryInterface{

    public function insertLogUserCreation(UserLog $event);

    public function insertLogUserUpdate(UserLog $event);


}