<?php 

declare(strict_types=1);

namespace Tests\User\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Event;
use Mockery;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\App\Services\ChangePasswordService;
use Source\User\Infrastructure\Controllers\ChangePasswordController;
use Source\User\Infrastructure\Repository\Read\UserReadRepository;
use Source\User\Infrastructure\Repository\UserRepositoryEloquentMySql;
use Tests\Fixtures\Users;
use Tests\TestCase;

class ChangePasswordControllerTest extends TestCase
{
    public function testcanInstantiate(): void
    {
        $controller = new ChangePasswordController(Mockery::mock(ChangePasswordService::class));
        $this->assertInstanceOf(ChangePasswordController::class, $controller);
    }

    public function testCanChangeAPassword(): void
    {
       
        $user = Users::aUser();
        $userRepository = new UserRepositoryEloquentMySql();
        $userRepository->save($user);
        event(new UserCreatedReadEvent($user));
        
    
        
        $response = $this->patchJson('/api/change-password/' . $user->getId()->toString(), 
             [
                'new_password' => '12345678',
                'password_old' => "a-password",
            ],
        );
        self::assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['message' => 'Password changed successfully'], $response->getData(true));


    }
}
