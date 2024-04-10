<?php

declare(strict_types=1);

namespace Source\User\App\Services;

use Source\User\Domain\Interfaces\EloquentMysqlInterfaceRepository;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\Email;

class FindUserByEmailService
{
    private UserRepositoryInterface $eloquentUserInterface;

    public function __construct(UserRepositoryInterface $eloquentUserInterface)
    {
        $this->eloquentUserInterface = $eloquentUserInterface;
    }

    public function execute(?string $email = null)
    {
        $user = $this->eloquentUserInterface->getUserByEmail(new Email($email));

        return $user;
    }
}
