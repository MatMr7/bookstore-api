<?php

use Database\Factories\StoreFactory;
use Database\Factories\UserFactory;
use Tests\TestCase;

class StoreControllerTest extends TestCase
{
    public function testListStores()
    {
        $user = UserFactory::new()->create();

        StoreFactory::new()->count(10)->create();

        $token = $this->loginUser($user);

        $response = $this->withToken($token)->getJson('/api/stores');

        $response->assertJsonCount(10, 'data');

        $response->assertJsonStructure([
            'current_page',
            'data',
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'address',
                    'is_active',
                    'created_at',
                    'updated_at'
                ]
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total'
        ]);
    }

    public function testCreateStore()
    {
        $user = UserFactory::new()->create();
        $token = $this->loginUser($user);

        $storeData = [
            'name' => 'John Doe',
            'address' => '32, My Street, Kingston, New York 12401',
            'is_active' => true
        ];

        $response = $this->withToken($token)->postJson('/api/stores', $storeData);

        $response->assertCreated();

        $this->assertDatabaseHas('stores', $storeData);
    }

    public function testGetStoreById()
    {
        $user = UserFactory::new()->create();
        $token = $this->loginUser($user);

        $store = StoreFactory::new()->create();

        $response = $this->withToken($token)->getJson('/api/stores/' . $store->id);

        $response->assertOk();

        $response->assertJsonStructure([
            'id',
            'name',
            'address',
            'is_active',
            'created_at',
            'updated_at'
        ]);
    }

    public function testUpdateStore()
    {
        $user = UserFactory::new()->create();
        $token = $this->loginUser($user);

        $store = StoreFactory::new()->create();

        $storeData = [
            'name' => 'Jane Doe',
            'address' => 'Blvd., Suite 800. Toront',
            'is_active' => false
        ];

        $response = $this->withToken($token)->putJson('/api/stores/' . $store->id, $storeData);

        $response->assertOk();

        $response->assertJsonStructure([
            'id',
            'name',
            'address',
            'is_active',
            'created_at',
            'updated_at'
        ]);

        $this->assertDatabaseHas('stores', $storeData);
    }

    public function testDeleteStore()
    {
        $user = UserFactory::new()->create();

        $token = $this->loginUser($user);

        $store = StoreFactory::new()->create();

        $this->assertDatabaseCount('stores', 1);

        $response = $this->withToken($token)->deleteJson('/api/stores/' . $store->id);

        $response->assertNoContent();

        $this->assertDatabaseCount('stores', 0);
    }
}
