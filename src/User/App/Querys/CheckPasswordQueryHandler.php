<?php

declare(strict_types=1);

namespace Source\User\App\Querys;

use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\Email;

class CheckPasswordQueryHandler
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function handle(CheckPasswordQuery $query)
    {

        try {
            $user = $this->userRepositoryInterface->getUserByEmail(new Email($query->getEmail()));

            return password_verify($query->getPassword(), $user->getPassword()->toString());
        } catch (\Exception $e) {
            throw new \Exception('Invalid password',404);
        }
    }
}
