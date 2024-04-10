<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Source\User\App\Events\UserCreatedEvent;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Infrastructure\Listerners\UserCreatedEventListerner;
use Source\User\Infrastructure\Listerners\UserCreatedReadEventListener;
use Source\User\Infrastructure\Listerners\UserLogReadEventListerner;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserCreatedEvent::class => [
            UserCreatedEventListerner::class,
          //  UserLogReadEventListerner::class
        ],

        UserCreatedReadEvent::class => [
            UserCreatedReadEventListener::class
        ]
        
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
