<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SupermarketTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateSupermarket()
    {
        $response = $this->post('/supermarkets', [
            'name' => 'Test Supermarket',
        ]);

        $response->assertRedirect('/supermarkets');
        $this->assertDatabaseHas('supermarkets', ['name' => 'Test Supermarket']);
    }

    public function testEditSupermarket()
    {
        $supermarket = DB::table('supermarkets')->insertGetId([
            'name' => 'Test Supermarket',
        ]);

        $response = $this->put("/supermarkets/{$supermarket}", [
            'name' => 'Updated Supermarket',
        ]);

        $response->assertRedirect('/supermarkets');
        $this->assertDatabaseHas('supermarkets', ['name' => 'Updated Supermarket']);
    }

    public function testDeleteSupermarket()
    {
        $supermarket = DB::table('supermarkets')->insertGetId([
            'name' => 'Test Supermarket',
        ]);

        $response = $this->delete("/supermarkets/{$supermarket}");

        $response->assertRedirect('/supermarkets');
        $this->assertDatabaseMissing('supermarkets', ['name' => 'Test Supermarket']);
    }
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/supermarkets');

        $response->assertStatus(200);
    }

}
