<?php 

declare(strict_types=1);

namespace Source\User\App\Querys;


use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\Email;

class CheckEmailQueryHandler{

    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function handle(CheckEmailQuery $query){
        return $this->userRepositoryInterface->emailExists(new Email($query->getEmail()));
    }
}