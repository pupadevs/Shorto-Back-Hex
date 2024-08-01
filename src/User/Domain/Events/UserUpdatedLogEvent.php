<?php
declare(strict_types=1);
namespace Source\User\Domain\Events;

use Ramsey\Uuid\Uuid;


class UserUpdatedLogEvent
{
   
    private $userId;

    private string $eventType;

    private string $action;

    private string $ip;

    private string $id;

    private string $eventHandler;


    public function __construct(string $userId ,string $ip)
    {
        
        $this->id = Uuid::uuid4()->toString();
        $this->userId = $userId;

        $this->action = 'User Updated';
        $this->eventType = self::class;

        $this->ip = $ip;

    }

    public function getUserId(){
        return $this->userId;
    }

    public function getEventType(){
        return $this->eventType;
    }

    public function getAction(){
        return $this->action;

    }
public function getId(){
    return $this->id;
}
    public function getIp(){
        return $this->ip;
    }  
}
