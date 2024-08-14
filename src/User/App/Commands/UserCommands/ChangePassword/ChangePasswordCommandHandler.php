<?php

declare(strict_types=1);

namespace Source\User\App\Commands\UserCommands\ChangePassword;

use Source\User\Domain\Events\User\ChangePasswordEvent\ChangePasswordLogEvent;
use Source\User\Domain\Events\User\ChangePasswordEvent\ChangePasswordReadEvent;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserReadRepositoryInterface;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserRepositoryInterface;


class ChangePasswordCommandHandler
{
    /**
     * @var UserRepositoryInterface $userRepositoryInterface
     */
    private UserRepositoryInterface $userRepositoryInterface;

    /**
     * @var UserReadRepositoryInterface $userReadRepositoryInterface
     */
    private UserReadRepositoryInterface $userReadRepositoryInterface;

    /**
     * CommandHandler constructor.
     * @param UserRepositoryInterface $userRepositoryInterface
     * @param UserReadRepositoryInterface $userReadRepositoryInterface
     */
    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
      
    }

    /**
     * Method to execute command
     * @param ChangePasswordCommand $command
     * @return void
     */

     
    public function execute(ChangePasswordCommand $command): void
    {
        
       $user = $command->getUser();
       //$user->getPassword()->hashPassword($command->getNewPassword()->ToString());
        $user->changePassword($command->getNewPassword());
        $this->userRepositoryInterface->save($user);
       
       event(new ChangePasswordReadEvent($user));

        event(new ChangePasswordLogEvent($user->getId()->toString(),$command->getIp()));
    }
}
