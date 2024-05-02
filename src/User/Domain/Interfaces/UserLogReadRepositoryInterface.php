<?php 

declare(strict_types=1);

namespace Source\User\Domain\Interfaces;

use Source\User\Domain\Entity\UserLog;
use Source\User\Domain\Events\UserCreatedLogEvent;
use Source\User\Domain\Events\UserUpdatedLogEvent;

interface UserLogReadRepositoryInterface
{

    public function getUserLogs();

    public function insertUserLog(UserLog $event);
    
    public function logUserUpdate(UserUpdatedLogEvent $event);

    public function getLogByAction(string $action);


}