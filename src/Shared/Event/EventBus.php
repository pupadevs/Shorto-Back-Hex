<?php

declare(strict_types=1);

namespace Source\Shared\CQRS\Event;

use Illuminate\Contracts\Container\Container;
use Source\Shared\Event\Event;


class EventBus
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    //
    public function dispatch( $event)
    {
        $handlerClass = $this->resolveHandlerClass($event);
        $handler = $this->container->make($handlerClass);

        return $handler->execute($event);
    }

    protected function resolveHandlerClass( $event)
    {
  
        return get_class($event).'Listerner';
    }
}
