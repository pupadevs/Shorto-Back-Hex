<?php

declare(strict_types=1);

namespace Source\User\App\Commands\UserCommands\CreateUser;


use Source\User\App\Commands\UserCommands\CreateUser\UserCreateCommand;
use Source\User\Domain\Entity\User\User;
use Source\User\Domain\Events\User\UserCreatedEvent\UserCreatedReadEvent;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserRepositoryInterface;

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
     * @return User
     * 
     */
    public function execute(UserCreateCommand $command): User
{
    // Crear un objeto User
    $user = $command->getUser();
        $this->userRepositoryInterface->insertUser($user);
       
        event(new UserCreatedReadEvent($user));
    return $user;
}
}
