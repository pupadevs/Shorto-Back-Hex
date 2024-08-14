<?php 

declare(strict_types=1);

namespace Tests\User\App\Querys;


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\App\Querys\UserQuery\CheckPassword\CheckPasswordQuery;
use Source\User\App\Querys\UserQuery\CheckPassword\CheckPasswordQueryHandler;
use Source\User\Domain\Entity\User\User;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserReadRepositoryInterface;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\User\Password;
use Source\User\Infrastructure\Repository\User\Read\UserReadRepository;
use Source\User\Infrastructure\Repository\User\Write\UserRepositoryDbFacades;
use Tests\Fixtures\Users;
use Tests\TestCase;

class CheckPasswordQueryTest extends TestCase
{
    use DatabaseTransactions;

    private UserReadRepositoryInterface $userReadRepository;
    private User $user;
    private UserRepositoryInterface $userRepository;

    private CheckPasswordQueryHandler $queryHandler;
    public function setUp(): void
    {
        parent::setUp();
        $this->userReadRepository = new UserReadRepository();
        $this->queryHandler = new CheckPasswordQueryHandler();
        $this->user = Users::aUser();
        $this->userRepository = new UserRepositoryDbFacades();

    }

    public function testCanInstantiate()
    {
        $this->assertInstanceOf(CheckPasswordQueryHandler::class, $this->queryHandler);
    }

     public function testCanCheckPassword()
    {
        $this->userReadRepository->insertUserReadDB( new UserCreatedReadEvent($this->user));
        $handle = $this->userReadRepository->getUserById($this->user->getId());
        $query = new CheckPasswordQuery($handle->getPassword(), "a-password");
        $result = $this->queryHandler->handle($query);
        $this->assertTrue($result);
    } 

    public function testCanCheckPasswordFalse()
    {
        $this->expectException(\InvalidArgumentException::class);

        $query = new CheckPasswordQuery(new Password("12345678"), "123456789");
        $result = $this->queryHandler->handle($query);
        $this->assertFalse($result);
    }
}
