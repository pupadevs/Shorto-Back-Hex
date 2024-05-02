<?php 

declare(strict_types=1);



namespace Source\User\Domain\Entity;

use Source\User\Domain\ValueObjects\UserID;
use Source\User\Domain\ValueObjects\UserLog\UserLogID;

class UserLog
{
    private  $id;

    private string $action;

    private string $ip;

    private UserID $userId;

private string $eventType;
private string $eventHandler;

public function __construct(UserLogID   $id, string $action, string $ip, UserID $userId, string $eventType, string $eventHandler)
{
  $this->id = $id;
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
        return $this->id;
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
