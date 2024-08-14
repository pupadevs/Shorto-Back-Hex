<?php 

declare(strict_types=1);

namespace Tests\Role\Domain\Entity;

use Source\Role\Domain\Entity\Role;
use Source\Role\Domain\ValueObjects\RoleID;
use Source\Role\Domain\ValueObjects\RoleName;
use Tests\TestCase;


class RoleTest extends TestCase
{
    public function testCanInstantiate()
    {
        $role = new Role(new RoleID(), new RoleName("admin"));
    }

    public function testCanGetID()
    {
        $role = Role::createRole(new RoleName("admin"));
        $this->assertInstanceOf(RoleID::class, $role->getRoleID());
    }

    public function testCanGetName()
    {
        $role = Role::createRole(new RoleName("admin"));
        $this->assertInstanceOf(RoleName::class, $role->getRoleName());
    }
}