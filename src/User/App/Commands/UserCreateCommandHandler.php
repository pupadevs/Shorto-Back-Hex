<?php

declare(strict_types=1);

namespace Source\User\App\Commands;

use Illuminate\Support\Facades\Event;
use Source\User\App\Commands\UserCreateCommand;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Events\UserCreatedLogEvent;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\Name;
use Source\User\Domain\ValueObjects\Password;
//make unit tests
class UserCreateCommandHandler
{
    /**
     * @var UserRepositoryInterface $userRepositoryInterface
     * 
     */
    private UserRepositoryInterface $userRepositoryInterface;
/**
 * CommandHandler constructor.
 * @param UserRepositoryInterface $userRepositoryInterface
 */
    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    /**
     * Method to execute command
     * @param UserCreateCommand $command
     * @return void
     * @throws \Exception
     * 
     */
    public function execute(UserCreateCommand $command)
{
    // Crear un objeto User
    $user = User::createUser(
        new Name($command->getName()), 
        new Email($command->getEmail()), 
        new Password($command->getPassword())
    );

    try {
        $this->userRepositoryInterface->insertUser($user);
    } catch (\Exception $e) {
        throw new \Exception("Error al insertar usuario en la base de datos: " . $e->getMessage());
    }

    event(new UserCreatedReadEvent($user));
    event(new UserCreatedLogEvent($user->getId()->toString()));
}
}
