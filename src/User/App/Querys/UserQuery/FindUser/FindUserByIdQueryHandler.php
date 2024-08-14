<?php 
declare(strict_types=1);

namespace Source\User\App\Querys\UserQuery\FindUser;

use Source\User\App\Querys\UserQuery\FindUser\FindUserByIdQuery;
use Source\User\Domain\Entity\User\User;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserReadRepositoryInterface;
use Source\User\Domain\ValueObjects\User\UserID;
class FindUserByIdQueryHandler
{
    /**
     * @var UserReadRepositoryInterface
     */
    private UserReadRepositoryInterface $userReadRepository;

     /**
     * FindUserByIdQueryHandler constructor.
     * @param UserReadRepositoryInterface $userReadRepository
     */

    public function __construct(UserReadRepositoryInterface $userReadRepository)
    {
        
       $this->userReadRepository = $userReadRepository;
    
    }
 /**
     * Handle finding a user by ID.
     *
     * @param FindUserByIdQuery $query
     * @return User
     */

    public function handle(FindUserByIdQuery $query): User
    {
        $user = $this->userReadRepository->getUserByID(new UserID
        ($query->getUserId()));
       

        return $user;
    }
}