<?php

declare(strict_types=1);

namespace Source\User\App\Querys\UserQuery\FindUser;
use Source\Shared\CQRS\Querys\Query;

class FindUserByIdQuery implements Query
{
    /**
     * User ID of user
     * @var string
     */
    private string $userID;
    /**
     * Query constructor.
     * @param string $userId
     */
    public function __construct(string $userId)
    {
        $this->userID = $userId;

    }
    /**
     * Method to get userID
     * @return string
     */
    public function getUserId()
    {
        return $this->userID;
    }   
}
