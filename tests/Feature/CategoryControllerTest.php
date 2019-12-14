<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $categories = factory(\App\Category::class, 5)->create()->toArray();
        usort($categories, function ($first, $second) {
            return $first['order'] <=> $second['order'];
        });
        $name = array_column($categories, 'name');

        $response = $this->withHeader('Authorization', 'Basic YWRtaW5AZW1haWwuY29tOnBhc3N3b3Jk')
            ->json('GET', '/api/categories');

        $response->assertOk();
        $response->assertJsonCount(5);
        $response->assertSeeTextInOrder($name);
    }

    public function testCreate()
    {
        $name = 'NewName';
        $response = $this->withHeader('Authorization', 'Basic YWRtaW5AZW1haWwuY29tOnBhc3N3b3Jk')
            ->json('POST', '/api/categories', ['name' => $name, 'order' => 1]);

        $response->assertSuccessful();
        $response->assertSeeText($name);
    }

    public function testShow()
    {
        $name = 'NewName';
        factory(\App\Category::class)->create(['name' => $name]);
        $response = $this->withHeader('Authorization', 'Basic YWRtaW5AZW1haWwuY29tOnBhc3N3b3Jk')
            ->json('GET', '/api/categories/7');

        $response->assertOk();
        $response->assertSeeText($name);
    }

    public function testUpdate()
    {
        $name = 'NewName';
        factory(\App\Category::class)->create();
        $response = $this->withHeader('Authorization', 'Basic YWRtaW5AZW1haWwuY29tOnBhc3N3b3Jk')
            ->json('PUT', '/api/categories/8', ['name' => $name, 'order' => 1]);

        $response->assertSuccessful();
        $response->assertSeeText($name);
    }

    public function testDestroy()
    {
        factory(\App\Category::class, 2)->create();
        $response = $this->withHeader('Authorization', 'Basic YWRtaW5AZW1haWwuY29tOnBhc3N3b3Jk')
            ->json('DELETE', '/api/categories/9');

        $response->assertSuccessful();
        $response->assertJsonCount(1);
    }
}
