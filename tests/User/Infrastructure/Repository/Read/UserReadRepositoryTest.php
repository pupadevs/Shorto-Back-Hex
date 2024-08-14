<?php 

namespace Source\User\Infrastructure\Repository\Read;

use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Entity\User\User;
use Source\User\Domain\Events\User\ChangePasswordEvent\ChangePasswordReadEvent;
use Source\User\Domain\Events\User\DeleteUserEvent\DeleteUserReadEvent;
use Source\User\Domain\Events\User\UserUpdatedEvent\UserUpdatedReadEvent;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserReadRepositoryInterface;
use Source\User\Domain\ValueObjects\User\Password;
use Tests\TestCase;
use Source\User\Domain\ValueObjects\User\UserID;
use Source\User\Infrastructure\Repository\Exception\EmailExistsException;
use Source\User\Infrastructure\Repository\Exception\UserNotFoundException;
use Source\User\Infrastructure\Repository\User\Read\UserReadRepository;
use Tests\Fixtures\Users;

class UserReadRepositoryTest extends TestCase
{
     private User $user;

     public static function dataProvider(): array
     {
         return [
   
             'In MySQL' => [new UserReadRepository()],
         ];
     }
    public function setUp(): void
    {
        parent::setUp();
        $this->user = Users::aUser();
    }
     /**
     * @dataProvider dataProvider
     */
    public function testCanInstantiate(UserReadRepositoryInterface $userReadRepository)
    {
        self::assertInstanceOf(UserReadRepositoryInterface::class, $userReadRepository);
    }

     /**
     * @dataProvider dataProvider
     */
    public function test_insertUserReadDB(UserReadRepositoryInterface $userReadRepository)
    {
        $userReadRepository->insertUserReadDB(new UserCreatedReadEvent($this->user));
        $handle = $userReadRepository->getUserById($this->user->getId());
        self::assertEquals($this->user->getId()->toString(), $handle->getId()->toString());
    }
  /**
     * @dataProvider dataProvider
     */
    public function  test_can_save_user(UserReadRepositoryInterface $userReadRepository)
    {
        $userReadRepository->insertUserReadDB(new UserCreatedReadEvent($this->user));
        $userReadRepository->save(new UserUpdatedReadEvent($this->user));
        $handle = $userReadRepository->getUserById($this->user->getId());
        self::assertEquals($this->user->getId()->toString(), $handle->getId()->toString());
       
    }
  /**
     * @dataProvider dataProvider
     */
    public function test_can_change_password(UserReadRepositoryInterface $userReadRepository)
    {
        $plainPassword = '12345678';
        $pwd = new Password($plainPassword);
    
        $userReadRepository->insertUserReadDB(new UserCreatedReadEvent($this->user));
        $handle = $userReadRepository->getUserById($this->user->getId());
        $handle->changePassword($pwd);
        $userReadRepository->changePassword(new ChangePasswordReadEvent($handle));
    
      
    
        // Verificar que la contraseña almacenada es correcta
        self::assertTrue(password_verify($plainPassword, $handle->getPassword()->ToString()));
    }
    
  /**
     * @dataProvider dataProvider
     */
    public function test_can_delete_user(UserReadRepositoryInterface $userReadRepository)
    {
        $userReadRepository->insertUserReadDB(new UserCreatedReadEvent($this->user));
      $userReadRepository->deleteUser(new DeleteUserReadEvent($this->user));
      $this->expectException(UserNotFoundException::class);
        
        self::assertNull($userReadRepository->getUserById($this->user->getId()));
    }
  /**
     * @dataProvider dataProvider
     */
    public function test_email_exists(UserReadRepositoryInterface $userReadRepository)
    {
        $userReadRepository->insertUserReadDB(new UserCreatedReadEvent($this->user));
        $this->expectException(EmailExistsException::class);
        self::assertTrue($userReadRepository->emailExists($this->user->getEmail()));
    }
  /**
     * @dataProvider dataProvider
     */
       public function testCanReturnUserNotFoundException(UserReadRepositoryInterface $userReadRepository): void
    {
        $this->expectException(UserNotFoundException::class);
        $userReadRepository->getUserByID(new UserID());
    } 
      /**
     * @dataProvider dataProvider
     */
    public function testCanGetUserById(UserReadRepositoryInterface $userReadRepository): void
    {
     
        $userReadRepository->insertUserReadDB(new UserCreatedReadEvent($this->user));
        $handle = $userReadRepository->getUserById($this->user->getId());
        self::assertEquals($this->user->getId()->toString(), $handle->getId()->toString());
    }
}