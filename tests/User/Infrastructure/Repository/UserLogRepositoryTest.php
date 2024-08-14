<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository;

use Source\User\Domain\Entity\UserLog\UserLog;
use Source\User\Domain\Events\User\UserCreatedEvent\UserCreatedLogEvent;
use Source\User\Domain\Events\User\UserUpdatedEvent\UserUpdatedLogEvent;
use Source\User\Domain\Interfaces\UserLogRepositoryContracts\UserLogRepositoryInterface;
use Source\User\Domain\ValueObjects\User\UserID;
use Source\User\Infrastructure\Repository\User\Write\UserRepositoryDbFacades;
use Source\User\Infrastructure\Repository\UserLog\Memory\UserLogRepositoryInMemory;
use Source\User\Infrastructure\Repository\UserLog\Write\UserLogRepository;
use Tests\Fixtures\Users;
use Tests\TestCase;

class UserLogRepositoryTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        // Agrega cualquier configuración necesaria antes de ejecutar los tests
    }

    public static function dataProvider(): array
    {
        return [
           'In Memory' => [new UserLogRepositoryInMemory()],
            'In MySQL' => [new UserLogRepository()],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testCanInstantiate(UserLogRepositoryInterface $userLogRepository): void
    {
        self::assertInstanceOf(UserLogRepositoryInterface::class, $userLogRepository);
    }

      /**
     * @dataProvider dataProvider
     */

    public function testCanSaveUserLog(UserLogRepositoryInterface $userLogRepository): void
    {   $useRepository = new UserRepositoryDbFacades();
        $user= Users::aUser();
        $useRepository->insertUser($user);
        $event = new UserCreatedLogEvent($user->getId()->toString(),"127.0.0.1");
        $logEvent =  UserLog::createUserLog($event->getAction(),$event->getIp(),new UserID($event->getUserId()),$event->getEventType(),self::class);
        $userLogRepository->save($logEvent);
        $this->assertTrue(true);
    }

     /**
     * @dataProvider dataProvider
     */

    public function testCanSaveUserUpdateLog(UserLogRepositoryInterface $userLogRepository): void
    {

        $user= Users::aUser();
        $useRepository = new UserRepositoryDbFacades();
        $useRepository->insertUser($user);
        $event = new UserUpdatedLogEvent($user->getId()->toString(),"37.0.0.1",);
        $logEvent =  UserLog::createUserLog($event->getAction(),$event->getIp(),new UserID($event->getUserId()),$event->getEventType(),self::class);
        $userLogRepository->save($logEvent);
        $this->assertTrue(true);

    }
 
}