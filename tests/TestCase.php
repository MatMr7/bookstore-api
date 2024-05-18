<?php

namespace Tests;

use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    public function loginUser(User $user)
    {
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        return $response->json()['token'];
    }
}
