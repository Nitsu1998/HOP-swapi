<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StarshipsTest extends TestCase
{
    use RefreshDatabase;
    
    public function testGetAllStarships(): void
    {
        $response = $this->getJson('/api/starships');
        $response->assertStatus(200);
    }

    public function testGetStarshipByID(): void
    {
        $response = $this->getJson('/api/starships/1');
        $response->assertStatus(200);
    }

    public function testUpdateCountStarship(): void
    {
        $response = $this->putJson('/api/starships/1/updateCount', ['amount' => 4]);
        $response->assertJson(['starship_id' => 1, 'message' => 'Count updated successfully']);
        $response->assertStatus(200);
    }

    public function testIncrementCountStarship(): void
    {
        $response = $this->putJson('/api/starships/1/incrementCount', ['amount' => 2]);
        $response->assertJson(['starship_id' => 1, 'message' => 'Count incremented successfully']);
        $response->assertStatus(200);
    }

    public function testDecrementCountStarship(): void
    {
        $response = $this->putJson('/api/starships/1/decrementCount', ['amount' => 6]);
        $response->assertJson(['starship_id' => 1, 'message' => 'Count decremented successfully']);
        $response->assertStatus(200);
    }
}
