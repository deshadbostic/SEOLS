<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;

class ProductAdminTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test if an admin can view products.
     */
    public function test_can_admin_view_products(): void
    {
        // Create an admin user
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin); // Authenticate as admin
        $response = $this->get('/product'); // Send a GET request to view products
        $response->assertStatus(200); // Assert that the response status is 200 (OK)
        ob_end_clean();
    }
    /**
     * Test if an admin can store a product with attributes.
     */
    public function test_can_admin_store_product_with_attributes(): void
    {
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin);
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
        $response->assertStatus(302)->assertSessionHas('success', 'Product successfully created.')->assertRedirectToRoute('product.index');
    }
    /**
     * Test if an admin can create a product.
     */
    public function test_can_admin_create_product(): void
    {
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin);
        $response = $this->get('/product/create');
        $response->assertStatus(200);
    }
    /**
     * Test if an admin can view a product.
     */
    public function test_can_admin_view_product(): void
    {
        $product = Product::factory()->create();
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin);
        $response = $this->get('/product/' . $product->id);
        $response->assertStatus(200);
        $response->assertSeeText($product->name);
    }
    /**
     * Test if an admin can update a product with attributes.
     */
    public function test_can_admin_update_product_with_attributes(): void
    {
        $product = Product::factory()->create();
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin);
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
        $response->assertStatus(302)->assertSessionHas('success', 'Product successfully updated.')->assertRedirectToRoute('product.index');
    }
    /**
     * Test if an admin can delete a product.
     */
    public function test_can_admin_delete_product(): void
    {
        $product = Product::factory()->create();
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin);
        $response = $this->delete('/product/' . $product->id);
        $response->assertStatus(302)->assertSessionHas('success', 'Product successfully deleted.');
    }
    /**
     * Test if an admin can edit a product.
     */
    public function test_can_admin_edit_product(): void
    {
        $product = Product::factory()->create();
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin);
        $response = $this->get('/product/' . $product->id . '/edit/');
        $response->assertStatus(200);
        $response->assertSeeText($product->name);
        ob_end_clean();
    }
    /**
     * Test if an admin can store a product without attributes.
     */
    public function test_can_admin_store_product_with_no_attributes(): void
    {
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin);
        $response = $this->post('/product', [
            'Name' => 'Solarium Test',
            'Category' => 'Cable',
            'Price' => 2300, 'Quantity' => 62,
        ]);
        $response->assertStatus(302)->assertSessionHas('success', 'Product successfully created.')->assertRedirectToRoute('product.index');
    }
    /**
     * Test if an admin can update a product without attributes.
     */
    public function test_can_admin_update_product_with_no_attributes(): void
    {
        $product = Product::factory()->create();
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin);
        $response = $this->patch('/product/' . $product->id, [
            'Name' => 'Solarium Test',
            'Category' => 'Cable',
            'Price' => 2300, 'Quantity' => 62,
        ]);
        $response->assertStatus(302)->assertSessionHas('success', 'Product successfully updated.')->assertRedirectToRoute('product.index');
    }
}
