<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository\Memory;

use Source\User\Domain\Entity\UserLog;
use Source\User\Domain\Events\UserCreatedLogEvent;
use Source\User\Domain\Events\UserUpdatedLogEvent;
use Source\User\Domain\Interfaces\UserLogRepositoryInterface;
use Source\User\Infrastructure\Listerners\UserCreatedLogEventListener;
use Source\User\Infrastructure\Listerners\UserUpdateLogEventListerner;

class UserLogRepositoryInMemory implements UserLogRepositoryInterface
{
    private array $logs = [];

    public function insertLogUserCreation(UserLog $event): void
    {
        $this->logs[] = [
            'user_id' => $event->getUserID(),
            'action' => $event->getAction(),
            'event_type' => UserCreatedLogEvent::class,
            'id' => (string) $event->getId(),
            'created_at' => now(),
            'ip' => $event->getIp(),
            'event_handler' => UserCreatedLogEventListener::class,
        ];
    }

    public function insertLogUserUpdate(UserLog $event): void
    {
        $this->logs[] = [
            'user_id' => $event->getUserID(),
            'action' => $event->getAction(),
            'event_type' => UserUpdatedLogEvent::class,
            'id' => (string) $event->getId(),
            'created_at' => now(),
            'ip' => $event->getIp(),
            'event_handler' => UserUpdateLogEventListerner::class,
        ];
    }

    // Opcional: Agregar un método para obtener todos los logs guardados en memoria
    public function getLogs(): array
    {
        return $this->logs;
    }
}
