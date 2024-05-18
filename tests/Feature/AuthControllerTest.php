<?php

use Database\Factories\UserFactory;
use Domain\User\Models\User;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    public function testLoginSuccess()
    {
        $user = UserFactory::new()->create();

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertOk();

        $response->assertJsonStructure([
            'token',
            'expires_at',
        ]);
    }

    public function testLoginFailInvalidCredentials()
    {
        $user = UserFactory::new()->create();

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'passworddd',
        ]);

        $this->expectException(UnauthorizedHttpException::class);

        $response->assertUnauthorized();

        $response->assertJson([
            'message' => 'Unauthorized',
        ]);
    }

    public function testLogOut()
    {
        $user = UserFactory::new()->create();

        $token = $this->loginUser($user);

        $response = $this->withToken($token)->deleteJson('/api/logout');

        $response->assertNoContent();
    }
}
