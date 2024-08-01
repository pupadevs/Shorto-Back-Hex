<?php 

declare(strict_types=1);

namespace Source\User\App\Querys;

use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\App\Querys\FindUserByIdQuery;
use Source\User\App\Querys\FindUserByIdQueryHandler;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Interfaces\UserReadRepositoryInterface;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Infrastructure\Repository\Read\UserReadRepository;
use Source\User\Infrastructure\Repository\UserRepositoryEloquentMySql;
use Tests\Fixtures\Users;
use Tests\TestCase;

class FindUserByIdQueryTest extends TestCase
{    private UserReadRepositoryInterface $userReadRepository;
    private User $user;

    private FindUserByIdQueryHandler $queryHandler;
    public function setUp(): void
    {
        parent::setUp();
        $this->userReadRepository = new UserReadRepository();
        $this->queryHandler = new FindUserByIdQueryHandler($this->userReadRepository);
        $this->user = Users::aUser();

    }


    public function testCanInstantiate()

    {
        self::assertInstanceOf(FindUserByIdQueryHandler::class, $this->queryHandler);
    }

    public function test_canFindUserById(){

        $this->userReadRepository->insertUserReadDB(new UserCreatedReadEvent($this->user));

      $handle=  $this->queryHandler->handle(new FindUserByIdQuery($this->user->getId()->toString()));


        self::assertEquals($this->user->getId()->toString(), $handle->getId()->toString());
    }
}
