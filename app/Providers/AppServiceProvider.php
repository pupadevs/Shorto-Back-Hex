<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Source\User\App\Commands\UserCommands\ChangePassword\ChangePasswordCommand;
use Source\User\App\Commands\UserCommands\ChangePassword\ChangePasswordCommandHandler;
use Source\User\App\Commands\UserCommands\CreateUser\UserCreateCommand;
use Source\User\App\Commands\UserCommands\CreateUser\UserCreateCommandHandler;
use Source\User\Domain\Interfaces\UserLogRepositoryContracts\UserLogReadRepositoryInterface;
use Source\User\Domain\Interfaces\UserLogRepositoryContracts\UserLogRepositoryInterface;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserReadRepositoryInterface;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserRepositoryInterface;
use Source\User\Infrastructure\Repository\User\Read\UserReadRepository;
use Source\User\Infrastructure\Repository\User\Write\UserRepositoryDbFacades;
use Source\User\Infrastructure\Repository\UserLog\Read\UserLogReadRepository;
use Source\User\Infrastructure\Repository\UserLog\Write\UserLogRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
              // Vinculaciones de User
              $this->app->bind(UserRepositoryInterface::class, UserRepositoryDbFacades::class);
              $this->app->bind(UserReadRepositoryInterface::class, UserReadRepository::class);
              $this->app->bind(UserLogRepositoryInterface::class, UserLogRepository::class);
              $this->app->bind(UserLogReadRepositoryInterface::class, UserLogReadRepository::class);
      
      
              // Vinculaciones de Commands
              $this->app->bind(ChangePasswordCommand::class, ChangePasswordCommandHandler::class);
              $this->app->bind(UserCreateCommand::class, UserCreateCommandHandler::class);
      
  
      
              // Vinculaciones de Laravel
              $this->app->bind(\Illuminate\Contracts\Queue\Factory::class, \Illuminate\Queue\QueueManager::class);
      

   //  $this->app->bind(UserCreatedEvent::class, LogUserCreation::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
