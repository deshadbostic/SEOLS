<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;

class ProductCustomerTest extends TestCase
{
    use RefreshDatabase;
    public function test_can_customer_view_products(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/product');
        $response->assertStatus(200)->assertViewIs('product.index');
        ob_end_clean(); 
    }
    public function test_can_customer_store_product(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/product', ['Name' => 'Solarium Test', 'Category' => 'Cable', 'Price' => 2300, 'Quantity' => 62]);
        $response->assertStatus(403);
    }
    public function test_can_customer_create_product(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/product/create');
        $response->assertStatus(403);
    }
    public function test_can_customer_view_product(): void
    {
        $product = Product::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/product/' . $product->id);
        $response->assertStatus(200);
        $response->assertSeeText($product->name);
    }
    public function test_can_customer_update_product(): void
    {
        $product = Product::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->patch('/product/' . $product->id, ['Name' => 'Solarium Test', 'Category' => 'Cable', 'Price' => 2300, 'Quantity' => 62]);
        $response->assertStatus(403);
    }
    public function test_can_customer_delete_product(): void
    {
        $product = Product::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->delete('/product/' . $product->id);
        $response->assertStatus(403);
    }

    public function test_can_customer_edit_product(): void
    {
        $product = Product::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/product/' . $product->id . '/edit/');
        $response->assertStatus(403);
    }
}
