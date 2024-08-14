<?php 

declare(strict_types=1);

namespace Tests\User\Domain\ValueObjects;

use Source\User\Domain\ValueObjects\User\Email;
use Tests\TestCase;

class EmailTest extends TestCase
{
    public function testCanInstantiate()
    {
        $email = new Email("a@b.com");
        $this->assertInstanceOf(Email::class, $email);
    }

    public function testValidEmail(): void
    {
        $email = new Email("a@b.com");
        $this->assertEquals("a@b.com", $email->ToString());
    }   

    public function testInvalidEmail(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Email("a");
    }   

    public function testNullEmail(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Email(null);
    }

    public function testEmptyEmail(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Email("");
    }   
}