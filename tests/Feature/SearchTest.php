<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class SearchTest extends TestCase
{
    use RefreshDatabase;
    public function test_search_products(): void
    {
        $product = Product::factory()->create();
        $user = User::factory()->create();

        // Simulate authentication
        $this->actingAs($user);

        // Perform a search with a specific term
        $response = $this->withSession(['search' => $product->Name])
            ->get('/product');

        // Assertions
        $response->assertStatus(200);
        $response->assertSee($product->Name);
    }

    public function test_search_returns_expected_results()
    {
        // Create some test products
        Product::factory()->create([
            'Name' => 'Product A',
            'Category' => 'Category A',
            'Quantity' => 1,
            'Price' => 100,
            // Add more attributes as necessary
        ]);

        Product::factory()->create([
            'Name' => 'Product B',
            'Category' => 'Category B',
            'Quantity' => 10,
            'Price' => 1000,
            // Add more attributes as necessary
        ]);

        $user = User::factory()->create();

        // Simulate authentication
        $this->actingAs($user);

        // Perform a search with a specific term
        $response = $this->withSession(['search' => 'Product A'])
            ->get('/product');

        // Perform a search for Product A
        $response->assertStatus(200);
        $response->assertSee('Product A');
        $response->assertDontSee('Product B');
    }

    public function test_search_products_by_name()
    {
        // Create sample products in the database
        $products = Product::factory()->count(5)->create();

        // Perform a search by name
        $searchTerm = $products->first()->Name;
        $slicedProducts = $products->slice(1, 4);

        $namesArray = [];

        foreach ($slicedProducts as $product) {
            // Assuming "Name" is a property of the product object
            $namesArray[] = $product->Name; // Add the "Name" property to the $namesArray
        }

        $user = User::factory()->create();

        // Simulate authentication
        $this->actingAs($user);

        $response = $this->withSession(['search' => $searchTerm])
            ->get('/product');

        $response->assertStatus(200);
        $response->assertSee($searchTerm);
        $response->assertDontSee($namesArray[0]);
    }

    public function test_filter_products_by_one_category()
    {
        // Create sample products in the database with different categories
        Product::factory()->create([
            'Name' => 'Product A',
            'Category' => 'Solar Panel',
            'Quantity' => 1,
            'Price' => 100,
            // Add more attributes as necessary
        ]);

        Product::factory()->create([
            'Name' => 'Product B',
            'Category' => 'Battery',
            'Quantity' => 10,
            'Price' => 1000,
            // Add more attributes as necessary
        ]);
        Product::factory()->create([
            'Name' => 'ProductC',
            'Category' => 'Wire',
            'Quantity' => 50,
            'Price' => 1500,
            // Add more attributes as necessary
        ]);
        $user = User::factory()->create();

        // Simulate authentication
        $this->actingAs($user);

        // Perform a filter by category
        $response = $this->withSession(['category' => ['Battery']])
            ->get('/product');

        $response->assertStatus(200);
        $response->assertDontSeeText(['Product A', 'ProductC']);
        $response->assertSeeText('Product B');
    }
    public function test_filter_products_by_multiple_categories()
    {
        // Create sample products in the database with different categories
        Product::factory()->create([
            'Name' => 'Product A',
            'Category' => 'Solar Panel',
            'Quantity' => 1,
            'Price' => 100,
            // Add more attributes as necessary
        ]);

        Product::factory()->create([
            'Name' => 'Product B',
            'Category' => 'Battery',
            'Quantity' => 10,
            'Price' => 1000,
            // Add more attributes as necessary
        ]);
        Product::factory()->create([
            'Name' => 'Product D',
            'Category' => 'Wire',
            'Quantity' => 50,
            'Price' => 1500,
            // Add more attributes as necessary
        ]);
        $user = User::factory()->create();

        // Simulate authentication
        $this->actingAs($user);

        // Perform a filter by category
        $response = $this->withSession(['category' => ['Battery', 'Solar Panel']])
            ->get('/product');
        $response->assertStatus(200);
        $response->assertDontSeeText(['Product D']);
        $response->assertSeeText(['Product B', 'Product A']);
    }
    public function test_filter_products_by_multiple_categories_and_common_attribute()
    {
        // Create sample products in the database with different categories
        Product::factory()->create([
            'Name' => 'Product A',
            'Category' => 'Solar Panel',
            'Quantity' => 10,
            'Price' => 100,
            // Add more attributes as necessary
        ]);

        Product::factory()->create([
            'Name' => 'Product B',
            'Category' => 'Battery',
            'Quantity' => 10,
            'Price' => 1000,
            // Add more attributes as necessary
        ]);
        Product::factory()->create([
            'Name' => 'Product D',
            'Category' => 'Wire',
            'Quantity' => 50,
            'Price' => 1000,
            // Add more attributes as necessary
        ]);
        $user = User::factory()->create();

        // Simulate authentication
        $this->actingAs($user);

        // Perform a filter by category
        $response = $this->withSession([['category' => ['Battery', 'Wire']], 'search' => '1000'])
            ->get('/product');
        $response->assertStatus(200);
        $response->assertDontSeeText(['Product A']);
        $response->assertSeeText(['Product B', 'Product D']);
    }

    public function test_reset_search_and_filter_options()
    {
        // Perform a reset action
        $user = User::factory()->create();

        // Simulate authentication
        $this->actingAs($user);
        $response = $this->get('/reset');

        // Assertions for verifying the reset action
        $response->assertRedirect(route('product.index'))->assertSessionHasAll([['category' => []], 'num_items' => 5]);
    }

    public function test_search_handles_empty_queries(): void
    {
        // Create sample products in the database with different categories
        Product::factory()->create([
            'Name' => 'Product A',
            'Category' => 'Solar Panel',
            'Quantity' => 10,
            'Price' => 100,
            // Add more attributes as necessary
        ]);

        Product::factory()->create([
            'Name' => 'Product B',
            'Category' => 'Battery',
            'Quantity' => 10,
            'Price' => 1000,
            // Add more attributes as necessary
        ]);
        Product::factory()->create([
            'Name' => 'Product C',
            'Category' => 'Wire',
            'Quantity' => 50,
            'Price' => 1500,
            // Add more attributes as necessary
        ]);

        $user = User::factory()->create();

        // Simulate authentication
        $this->actingAs($user);

        // Assertions for handling empty queries
        $response = $this->withSession(['search' => null])->get('/product');
        $response->assertStatus(200);
        $response->assertSeeText(['Product A', 'Product B', 'Product C']);
    }

    public function test_search_handles_special_characters(): void
    {
        // Create sample products in the database with different categories
        Product::factory()->create([
            'Name' => 'Product A',
            'Category' => 'Solar Panel',
            'Quantity' => 10,
            'Price' => 100,
            // Add more attributes as necessary
        ]);

        Product::factory()->create([
            'Name' => 'Product B',
            'Category' => 'Battery',
            'Quantity' => 10,
            'Price' => 1000,
            // Add more attributes as necessary
        ]);
        Product::factory()->create([
            'Name' => 'Product D',
            'Category' => 'Wire',
            'Quantity' => 50,
            'Price' => 1500,
            // Add more attributes as necessary
        ]);

        $user = User::factory()->create();

        // Simulate authentication
        $this->actingAs($user);

        // Add assertions for handling special characters
        $response = $this->get('/search?search=#@!%$');
        $response->assertStatus(302)->assertRedirectToRoute('product.index')->assertSessionHas('search', '');
    }

    public function test_search_for_nonexistent_product(): void
    {
        // Create sample products in the database with different categories
        Product::factory()->create([
            'Name' => 'Product A',
            'Category' => 'Solar Panel',
            'Quantity' => 10,
            'Price' => 100,
            // Add more attributes as necessary
        ]);

        Product::factory()->create([
            'Name' => 'Product B',
            'Category' => 'Battery',
            'Quantity' => 10,
            'Price' => 1000,
            // Add more attributes as necessary
        ]);
        Product::factory()->create([
            'Name' => 'Product D',
            'Category' => 'Wire',
            'Quantity' => 50,
            'Price' => 1500,
            // Add more attributes as necessary
        ]);

        $user = User::factory()->create();

        // Simulate authentication
        $this->actingAs($user);
        $response = $this->withSession(['search' => 'Product L'])
            ->get('/product');
        // Add assertions for handling non-existent products
        $response->assertStatus(200);
        $response->assertSeeText('No products available');
    }
}
