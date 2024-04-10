<?php

declare(strict_types=1);

namespace Source\User\App\Querys;

class ShowUserQuery
{
    private string $userID;

    public function __construct(string $userId)
    {
        $this->userID = $userId;

    }

    public function getUserId()
    {
        return $this->userID;
    }
}
