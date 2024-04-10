<?php

declare(strict_types=1);

namespace Source\Shared\CQRS\Querys;

use Illuminate\Contracts\Container\Container;

class QueryBus
{
    protected Container $container;

    public function __construct(Container $container)
    {

        $this->container = $container;

    }

    public function handle(Query $query)
    {

        $handlerClass = $this->resolveHandlerClass($query);
        $handler = $this->container->make($handlerClass);

        return $handler->handle($query);
    }

    protected function resolveHandlerClass(Query $query)
    {
        return get_class($query).'Handler';
    }
}
