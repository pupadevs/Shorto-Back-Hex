<?php

declare(strict_types=1);

namespace Source\User\App\Querys;

use Source\Shared\CQRS\Querys\Query;
use Source\User\Domain\ValueObjects\Password;

class CheckPasswordQuery implements Query
{
    /**
     * Email of user
     * @var string
     */
    private string $passwordDb;
    /**
     * Password of user
     * @var Password
     */
    private Password $passwordRequest;
    /**
     * Query constructor.
     * @param string $email, string $password
     */
    public function __construct(string $passwordDb, Password $passwordRequest)
    {
        $this->passwordDb = $passwordDb;
        $this->passwordRequest = $passwordRequest;
    }
/**
 * Method to get email
 * @return string
 */
    public function getPasswordDb()
    {
     
        return $this->passwordDb;
    }
    /**
     * Method to get password
     * @return string
     */
    public function getPasswordRequest()
    {
      
        return $this->passwordRequest->toString();
    }
}
