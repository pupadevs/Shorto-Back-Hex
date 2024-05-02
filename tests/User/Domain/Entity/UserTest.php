<?php

declare(strict_types=1);

namespace Test\User\Domain\Entity;

use PHPUnit\Framework\TestCase;
use Source\User\Domain\Entity\User;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\Name;
use Source\User\Domain\ValueObjects\Password;
use Tests\Fixtures\Users;

use function PHPUnit\Framework\assertIsString;

class UserTest extends TestCase
{
    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = Users::aUser();
    }

    public function testCanInstantiate(): void
    {
        self::assertInstanceOf(User::class, $this->user);
    }

    public function testCanHaveAUniqueIdentifier(): void
    {
        self::assertIsString(
            $this->user->getId()->toString()
        );
    }

    public function testCanHaveAnEmail(): void
    {
        self::assertIsString($this->user->getEmail()->toString());
    }

    public function testCanHaveAPassword(): void
    {
        self::assertIsString($this->user->getPassword()->toString());
    }

    public function testCanChangeAPassword(): void
    {
        $password = new Password('changed-password');
        $this->user->changePassword($password);
        self::assertEquals($password, $this->user->getPassword());
    }

    public function testVerifyName(): void
    {
        self::assertIsString($this->user->getName()->toString());
    }

    public function testLengthOfName(): void
    {
        self::assertGreaterThan(3, $this->user->getName()->toString());
        self::assertLessThan(255, strlen($this->user->getName()->toString()));
    }

    public function testCanChangeName(): void{


        $newName = new Name('John Doe');

        $this->user->changeName($newName);

        self::assertEquals($newName, $this->user->getName());
        self::assertIsString($this->user->getName()->toString());
        
    }

    public function testCanChangeEmail(): void{

        $newEmail = new Email('john@doe.com');

        $this->user->changeEmail($newEmail);

        self::assertEquals($newEmail, $this->user->getEmail());
    }
}
