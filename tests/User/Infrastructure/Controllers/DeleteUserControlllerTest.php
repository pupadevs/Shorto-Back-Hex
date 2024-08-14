<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Controllers;


use Mockery;
use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\App\Services\User\DeleteUser\DeleteUserService;
use Source\User\Infrastructure\Repository\User\Write\UserRepositoryDbFacades;
use Tests\Fixtures\Users;
use Tests\TestCase;
use Tests\Traits\RefreshMultipleDatabases;

 class DeleteUserControlllerTest extends TestCase
{

    use RefreshMultipleDatabases;

    private DeleteUserController $controller;
    private DeleteUserService $deleteUserService;
    
   
    protected function setUp(): void
    {
        parent::setUp();

        // Crear un stub para el DeleteUserService
        $this->deleteUserService = $this->createMock(DeleteUserService::class);

        // Instanciar el controlador con el servicio mockeado
        $this->controller = new DeleteUserController($this->deleteUserService);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
/**
 * testCanInstantiate
 * @test    
 */
    public function testCanInstantiate()
    {

        $this->assertInstanceOf(DeleteUserController::class, $this->controller);
    }

   
/**
 * test_user_is_deleted_successfully
 * @test
 */
    public function test_user_is_deleted_successfully()
    {
        $user = Users::aUser();
        $userRepository = new UserRepositoryDbFacades();
        $userRepository->save($user);
        event(new UserCreatedReadEvent($user));
        $response = $this->deleteJson('/api/delete/' . $user->getId()->toString());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['message' => 'User deleted successfully'], $response->getData(true));
    }

   
}