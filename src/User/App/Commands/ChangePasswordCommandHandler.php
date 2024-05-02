<?php

declare(strict_types=1);

namespace Source\User\App\Commands;

use Source\User\Domain\Interfaces\UserReadRepositoryInterface;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\Password;

class ChangePasswordCommandHandler
{
    private UserRepositoryInterface $userRepositoryInterface;

    private UserReadRepositoryInterface $userReadRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface, UserReadRepositoryInterface $userReadRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
        $this->userReadRepositoryInterface = $userReadRepositoryInterface;
    }

    public function execute(ChangePasswordCommand $command)
    {

        $user = $this->userReadRepositoryInterface->getUserByEmail(new Email($command->getEmail()));

        $user->changePassword(new Password($command->getOldPassword()));
        $this->userRepositoryInterface->save($user);
     
    }
}
