<?php 
declare(strict_types=1);
namespace Source\User\App\Commands\UserCommands\UpdateUser;
use Source\User\Domain\Entity\User\User;
use Source\User\Domain\Events\User\UserUpdatedEvent\UserUpdatedLogEvent;
use Source\User\Domain\Events\User\UserUpdatedEvent\UserUpdatedReadEvent;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserRepositoryInterface;


class UpdateUserCommandHandler
{
    /**
     * @var UserRepositoryInterface
     * 
     */
    private UserRepositoryInterface $userRepository;
/**
 * CommandHandler constructor.
 * @param UserRepositoryInterface $userRepository
 */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Method to execute command
     * @param UpdateUserCommand $command
     * @return User
     * 
     */ 
    public function execute(UpdateUserCommand $command): User
    {
        // Crear un objeto User
        $user = $command->getUser();
        $user->changeName($command->getName());
        $user->changeEmail($command->getEmail());
        $this->userRepository->save($user);
        event(new UserUpdatedReadEvent($user));

        event(new UserUpdatedLogEvent($user->getId()->toString(), $command->getIp()));
        return $user;
    }

}