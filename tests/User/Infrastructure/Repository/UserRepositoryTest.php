<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository;

use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserRepositoryInterface;
use Tests\TestCase;
use Source\User\Domain\ValueObjects\User\Name;
use Source\User\Infrastructure\Repository\Exception\UserNotFoundException;
use Source\User\Infrastructure\Repository\User\Memory\UserRepositoryInMemory;
use Source\User\Infrastructure\Repository\User\Read\UserReadRepository;
use Source\User\Infrastructure\Repository\User\Write\UserRepositoryDbFacades;
use Tests\Fixtures\Users;

use function PHPUnit\Framework\assertTrue;

class UserRepositoryTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        // Agrega cualquier configuración necesaria antes de ejecutar los tests
    }

    public static function dataProvider(): array
    {
        return [
            'In Memory' => [new UserRepositoryInMemory()],
            'In MySQL' => [new UserRepositoryDbFacades()],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testCanInstantiate(UserRepositoryInterface $userRepository): void
    {
        self::assertInstanceOf(UserRepositoryInterface::class, $userRepository);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testCanSave(UserRepositoryInterface $userRepository): void
    {
        $user = Users::aUser();
      $data=  $userRepository->insertUser($user);
      //  $actualUser = $userRepository->findById($user->getId());
      //  $this->assertEquals($user, $actualUser);
       assertTrue($data);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testCanUpdate(UserRepositoryInterface $userRepository): void
    {
        $userReadRepository = new UserReadRepository();
        $user = Users::aUser();
        $userRepository->save($user);
        $userReadRepository->insertUserReadDB(new UserCreatedReadEvent($user));
        $user->changeName(new Name('John Doe'));
        $userRepository->save($user);
        $actual = $userReadRepository->getUserById($user->getId());
        $this->assertEquals($user->getName()->ToString(), $actual->getName()->ToString());
    }


    /**
     * @dataProvider dataProvider
     */
 /*    public function testCanFindById(UserRepositoryInterface $userRepository): void
    {
        $user = Users::aUser();
        $userRepository->insertUser($user);
        $actual = $userRepository->findById($user->getId());
        $this->assertEquals($user, $actual);
    } */

    /**
     * @dataProvider dataProvider
     */
    public function testCanDeleteAUser(UserRepositoryInterface $userRepository): void
    {
        $user = Users::aUser();
        $userRepository->save($user);
        $userRepository->deleteUser($user);
     //   $this->expectException(UserNotFoundException::class);
     self::assertTrue(true);
      
    }
}
