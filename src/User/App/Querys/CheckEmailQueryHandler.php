<?php 

declare(strict_types=1);

namespace Source\User\App\Querys;


use Source\User\Domain\Interfaces\UserReadRepositoryInterface;
use Source\User\Domain\ValueObjects\Email;

class CheckEmailQueryHandler{

    private UserReadRepositoryInterface $userReadRepository;

    public function __construct(UserReadRepositoryInterface $userRepositoryInterface)
    {
        $this->userReadRepository = $userRepositoryInterface;
    }

    public function handle(CheckEmailQuery $query): bool{
        return $this->userReadRepository->emailExists(new Email($query->getEmail()));
    }
}