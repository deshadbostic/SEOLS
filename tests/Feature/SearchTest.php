<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class SearchTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_search(): void
    {
        $user = User::factory()->create();

        // Simulate authentication
        $this->actingAs($user);

        // Perform a search with a specific term
        $searchTerm = 'Your search term'; // Replace this with an actual search term
        $response = $this->get("/search?search=$searchTerm&category[]=b");

        // Assertions
        $response->assertStatus(302)->assertSessionHas('search', $searchTerm); // Ensure that the response is a redirect
    }
}
