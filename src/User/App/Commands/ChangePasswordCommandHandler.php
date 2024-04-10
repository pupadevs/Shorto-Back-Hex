<?php

declare(strict_types=1);

namespace Source\User\App\Commands;

use Source\User\Domain\Interfaces\EloquentMysqlInterfaceRepository;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\Password;
use Source\User\Infrastructure\Events\UserCreatedEvent;

class ChangePasswordCommandHandler
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function execute(ChangePasswordCommand $command)
    {

        $user = $this->userRepositoryInterface->getUserByEmail(new Email($command->getEmail()));

        $user->changePassword(new Password($command->getNewPassword()));
        $this->userRepositoryInterface->save($user);
      //  event(new \Source\User\Domain\Events\UserCreatedEvent($user->getId()->toString()));
      

       // return false;

        // $this->eloquentMysqlInterfaceRepository->save($command);
    }
}
