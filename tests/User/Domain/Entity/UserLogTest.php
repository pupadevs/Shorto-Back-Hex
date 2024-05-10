<?php

declare(strict_types=1);

namespace Source\User\Domain\Entity;

use PHPUnit\Framework\TestCase;
use Source\User\Domain\Entity\UserLog as EntityUserLog;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\Name;
use Source\User\Domain\ValueObjects\Password;
use Tests\Fixtures\UserLog;

use function PHPUnit\Framework\assertIsString;

class UserLogTest extends TestCase
{
    private EntityUserLog $userLog;

    public function setUp(): void
    {
        parent::setUp();
        $this->userLog = UserLog::aUserCreatedLog();
    }

    public function testCanInstantiate(): void
    {
        self::assertInstanceOf(EntityUserLog::class, $this->userLog);
    }

    public function testCanHaveAUniqueIdentifier(): void
    {
        self::assertIsString(
            $this->userLog->getId()->toString()
        );
    }

     public function testCanHaveAnAction(): void
    {
        self::assertIsString($this->userLog->getAction());
    } 

    public function testCanHaveAIp(): void
    {
        self::assertIsString($this->userLog->getIp());
    }

    public function testCanHaveAUserId(): void
    {
        self::assertIsString($this->userLog->getUserId()->toString());
    }

    public function testCanHaveAnEventType(): void
    {
        self::assertIsString($this->userLog->getEventType());
    }
 
    public function testCanHaveAnEventHandler(): void
    {
        self::assertIsString($this->userLog->getEventHandler());
    }

   
}
