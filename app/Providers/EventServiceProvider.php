<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Events\Role\AttachUserReadEvent\AttachUserReadEvent;
use Source\User\Domain\Events\Role\RoleCreateEvent\RoleCreatedReadEvent;
use Source\User\Domain\Events\User\ChangePasswordEvent\ChangePasswordLogEvent;
use Source\User\Domain\Events\User\ChangePasswordEvent\ChangePasswordReadEvent;
use Source\User\Domain\Events\User\DeleteUserEvent\DeleteUserLogEvent;
use Source\User\Domain\Events\User\DeleteUserEvent\DeleteUserReadEvent;
use Source\User\Domain\Events\User\UserCreatedEvent\UserCreatedLogEvent;
use Source\User\Domain\Events\User\UserUpdatedEvent\UserUpdatedLogEvent;
use Source\User\Domain\Events\User\UserUpdatedEvent\UserUpdatedReadEvent;
use Source\User\Infrastructure\Listerners\ChangePasswordLogEventListener;
use Source\User\Infrastructure\Listerners\ChangePasswordReadEventListener;
use Source\User\Infrastructure\Listerners\DeleteUserLogEventListerner;
use Source\User\Infrastructure\Listerners\DeleteUserReadEventListener;
use Source\User\Infrastructure\Listerners\Role\AttachUserReadDBEvent\AttachUserReadEventListener;
use Source\User\Infrastructure\Listerners\Role\RoleReadDBEvent\RoleCreatedReadEventListener;
use Source\User\Infrastructure\Listerners\UserCreatedLogEventListener;
use Source\User\Infrastructure\Listerners\UserDuplicationReadEventListener;
use Source\User\Infrastructure\Listerners\UserUpdateLogEventListerner;
use Source\User\Infrastructure\Listerners\UserUpdateReadEventListerner;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [

        //UserCRUD in read database
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
       
        ChangePasswordReadEvent::class => [
            ChangePasswordReadEventListener::class
        ],

        UserCreatedReadEvent::class => [
            UserDuplicationReadEventListener::class
        ],
     
        UserUpdatedReadEvent::class => [
            UserUpdateReadEventListerner::class
        ],
        DeleteUserReadEvent::class => [
            DeleteUserReadEventListener::class
        ],

     
        //UserLogs
        UserCreatedLogEvent::class => [
            UserCreatedLogEventListener::class,
           
        ],
        UserUpdatedLogEvent::class => [
            UserUpdateLogEventListerner::class
        ],
        ChangePasswordLogEvent::class => [
            ChangePasswordLogEventListener::class
        ],
        DeleteUserLogEvent::class => [
            DeleteUserLogEventListerner::class
        ],

        //Role

        //TODO: Roles Event
            RoleCreatedReadEvent::class => [
                RoleCreatedReadEventListener::class
            ],
            AttachUserReadEvent::class => [
                AttachUserReadEventListener::class
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
