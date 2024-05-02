<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository;

use Tests\TestCase;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\UserId;
use Source\User\Infrastructure\Repository\Exception\UserNotFoundException;
use Source\User\Infrastructure\Repository\UserRepositoryEloquentMySql;
use Source\User\Infrastructure\Repository\Memory\UserRepositoryInMemory;
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
            'In MySQL' => [new UserRepositoryEloquentMySql()],
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
        $userRepository->insertUser($user);
        $actualUser = $userRepository->findById($user->getId());
        $this->assertEquals($user, $actualUser);
       // assertTrue($userRepository);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testCanReturnUserNotFoundException(UserRepositoryInterface $userRepository): void
    {
        $this->expectException(UserNotFoundException::class);
        $userRepository->findById(new UserId());
    }

    /**
     * @dataProvider dataProvider
     */
    public function testCanFindById(UserRepositoryInterface $userRepository): void
    {
        $user = Users::aUser();
        $userRepository->insertUser($user);
        $actual = $userRepository->findById($user->getId());
        $this->assertEquals($user, $actual);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testCanDeleteAUser(UserRepositoryInterface $userRepository): void
    {
        $user = Users::aUser();
        $userRepository->save($user);
        $userRepository->deleteUser($user);
        $this->expectException(UserNotFoundException::class);
        $userRepository->findById($user->getId());
    }
}
