<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        factory(\App\Category::class)->create();
        factory(\App\Product::class, 5)->create();

        $response = $this->withHeader('Authorization', 'Basic YWRtaW5AZW1haWwuY29tOnBhc3N3b3Jk')
            ->json('GET', '/api/categories/11/products');

        $response->assertOk();
        $response->assertJsonCount(5);
    }

    public function testCreate()
    {
        $name = 'NewName';
        factory(\App\Category::class)->create();
        $response = $this->withHeader('Authorization', 'Basic YWRtaW5AZW1haWwuY29tOnBhc3N3b3Jk')
            ->json('POST', '/api/categories/12/products', ['name' => $name]);

        $response->assertSuccessful();
        $response->assertSeeText($name);
    }

    public function testShow()
    {
        $name = 'NewName';
        factory(\App\Category::class)->create();
        factory(\App\Product::class)->create(['name' => $name]);
        $response = $this->withHeader('Authorization', 'Basic YWRtaW5AZW1haWwuY29tOnBhc3N3b3Jk')
            ->json('GET', '/api/categories/13/products/7');

        $response->assertOk();
        $response->assertSeeText($name);
    }

    public function testUpdate()
    {
        $name = 'NewName';
        factory(\App\Category::class)->create();
        factory(\App\Product::class)->create();
        $response = $this->withHeader('Authorization', 'Basic YWRtaW5AZW1haWwuY29tOnBhc3N3b3Jk')
            ->json('PUT', '/api/categories/14/products/8', ['name' => $name]);

        $response->assertSuccessful();
        $response->assertSeeText($name);
    }

    public function testDestroy()
    {
        factory(\App\Category::class)->create();
        factory(\App\Product::class, 2)->create();
        $response = $this->withHeader('Authorization', 'Basic YWRtaW5AZW1haWwuY29tOnBhc3N3b3Jk')
            ->json('DELETE', '/api/categories/15/products/9');

        $response->assertSuccessful();
        $response->assertJsonCount(1);
    }

    public function testLast()
    {
        $this->resetAutoIncrement();
        $this->assertTrue(true);
    }

    private function resetAutoIncrement()
    {
        $maxCatId = \App\Category::max('id');
        $maxProdId = \App\Product::max('id');
        \DB::statement('ALTER TABLE categories AUTO_INCREMENT=' . intval($maxCatId + 1) . ';');
        \DB::statement('ALTER TABLE products AUTO_INCREMENT=' . intval($maxProdId + 1) . ';');
    }
}
