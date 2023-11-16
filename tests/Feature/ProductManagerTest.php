<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;

class ProductManagerTest extends TestCase
{
    use RefreshDatabase;
    public function test_can_manager_view_products(): void
    {
        
        $manager = User::factory()->manager()->create();
        $this->actingAs($manager);
        $response = $this->get('/product');
        $response->assertStatus(200);
    }
    public function test_can_manager_store_product_with_attributes(): void
    {
        $manager = User::factory()->manager()->create();
        $this->actingAs($manager);
        $response = $this->post('/product', [
            'Name' => 'Solarium Test',
            'Category' => 'Cable',
            'Price' => 2300, 'Quantity' => 62,
            'attributes' => [
                'Attribute_type' => [
                    'weight'
                ],
                'Attribute_value' => [
                    '560'
                ]
            ]
        ]);
        $response->assertStatus(302)->assertSessionHas('success','Product successfully created.')->assertRedirectToRoute('product.index');
    }
    public function test_can_manager_create_product(): void
    {
        $manager = User::factory()->manager()->create();
        $this->actingAs($manager);
        $response = $this->get('/product/create');
        $response->assertStatus(200);
    }
    public function test_can_manager_view_product(): void
    {
        $product = Product::factory()->create();
        $manager = User::factory()->manager()->create();
        $this->actingAs($manager);
        $response = $this->get('/product/' . $product->id);
        $response->assertStatus(200);
        $response->assertSeeText($product->name);
    }
    public function test_can_manager_update_product_with_attributes(): void
    {
        $product = Product::factory()->create();
        $manager = User::factory()->manager()->create();
        $this->actingAs($manager);
        $response = $this->patch('/product/' . $product->id, [
            'Name' => 'Solarium Test',
            'Category' => 'Cable',
            'Price' => 2300, 'Quantity' => 62,
            'attributes' => [
                'Attribute_type' => [
                    'weight'
                ],
                'Attribute_value' => [
                    '560'
                ]
            ]
        ]);
        $response->assertStatus(302)->assertSessionHas('success','Product successfully updated.')->assertRedirectToRoute('product.index');
    }
    public function test_can_manager_delete_product(): void
    {
        $product = Product::factory()->create();
        $manager = User::factory()->manager()->create();
        $this->actingAs($manager);
        $response = $this->delete('/product/' . $product->id);
        $response->assertStatus(302)->assertSessionHas('success','Product successfully deleted.');
    }

    public function test_can_manager_edit_product(): void
    {
        $product = Product::factory()->create();
        $manager = User::factory()->manager()->create();
        $this->actingAs($manager);
        $response = $this->get('/product/' . $product->id . '/edit/');
        $response->assertStatus(200);
    }
    public function test_can_manager_store_product_with_no_attributes(): void
    {
        $manager = User::factory()->manager()->create();
        $this->actingAs($manager);
        $response = $this->post('/product', [
            'Name' => 'Solarium Test',
            'Category' => 'Cable',
            'Price' => 2300, 'Quantity' => 62,
        ]);
        $response->assertStatus(302)->assertSessionHas('success','Product successfully created.')->assertRedirectToRoute('product.index');
    }
    public function test_can_manager_update_product_with_no_attributes(): void
    {
        $product = Product::factory()->create();
        $manager = User::factory()->manager()->create();
        $this->actingAs($manager);
        $response = $this->patch('/product/' . $product->id, [
            'Name' => 'Solarium Test',
            'Category' => 'Cable',
            'Price' => 2300, 'Quantity' => 62,
        ]);
        $response->assertStatus(302)->assertSessionHas('success','Product successfully updated.')->assertRedirectToRoute('product.index');
    }
}
