<?php 

declare(strict_types=1);

namespace Source\User\App\Querys\UserQuery\CheckEmail;
use Source\Shared\CQRS\Querys\Query;
use Source\User\Domain\ValueObjects\User\Email;

class CheckEmailQuery implements Query
{
    /**
     * Email of user
     * @var Email
     */
    private Email $email;
    /**
     * Query constructor.
     * @param string $email
     */
    public function __construct(Email $email)
    {
        $this->email = $email;
    }
    /**
     * Method to get email
     * @return Email
     */
  public function getEmail(): Email
    {

        return $this->email;
    }

}