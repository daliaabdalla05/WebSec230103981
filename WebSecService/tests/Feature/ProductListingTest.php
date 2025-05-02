<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;

class ProductListingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_products_on_the_products_page()
    {
        $product = Product::factory()->create(['name' => 'Test Product']);

        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertSee('Test Product');
    }
} 