<?php 

declare(strict_types=1);

namespace Source\User\Domain\Interfaces\UserLogRepositoryContracts;

use Source\User\Domain\Entity\UserLog\UserLog;
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
 * Method to get user log by action
 * @param string $action
 * @return array
 */
    public function getLogByAction(string $action);

    /**
 * Method to insert user log
 * @param UserLog $event
*/
    public function save(UserLog $event);



}