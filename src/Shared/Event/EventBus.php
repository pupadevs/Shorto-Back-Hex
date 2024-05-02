<?php

declare(strict_types=1);

namespace Source\Shared\Event;

use Illuminate\Contracts\Container\Container;
use Source\Shared\Event\Event;
use Source\Shared\Event\EventInterface;

class EventBus
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    //
    public function dispatch(EventInterface $event)
    {
        $handlerClass = $this->resolveHandlerClass($event);
        $handler = $this->container->make($handlerClass);

        return $handler->execute($event);
    }

    protected function resolveHandlerClass(EventInterface $event)
    {
  
        return get_class($event).'Listener';
    }
}
