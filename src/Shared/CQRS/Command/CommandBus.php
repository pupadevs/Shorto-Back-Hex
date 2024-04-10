<?php

declare(strict_types=1);

namespace Source\Shared\CQRS\Command;

use Illuminate\Contracts\Container\Container;

class CommandBus
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    //
    public function execute(Command $command)
    {
        $handlerClass = $this->resolveListenerClass($command);
        $handler = $this->container->make($handlerClass);

        return $handler->execute($command);
    }

    protected function resolveListenerClass(Command $command)
    {
  
        return get_class($command).'Handler';
    }
}
