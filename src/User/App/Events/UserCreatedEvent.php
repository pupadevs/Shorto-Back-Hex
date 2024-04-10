<?php
namespace Source\User\App\Events;

use Source\Shared\Event\Event;
use Source\User\Domain\ValueObjects\UserID;

class UserCreatedEvent  
{
   
    private $userId;

    private string $eventType;

    private string $action;

    private string $ip;


    public function __construct(string $userId )
    {
       // parent::__construct($userId, $action, $ip, $eventType = $this->getEventType());
   
    

        $this->userId = $userId;

        $this->action = 'User created';

        $this->ip = $_SERVER['REMOTE_ADDR'];


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


    public function getIp(){
        return $this->ip;
    }


    


  
}
