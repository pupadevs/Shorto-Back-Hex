<?php

declare(strict_types=1);

namespace Source\Shared\CQRS\Command;

use Illuminate\Contracts\Container\Container;

class CommandBus
{
    /**
     * Container instance
     * @param Container $container
     */
    protected Container $container;

    /**
     *  CommandBus constructor.
     * CommandBus constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Method to execute command
     * @param Command $command
     * @return mixed
     */

    public function execute(Command $command)
    {
        $handlerClass = $this->resolveHandlerClass($command);
        $handler = $this->container->make($handlerClass);

        return $handler->execute($command);
    }

    /**
     * Method to resolve handler class based on command
     * @param Command $command
     * 
     * @return string
     */

    protected function resolveHandlerClass(Command $command)
    {
  
        return get_class($command).'Handler';
    }
}
