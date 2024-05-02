<?php 
declare(strict_types=1);

namespace Source\User\App\Querys;

use Source\User\Domain\Entity\User;
use Source\User\Domain\Interfaces\UserReadRepositoryInterface;
use Source\User\Domain\ValueObjects\UserID;

class FindUserByIdQueryHandler
{
    private UserReadRepositoryInterface $userReadRepository;

    public function __construct(UserReadRepositoryInterface $userReadRepository)
    {
        
       $this->userReadRepository = $userReadRepository;

    
    }


    public function handle(FindUserByIdQuery $query): User
    {
        

        return $this->userReadRepository->getUserByID(new UserID
        ($query->getUserId()));
    }
}