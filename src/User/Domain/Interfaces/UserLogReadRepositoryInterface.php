<?php 

declare(strict_types=1);

namespace Source\User\Domain\Interfaces;

use Source\User\Domain\Entity\UserLog;
use Source\User\Domain\Events\UserCreatedLogEvent;
use Source\User\Domain\Events\UserUpdatedLogEvent;

interface UserLogReadRepositoryInterface
{

    /**
     * Method to get all user logs
     * @return array
     */

    public function getUserLogs():array;
/**
 * Method to insert user log
 * @param UserLog $event
 */
    public function insertUserLog(UserLog $event);
    /**
     * Method to log user created
     * @param UserCreatedLogEvent $event
     */
    public function logUserUpdate(UserUpdatedLogEvent $event);
/**
 * Method to get user log by action
 * @param string $action
 * @return array
 */
    public function getLogByAction(string $action);


}