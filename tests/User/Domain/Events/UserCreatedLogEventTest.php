<?php

namespace Tests\User\Domain\Events;

use Tests\TestCase;
use Ramsey\Uuid\Uuid;
use Source\User\Domain\Events\User\UserCreatedEvent\UserCreatedLogEvent;

class UserCreatedLogEventTest extends TestCase
{
    public function testConstructor()
    {
        $userId = Uuid::uuid4()->toString();
        $event = new UserCreatedLogEvent($userId,"192.168.1.1");

        $this->assertInstanceOf(UserCreatedLogEvent::class, $event);
        $this->assertEquals($userId, $event->getUserId());
        $this->assertEquals('Source\User\Domain\Events\User\UserCreatedEvent\UserCreatedLogEvent', $event->getEventType());
        $this->assertEquals('User created', $event->getAction());
    }

}
