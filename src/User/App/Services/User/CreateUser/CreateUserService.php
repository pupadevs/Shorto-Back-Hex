<?php

declare(strict_types=1);

namespace Source\User\App\Services\User\CreateUser;

use App\Jobs\SendRegisterNotificationJob;
use App\Mail\RegisterNotification;
use Illuminate\Support\Facades\Mail;
use Source\Shared\CQRS\Command\CommandBus;
use Source\Shared\CQRS\Querys\QueryBus;
use Source\User\App\Commands\UserCommands\CreateUser\UserCreateCommand;
use Source\User\App\Querys\UserQuery\CheckEmail\CheckEmailQuery;
use Source\User\App\Services\Role\AssingRoleToUserServiceInterface;
use Source\User\Domain\Entity\User\User;
use Source\User\Domain\Events\User\UserCreatedEvent\UserCreatedLogEvent;
use Source\User\Domain\ValueObjects\User\Email;
use Source\User\Domain\ValueObjects\User\Name;
use Source\User\Domain\ValueObjects\User\Password;

class CreateUserService
{
    /**
     * @var CommandBus $command
     */
    private  CommandBus $command;
    /**
     * @var QueryBus $query
     */
    private QueryBus $query;

    private AssingRoleToUserServiceInterface $assingRoleToUserServiceInterface;

    /**
     * CreateUserService constructor.
     * @param CommandBus $commandBus
     * @param QueryBus $queryBus
     */
    public function __construct(CommandBus $commandBus,QueryBus $queryBus,AssingRoleToUserServiceInterface $assingRoleToUserServiceInterface)
    {
        $this->command = $commandBus;
        $this->query = $queryBus;
        $this->assingRoleToUserServiceInterface = $assingRoleToUserServiceInterface;
    }
    /**
     * Method to create user
     * @param string||null $name,
     * @param string||null $email,
     * @param string||null $password
     * @param string||null $ip
     * @throws \InvalidArgumentException
     * @return User
     */
    public function execute(?string $name, ?string $email, ?string $password, ?string $ip ):void
    {
       $user =  User::createUser(
            new Name($name),
            new Email($email),
        new Password($password),
        
    );
      
    
            $this->query->handle(new CheckEmailQuery(new Email($email)));
            
     $savedUser = $this->command->execute(new UserCreateCommand($user, $ip));

   $role=  $this->assingRoleToUserServiceInterface->assingRoleToUser($user->getId());
   $user->addRole($role); 
   

    event(new UserCreatedLogEvent($user->getId()->toString(),$ip));
    //Enviar email

 SendRegisterNotificationJob::dispatch($user);

    
    }
        
}
