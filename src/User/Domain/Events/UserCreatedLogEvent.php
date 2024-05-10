<?php
declare(strict_types=1);
namespace Source\User\Domain\Events;

use Ramsey\Uuid\Uuid;


class UserCreatedLogEvent 
{
   
    private $userId;

    private string $eventType;

    private string $action;

    private string $ip;

    private string $id;

    private string $eventHandler;


    public function __construct(string $userId )
    {
       // parent::__construct($userId, $action, $ip, $eventType = $this->getEventType());
   
        
     //  $this->id = Uuid::uuid4()->toString();
        $this->userId = $userId;

        $this->action = 'User created';

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

    public function setIp(string $ip){
        
        $this->ip = $ip;
    }

/* public function getId(){
    return $this->id;
} */
    public function getIp(){
        return $this->ip;
    }


    


  
}
