<?php
declare(strict_types=1);
namespace Source\User\Domain\Events\User\ChangePasswordEvent;

use Ramsey\Uuid\Uuid;


class ChangePasswordLogEvent 
{
   
    private $userId;

    private string $eventType;

    private string $action;

    private string $ip;

    private string $id;

    private string $eventHandler;


    public function __construct(string $userId, string $ip )
    {
       // parent::__construct($userId, $action, $ip, $eventType = $this->getEventType());
   
        
       $this->id = Uuid::uuid4()->toString();
        $this->userId = $userId;

        $this->action = 'Password changed';

       $this->ip = $ip;

        $this->eventType = self::class;




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