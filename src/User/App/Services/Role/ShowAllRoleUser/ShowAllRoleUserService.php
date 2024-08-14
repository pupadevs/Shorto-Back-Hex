<?php

declare(strict_types=1);

namespace Source\User\App\Services\Role\ShowAllRoleUser;

use Source\Shared\CQRS\Querys\QueryBus;
use Source\User\App\Querys\RoleQuery\ShowAllRoleUser\ShowAllRoleUserQuery;



class ShowAllRoleUserService
{
    public function __construct(private QueryBus $queryBus){}

    public function execute(): array
    {
        return $this->queryBus->handle(new ShowAllRoleUserQuery());
    }

}