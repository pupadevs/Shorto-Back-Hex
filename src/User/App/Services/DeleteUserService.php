<?php 

declare(strict_types=1);

namespace Source\User\App\Services;

use Source\Shared\CQRS\Command\CommandBus;
use Source\Shared\CQRS\Querys\QueryBus;
use Source\User\App\Commands\DeleteUserCommand;
use Source\User\App\Querys\FindUserByIdQuery;

class DeleteUserService{

    /**
     * @var CommandBus $commandBus
     */
    private CommandBus $commandBus;
    /**
     * @var QueryBus $queryBus
     */
    private QueryBus $queryBus;
    /**
     * CommandHandler constructor.
     * @param CommandBus $commandBus
     * @param QueryBus $queryBus
     */

    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }
/**
 * Method to delete user
 * @param string $uuid
 * @return void
 */
    public function execute(string $uuid, ?string $ip): void{

        $user = $this->queryBus->handle(new FindUserByIdQuery($uuid));

        $this->commandBus->execute(new DeleteUserCommand($user));
    }
}