<?php 

declare(strict_types=1);

namespace Source\User\Domain\Entity\Role;


use Source\User\Domain\ValueObjects\User\Name;
use Source\User\Domain\ValueObjects\Role\RoleID;

class Role
{
 
    

    public function __construct(  private RoleID $id,
    private Name $name  )
    {
       
   
    }

    public static function createRole(Name $name): self
    {
        return new self(new RoleID(), $name);
    }

    public static function fromArray(array $result):self
    {
        return new self(
            new RoleID($result['id']),
            new Name($result['name'])
        );
    }

    public function getRoleID(): RoleID
    {
        return $this->id;
    }

    public function getRoleName(): Name
    {
        return $this->name;
    }
}