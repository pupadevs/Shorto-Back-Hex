<?php 
declare(strict_types=1);
namespace Source\User\App\Commands;

use Source\Shared\CQRS\Command\Command;
use Source\User\Domain\Entity\User;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\Name;

class UpdateUserCommand implements Command
{
    /**
     * Summary of __construct
     * @param \Source\User\Domain\Entity\User $user
     * @param \Source\User\Domain\ValueObjects\Name $name
     * @param \Source\User\Domain\ValueObjects\Email $email
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
    * @return \Source\User\Domain\ValueObjects\Name
    */

    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * Summary of getEmail
     * @return \Source\User\Domain\ValueObjects\Email
     */
    public function getEmail(): Email
    {
        return $this->email;

    }

    /**
     * Summary of getUser
     * @return \Source\User\Domain\Entity\User
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