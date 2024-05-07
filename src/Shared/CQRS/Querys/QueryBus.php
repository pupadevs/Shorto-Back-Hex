<?php

declare(strict_types=1);

namespace Source\Shared\CQRS\Querys;

use Illuminate\Contracts\Container\Container;

class QueryBus
{
    /**
     * Container instance
     * @param Container $container
     */
    protected Container $container;

    /**
     * QueryBus constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Method to execute query
     * @param Query $query
     * @return mixed
     */
    public function handle(Query $query): mixed
    {

        $handlerClass = $this->resolveHandlerClass($query);
        $handler = $this->container->make($handlerClass);

        return $handler->handle($query);
    }

    /**
     * Method to resolve handler class based on query
     * @param Query $query
     * @return string
     */
    protected function resolveHandlerClass(Query $query)
    {
        return get_class($query).'Handler';
    }
}
