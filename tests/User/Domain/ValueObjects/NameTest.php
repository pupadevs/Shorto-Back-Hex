<?php 
namespace Tests\User\Domain\ValueObjects;

use Tests\TestCase;
use Source\User\Domain\ValueObjects\Name;
class NameTest extends TestCase
{
    public function testCanInstantiate()
    {
        $name = new Name("Peter");
        $this->assertInstanceOf(Name::class, $name);
    }

    public function testValidName(): void
    {
        $name = new Name("Peter");
        $this->assertEquals("Peter", $name->ToString());
    }

    public function testInvalidName(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Name("P");

    }

    public function testNullName(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Name(null);
    }

    public function testEmptyName(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Name("");
    }



}
