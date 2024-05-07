<?php

declare(strict_types=1);

namespace Source\User\App\Commands;

use Source\Shared\CQRS\Command\Command;

class UserCreateCommand implements Command
{
    /**
     * Name of user
     * @var string
     */
    private $name;
/**
 * Email of user
 * @var string
 */
    private $email;
/**
 * Password of user
 * @var string
 */
    private $password;
/**
 * Command constructor.
 * @param string $name, string $email, string $password
 */
    public function __construct($name, $email, $password)
    {

        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
/**
 * `Method to get name`
 * @return string
 */
    public function getName()
    {
        return $this->name;

    }
/**
 * Method to get email
 * @return string
 */
    public function getEmail()
    {
        return $this->email;
    }
/**
 * Method to get password
 * @return string
 * 
 */
    public function getPassword()
    {
        return password_hash($this->password, PASSWORD_DEFAULT);
    }
}
