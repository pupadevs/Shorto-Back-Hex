<?php 

declare(strict_types=1);

namespace Tests\User\Infrastructure\Controllers;


use Mockery;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\App\Services\User\ChangePassword\ChangePasswordService;
use Source\User\Infrastructure\Controllers\ChangePasswordController;
use Source\User\Infrastructure\Repository\User\Write\UserRepositoryDbFacades;
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
        $userRepository = new UserRepositoryDbFacades();
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
