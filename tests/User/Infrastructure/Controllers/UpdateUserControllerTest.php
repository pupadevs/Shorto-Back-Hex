<?php

namespace Source\User\Infrastructure\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tests\TestCase;
use Mockery;
use Source\User\App\Services\User\UpdateUser\UpdateUserService;
use Source\User\Infrastructure\Controllers\UpdateUserController;
use Tests\Fixtures\Users;

class UpdateUserControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function tearDown(): void
    {
        Mockery::close();
    }

    /** @test */
    public function it_can_instantiate()
    {
        // Intentar crear una instancia del controlador
        $controller = new UpdateUserController(Mockery::mock(UpdateUserService::class));

        // Verificar que se haya creado una instancia del controlador
        $this->assertInstanceOf(UpdateUserController::class, $controller);
    }

    /** @test */
    public function it_updates_existing_user()
    {
        // Crear un usuario de prueba
        $user =Users::aUser();

        // Generar datos de prueba para la actualización
     

        // Mockear el servicio de actualización de usuario
        $updateUserService = Mockery::mock(UpdateUserService::class);
        $updateUserService->shouldReceive('execute')->once()->andReturn($user);

        // Crear una instancia del controlador con el servicio mockeado
        $controller = new UpdateUserController($updateUserService);

        // Crear una solicitud falsa con los datos de prueba
        $request = Request::create('api/update/' . $user->getId()->toString(), 'PUT', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password',
        ], [], [], ['REMOTE_ADDR' => '127.0.0.1']);

        // Ejecutar el método __invoke del controlador
        $response = $controller->__invoke($request, $user->getId()->toString());

        // Verificar que la respuesta sea una instancia de JsonResponse
        $this->assertInstanceOf(JsonResponse::class, $response);

        // Verificar que el código de respuesta sea 200 (éxito)
        $this->assertEquals(200, $response->getStatusCode());

        // Decodificar el contenido de la respuesta JSON
        $content = json_decode($response->getContent(), true);

        // Verificar que el mensaje de la respuesta sea correcto
        $this->assertEquals('User updated successfully', $content['message']);

      
    }

    // Otros métodos de prueba para manejar casos de error como UserNotFoundException, EmailExistsException, TransactionErrorException, etc.
}
