<?php 
declare(strict_types=1);

namespace Tests\User\App\Service;


use Illuminate\Container\Container;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;
use Source\Shared\CQRS\Command\CommandBus;
use Source\Shared\CQRS\Querys\QueryBus;
use Source\User\App\Commands\UserCommands\ChangePassword\ChangePasswordCommand;
use Source\User\App\Querys\UserQuery\CheckPassword\CheckPasswordQuery;
use Source\User\App\Querys\UserQuery\FindUser\FindUserByIdQuery;
use Source\User\App\Services\User\ChangePassword\ChangePasswordService;
use Source\User\Domain\Entity\User\User;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserReadRepositoryInterface;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\User\Password;
use Tests\Fixtures\Users;

class ChangePasswordServiceTest extends TestCase{
    use RefreshDatabase;

    private CommandBus $commandBus;
    private QueryBus $queryBus;
    private ChangePasswordService $changePasswordService;
    private User $user;
   private UserReadRepositoryInterface $userReadRepository;
    
   private UserRepositoryInterface $userRepository;

  
   protected function setUp(): void
   {
       parent::setUp();

       $this->queryBus = $this->createMock(QueryBus::class);
       $this->commandBus = $this->createMock(CommandBus::class);
       $this->user = Users::aUser();

       $this->changePasswordService = new ChangePasswordService(
           $this->commandBus,
           $this->queryBus
       );
   }

   public function testExecute(): void
   {
       $userId = '123';
       $oldPassword = 'a-password';
       $newPassword = 'newpassword';
       $ipAddress = '127.0.0.1';

       // Configurar el comportamiento esperado del queryBus para FindUserByIdQuery
       $this->queryBus
           ->expects($this->exactly(2))  // Se llamará dos veces
           ->method('handle')
           ->willReturnCallback(function ($query) use ($oldPassword, $newPassword) {
               if ($query instanceof FindUserByIdQuery) {
                   return $this->user;
               }
               if ($query instanceof CheckPasswordQuery) {
                   return password_verify($newPassword, password_hash($oldPassword, PASSWORD_DEFAULT));
               }
               return null;
           });

       // Configurar el comportamiento esperado del commandBus para ChangePasswordCommand
       $this->commandBus
           ->expects($this->once())
           ->method('execute')
           ->with($this->isInstanceOf(ChangePasswordCommand::class))
           ->willReturnCallback(function (ChangePasswordCommand $command) use ($newPassword) {
               $command->getUser()->changePassword(new Password($newPassword));
           });

       // Ejecutar el servicio de cambio de contraseña
       $this->changePasswordService->execute($oldPassword, $newPassword, $userId, $ipAddress);

       // Asegurarse de que la contraseña del usuario se haya actualizado correctamente
       $this->assertTrue(password_verify($newPassword, $this->user->getPassword()->ToString()));
   }

}