<?php 

declare(strict_types=1);

namespace Source\Role\Domain\Entity;

use Illuminate\Database\Eloquent\Model;
use Source\Role\Domain\ValueObjects\RoleID;
use Source\Role\Domain\ValueObjects\RoleName;
use Source\User\Domain\ValueObjects\Name;

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