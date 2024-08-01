<?php 

declare(strict_types=1);	
namespace Source\User\Domain\ValueObjects;

use Tests\TestCase;

class PasswordTest extends TestCase
{
    public function testCanInstantiate()
    {
        $password = new Password("12345678");
        $this->assertInstanceOf(Password::class, $password);
    }

    public function testValidPassword(): void
    {
        $password = new Password("12345678");
        $this->assertTrue(password_verify("12345678", $password->ToString()));
    }

    public function testInvalidPassword(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Password("P");
    }   

    public function testNullPassword(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Password(null);
    }

    public function testEmptyPassword(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Password("");
    }

    public function testIsPasswordHash(): void
    {
        $password = new Password("12345678");
        $this->assertMatchesRegularExpression('/^\$2[ayb]\$[0-9]{2}\$.{53}$/', $password->ToString());
     
    }

}