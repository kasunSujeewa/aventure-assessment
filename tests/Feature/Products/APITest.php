<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class APITest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     */
    public function test_get_all_products_api(): void
    {
        $response = $this->get('/api/products');

        $response->assertStatus(200);
    }
    public function test_show_products_api(): void
    {
        $response = $this->get('/api/products/{id}');

        $response->assertStatus(200);
    }
    public function test_post_products_api(): void
    {
        $response = $this->post('/api/products', ['title' => 'test data']);

        $response->assertStatus(201);
    }
    public function test_update_products_api(): void
    {
        $product = Product::create(['title' => 'test data']);
        $response = $this->put('/api/products/' . $product->id, ['title' => 'test data 2']);

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has(
                'data',
                fn (AssertableJson $json) =>
                $json->where('title', 'test data 2')
                    ->etc()
            )
                ->etc()
        );
    }
    public function test_delete_products_api(): void
    {
        $product = Product::create(['title' => 'test data']);
        $response = $this->delete('/api/products/' . $product->id);

        $response->assertStatus(200);
    }
}
