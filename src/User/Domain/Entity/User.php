<?php

declare(strict_types=1);

namespace Source\User\Domain\Entity;

use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\Name;
use Source\User\Domain\ValueObjects\Password;
use Source\User\Domain\ValueObjects\UserID;

class User
{
    /**
     * Name of user
     * @var Name $name
     */
    private Name $name;
/**
 * Email of user
 * @var Email $email
 */
    private Email $email;
    /**
     * Password of user
     * @var Password $password
     */
    private Password $password;
/**
 * User ID
 * @var UserID $id
 */
    private UserID $id;

  /**
   * User constructor.
   * @param UserID $id
   * @param Name $name
   * @param Email $email
   * @param Password $password
   */
    public function __construct(UserID $id, Name $name, Email $email, Password $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->id = $id;
    }
/**
 * Create a new user static method
 * @param Name $name
 * @param Email $email
 * @param Password $password
 * @return User
 */
    public static function createUser(Name $name, Email $email, Password $password): self
    {
        return new self(
            new UserID(),
            $name,
            $email,
            $password
        );
    }

    /**
     * Create user from array
     * @param array $result
     * @return User
     * @throws \Exception
     */
    public static function fromArray(array $result):self
    {
        return new self(
            new UserId($result['id']),
            new Name($result['name']),
            new Email($result['email']),
            new Password($result['password'])
        );
    }

    /**
     * Get user ID
     * @return UserID
     */
    public function getId()
    {
        return $this->id;
    }
/**
 * Get name
 * @return Name
 */
    public function getName()
    {
        return $this->name;
    }
/**
 * Get email
 * @return Email
 */
    public function getEmail()
    {
        return $this->email;
    }
/**
 * Get password
 * @return Password
 */
    public function getPassword()
    {
        return $this->password;
    }
/**
 * Change password
 * @param Password $password
 * @return void
 */
    public function changePassword(Password $password): void
    {
        $this->password = $password;
    }
/**
 * Change email
 * @param Email $email
 * @return void
 */
    public function changeEmail(Email $email):void
    {
        $this->email = $email;
    }
/**
 * Change name
 * @param Name $name
 * @return void
 */
    public function changeName(Name $name):void{

        $this->name = $name;
    }
}
