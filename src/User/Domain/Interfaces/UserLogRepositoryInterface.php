<?php 

declare(strict_types=1);

namespace Source\User\Domain\Interfaces;

use Source\User\Domain\Entity\UserLog;
use Source\User\Domain\Events\UserCreatedLogEvent;
use Source\User\Domain\Events\UserUpdatedLogEvent;

interface UserLogRepositoryInterface{

    /**
     * Method to insert user log
     * @param UserLog $event
     */
    public function insertLogUserCreation(UserLog $event);
/**
 * Method to insert user log
 * @param UserLog $event
 */
    public function insertLogUserUpdate(UserLog $event);


}