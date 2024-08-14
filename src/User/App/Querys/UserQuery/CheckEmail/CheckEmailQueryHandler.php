<?php 

declare(strict_types=1);

namespace Source\User\App\Querys\UserQuery\CheckEmail;

use Source\User\App\Querys\UserQuery\CheckEmail\CheckEmailQuery;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserReadRepositoryInterface;

class CheckEmailQueryHandler{

    /**
     * @var UserReadRepositoryInterface $userReadRepository
     */
    private UserReadRepositoryInterface $userReadRepository;
/**
 * QueryHandler constructor.
 * @param UserReadRepositoryInterface $userRepositoryInterface
 */
    public function __construct(UserReadRepositoryInterface $userRepositoryInterface)
    {
        $this->userReadRepository = $userRepositoryInterface;
    }
/**
 * Method to execute query
 * @param CheckEmailQuery $query
 * @return bool
 */
    public function handle(CheckEmailQuery $query): bool{
        $emailExists = $this->userReadRepository->emailExists($query->getEmail());
        return $emailExists;
    }
}