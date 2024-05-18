<?php

use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testCreateUserSuccess()
    {
        $response = $this->postJson('/api/register', [
            'email' => 'john@mail.com',
            'name' => 'John Doe',
            'password' => '1234'
        ]);

        $response->assertCreated();

        $response->assertJsonStructure([
            'id',
            'email',
            'name',
            'created_at',
            'updated_at'
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@mail.com',
            'name' => 'John Doe'
        ]);
    }

    public function testCreateUserFailsDuplicatedEmail()
    {
        $response = $this->postJson('/api/register', [
            'email' => 'john@mail.com',
            'name' => 'John Doe',
            'password' => '1234'
        ]);

        $response->assertCreated();

        $response = $this->postJson('/api/register', [
            'email' => 'john@mail.com',
            'name' => 'John Doe',
            'password' => '1234'
        ]);

        $response->assertUnprocessable();
    }
}
