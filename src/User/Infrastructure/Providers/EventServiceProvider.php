<?php

namespace Source\User\Infrastructure\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\ServiceProvider;
use Source\User\Infrastructure\Events\UserCreatedEvent;
use Source\User\Infrastructure\Listerners\LogUserCreation;

class EventServiceProvider extends ServiceProvider
{
   /*  protected $listen = [
        
        UserCreatedEvent::class => [
            LogUserCreation::class
        ],
    ]; */
   /*  public function register()
    {
      $this->app->bind(
        LogUserCreation::class, UserCreatedEvent::class
      );
    }

    public function boot()
    {
        $this->app->bind(
            LogUserCreation::class, UserCreatedEvent::class
            
        );
    } */
}
