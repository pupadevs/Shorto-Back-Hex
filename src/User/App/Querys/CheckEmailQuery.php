<?php 

declare(strict_types=1);

namespace Source\User\App\Querys;

use Source\Shared\CQRS\Querys\Query;

class CheckEmailQuery implements Query
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

}