<?php 

declare(strict_types=1);

namespace Source\User\Domain\Events;

use Source\User\Domain\Entity\User;

class DeleteUserLogEvent{
    private $userId;

    private string $eventType;

    private string $action;

    private string $ip;

    private string $id;

    private string $eventHandler;

    public function __construct(string $userId ){
        $this->action = 'User Deleted';
        $this->userId = $userId;
        $this->ip = "127.0.0.1";

        $this->eventType = self::class;
    }

    
    public function getUserId(){
        return $this->userId;
    }

    public function getEventType(){
        return $this->eventType;
    }

    public function getEventHandler(){

        return $this->eventHandler;
    }

    public function getAction(){
        return $this->action;

    }

    public function getIp(){
        return $this->ip;
    }
}