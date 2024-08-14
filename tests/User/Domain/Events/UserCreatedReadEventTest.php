<?php 

namespace Source\User\App\Events;

use PHPUnit\Framework\TestCase;
use Source\User\Domain\Entity\User\User;
use Source\User\Domain\Events\User\UserCreatedEvent\UserCreatedReadEvent;
use Tests\Fixtures\Users;

class UserCreatedReadEventTest extends TestCase
{
    private User $user;
    public function setUp(): void
    {
        parent::setUp();
        $this->user = Users::aUser();
    }
    public function testConstructor()
    {
        $user = new UserCreatedReadEvent($this->user);
        $this->assertInstanceOf(UserCreatedReadEvent::class, $user);
        $this->assertEquals($this->user, $user->getUser());
    }
}