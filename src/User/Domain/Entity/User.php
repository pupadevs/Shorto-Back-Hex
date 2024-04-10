<?php

declare(strict_types=1);

namespace Source\User\Domain\Entity;

use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\Name;
use Source\User\Domain\ValueObjects\Password;
use Source\User\Domain\ValueObjects\UserID;

class User
{
    private Name $name;

    private Email $email;

    //   private $surname;
    //  private $userName;
    private Password $password;

    private UserID $id;

    protected function getDefaultGuardName(): string
    {
        return 'web';
    }

    public function __construct(UserID $id, Name $name, Email $email, Password $password)
    {

        $this->name = $name;
        $this->email = $email;
        /*  $this->surname = $surname;
         $this->userName = $userName; */
        $this->password = $password;
        $this->id = $id;

    }

    public static function createUser(Name $name, Email $email, Password $password): self
    {
        return new self(
            new UserID(),
            $name,
            $email,
            $password
        );
    }

    public static function fromArray(array $result)
    {

        return new self(
            new UserId($result['id']),
            new Name($result['name']),
            new Email($result['email']),
            new Password($result['password'])
        );
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;

    }

    public function getPassword()
    {
        return $this->password;
    }

    public function changePassword(Password $password): void
    {
        $this->password = $password;
    }

    public function changeEmail(Email $email)
    {
        $this->email = $email;
    }
}
