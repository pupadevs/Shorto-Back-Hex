<?php 

declare(strict_types=1);

namespace Tests\User\Domain\ValueObjects;

use Tests\TestCase;
use Source\User\Domain\ValueObjects\UserID;

class UserIDTest extends TestCase
{
    public function testCanInstantiate()
    {
        $userID = new UserID();
        $this->assertInstanceOf(UserID::class, $userID);
    }

   public function testIsUuid(): void
    {
        $userID = new UserID();
        $this->assertMatchesRegularExpression('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $userID->ToString());
    }

  

}