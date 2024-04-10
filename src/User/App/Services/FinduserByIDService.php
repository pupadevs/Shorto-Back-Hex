<?php

declare(strict_types=1);

namespace Source\User\App\Services;

use Source\User\Domain\Interfaces\EloquentMysqlInterfaceRepository;
use Source\User\Domain\ValueObjects\UserID;

class FinduserByIDService
{
    private EloquentMysqlInterfaceRepository $eloquentMysqlInterfaceRepository;

    public function __construct(EloquentMysqlInterfaceRepository $eloquentMysqlInterfaceRepository)
    {
        $this->eloquentMysqlInterfaceRepository = $eloquentMysqlInterfaceRepository;
    }

    public function execute(string $userID)
    {

        $this->eloquentMysqlInterfaceRepository->getUserById(new UserID($userID));
    }
}
