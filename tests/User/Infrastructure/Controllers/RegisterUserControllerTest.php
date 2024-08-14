<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Controllers;


use Illuminate\Http\Request;
use Mockery;
use Source\User\App\Services\User\CreateUser\CreateUserService;
use Tests\TestCase;

class RegisterUserControllerTest extends TestCase
{
    private RegisterUserController $registerUserController;

    public function setUp(): void   
    {
        parent::setUp();
        $this->registerUserController = new RegisterUserController(Mockery::mock(CreateUserService::class));
    }

    public function testCanInstantiate(): void
    {
        self::assertInstanceOf(RegisterUserController::class, $this->registerUserController);
    }

    

    public function test_user_is_created_successfully()
    {
        // Mock the CreateUserService
        $createUserService = Mockery::mock(CreateUserService::class);
        $createUserService->shouldReceive('execute')
            ->once()
            ->with('John Doe', 'johndoe@example.com', 'password', '127.0.0.1')
            ->andReturn(true);

        $controller = new RegisterUserController($createUserService);

        $request = Request::create('api/register', 'POST', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password',
        ], [], [], ['REMOTE_ADDR' => '127.0.0.1']);

        $response = $controller($request);
        

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals(['message' => 'User created successfully'], $response->getData(true));
    }
    public function test__invokeThrowsHttpResponseExceptionWithInvalidArgumentExceptionMessage()
{
    $this->expectException(\InvalidArgumentException::class);

    $request = new Request();
    $request->merge([
        
        'email' => 'johndoe@example.com',
        'password' => 'password123',
    ]);

    $createUserServiceMock = $this->createMock(CreateUserService::class);
    $createUserServiceMock->expects($this->once())
        ->method('execute')
        ->with($request->name, $request->email, $request->password, $request->ip())
        ->willThrowException(new \InvalidArgumentException('Invalid argument'));

    $controller = new RegisterUserController($createUserServiceMock);
    $response = $controller($request);

    $this->expectExceptionCode(400);
    $this->assertEquals(400, $response->getStatusCode());
    $this->expectExceptionMessage('Invalid argument');

}
}