<?php 
declare(strict_types=1);
namespace Source\User\App\Commands\UserCommands\UpdateUser;

use Source\Shared\CQRS\Command\Command;
use Source\User\Domain\Entity\User\User;
use Source\User\Domain\ValueObjects\User\Email;
use Source\User\Domain\ValueObjects\User\Name;

class UpdateUserCommand implements Command
{
    /**
     * Summary of __construct
     * @param User $user
     * @param \Source\User\Domain\ValueObjects\User\Name $name
     * @param Email $email
     */
    public function __construct(
        private User $user,
        private Name $name,
        private Email $email,
        private string $ip
    ){

    }
   /**
    * Summary of getName
    * @return Name
    */

    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * Summary of getEmail
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;

    }

    /**
     * Summary of getUser
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    public function getIp(): string
    {
        return $this->ip;
    }
}