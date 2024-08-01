<?php 

declare(strict_types=1);

namespace Source\User\Domain\Events;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\App\Querys\CheckEmailQuery;
use Source\User\App\Querys\CheckEmailQueryHandler;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Interfaces\UserReadRepositoryInterface;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Infrastructure\Repository\Exception\EmailExistsException;
use Tests\TestCase;
use Source\User\Infrastructure\Repository\Read\UserReadRepository;
use Source\User\Infrastructure\Repository\UserRepositoryEloquentMySql;
use Tests\Fixtures\Users;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class CheckEmailQueryTest extends TestCase
{
    use DatabaseTransactions;

    private UserReadRepositoryInterface $userReadRepository;
    private User $user;
    private UserRepositoryInterface $userRepository;

    private CheckEmailQueryHandler $queryHandler;
    public function setUp(): void
    {
        parent::setUp();
        $this->userReadRepository = new UserReadRepository();
        $this->queryHandler = new CheckEmailQueryHandler($this->userReadRepository);
        $this->user = Users::aUser();
        $this->userRepository = new UserRepositoryEloquentMySql();

    }



    public function testCanInstantiate()
    {
        self::assertInstanceOf(CheckEmailQueryHandler::class, $this->queryHandler);
    }

    public function testCanGetEmailNotExists()
    {
        $this->userReadRepository->insertUserReadDB(new UserCreatedReadEvent($this->user));
        
      $email=  $this->queryHandler->handle(new CheckEmailQuery(new Email("p5g9Z@example.com")));
self:assertTrue($email);
      
} 

public function testCanGetEmailExists()
{
    $this->userReadRepository->insertUserReadDB(new UserCreatedReadEvent($this->user));
    $this->expectException(EmailExistsException::class);
    $email=  $this->queryHandler->handle(new CheckEmailQuery($this->user->getEmail()));
self:assertFalse($email);  
}

}