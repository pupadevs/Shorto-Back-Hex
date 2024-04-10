<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Source\User\App\Commands\ChangePasswordCommand;
use Source\User\App\Commands\ChangePasswordCommandHandler;
use Source\User\App\Commands\UserCreateCommand;
use Source\User\App\Commands\UserCreateCommandHandler;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Infrastructure\Repository\UserRepositoryEloquentMySql;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepositoryEloquentMySql::class);
        $this->app->bind(ChangePasswordCommand::class, ChangePasswordCommandHandler::class);
          $this->app->bind(UserCreateCommand::class, UserCreateCommandHandler::class);

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
