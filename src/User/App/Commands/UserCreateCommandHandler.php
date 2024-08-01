<?php

declare(strict_types=1);

namespace Source\User\App\Commands;

use App\Jobs\SendRegisterNotificationJob;
use App\Mail\RegisterNotification;
use Source\User\App\Commands\UserCreateCommand;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Events\UserCreatedLogEvent;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Mail;

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
    public function execute(UserCreateCommand $command)
{
    // Crear un objeto User
    $user = $command->getUser();
        $this->userRepositoryInterface->insertUser($user);
       
        event(new UserCreatedReadEvent($user));
    event(new UserCreatedLogEvent($user->getId()->toString(),$command->getIp()));
 SendRegisterNotificationJob::dispatch($user);
    //Mail::to($user->getEmail()->ToString())->send(new RegisterNotification($user));
    return $user;
}
}
