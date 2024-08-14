<?php 

declare(strict_types=1);



namespace Source\User\Domain\Entity\UserLog;

use Source\User\Domain\ValueObjects\User\UserID;
use Source\User\Domain\ValueObjects\UserLog\UserLogID;

class UserLog
{
    /**
     * UserLog ID
     * @var UserLogID $userLogID
     */
    private UserLogID $userLogID;
/**
 * Action of user
 * @var string $action
 */
    private string $action;
    /**
     * IP of user
     * @var string $ip
     */
    private string $ip;
/**
 * User ID
 * @var UserID $userId
 */
    private UserID $userId;
/**
 * Event type
 * @var string $eventType
 */
private string $eventType;
/**
 * Event handler
 * @var string $eventHandler
 */
private string $eventHandler;
/**
 * UserLog constructor.
 * @param UserLogID $userLogID
 * @param string $action
 * @param string $ip
 * @param UserID $userId
 * @param string $eventType
 * @param string $eventHandler

 */
public function __construct(UserLogID $id, string $action, string $ip, UserID $userId, string $eventType, string $eventHandler)
{
  $this->userLogID = $id;
    $this->action = $action;
    $this->ip = $ip;
    $this->userId = $userId;
    $this->eventType = $eventType;
    $this->eventHandler = $eventHandler;
}

public static function createUserLog( string $action, string $ip, UserID $userId, string $eventType, string $eventHandler): self
{

    return new self(
        new UserLogID(),
        $action,
        $ip,
        $userId,
        $eventType,
        $eventHandler
    );
}

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->userLogID;
    }


    /**
     * Get the value of action
     */
    public function getAction(): string
    {
        return $this->action;
    }



    /**
     * Get the value of ip
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * Set the value of ip
     */

    public function getUserId()
    {
        return $this->userId;
    }


public function getEventType(): string{

    return $this->eventType;
}

public function getEventHandler(): string
{
return $this->eventHandler;
}


}
