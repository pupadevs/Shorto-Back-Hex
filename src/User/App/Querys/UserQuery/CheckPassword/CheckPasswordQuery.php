<?php

declare(strict_types=1);

namespace Source\User\App\Querys\UserQuery\CheckPassword;
use Source\Shared\CQRS\Querys\Query;
use Source\User\Domain\ValueObjects\User\Password;

class CheckPasswordQuery implements Query
{
    /**
     * Email of user
     * @var Password
     */
    private Password $passwordDb;
    /**
     * Password of user
     * @var string
     */
    private string $passwordRequest;
    /**
     * Query constructor.
     * 
     * @param Password $passwordDb
     * @param string $passwordRequest
     */
    public function __construct(Password $passwordDb, string $passwordRequest)
    {
        $this->passwordDb = $passwordDb;
        $this->passwordRequest = $passwordRequest;
    }

    /**
     * Summary of getPasswordDb
     * @return Password
     */
    public function getPasswordDb():Password
    {
        return $this->passwordDb;
    }
    /**
     * Method to get password
     * @return string
     */
    public function getPasswordRequest()
    {
      
        return $this->passwordRequest;
    }
}
