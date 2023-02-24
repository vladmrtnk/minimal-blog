<?php

namespace Tests\Feature\API\V1;

use App\Models\Blog\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogCategoryTest extends TestCase
{
    use RefreshDatabase;

    private string $url = '/api/v1/blog/categories/';

    public function test_status()
    {
        $response = $this->get($this->url);

        $response->assertOk();
    }

    public function test_get_single_entity()
    {
        $entity = Category::factory()->create();

        $response = $this->get($this->url . $entity->id);

        $response->assertOk();

        $response->assertJsonPath('data.title', $entity->title);
    }

    public function test_create_new_entity()
    {
        $response = $this->post($this->url, [
            'title'     => 'Test String 2288',
            'slug'      => 'test-string-2288',
            'parent_id' => 1
        ]);

        $response->assertCreated();
    }

    public function test_update_entity()
    {
        $response = $this->put($this->url . 1, [
            'title'     => 'Test String Changed',
        ]);

        $response->assertStatus(202);
    }

    public function test_delete_entity()
    {
        $response = $this->delete($this->url . 1);

        $response->assertOk();
    }
}
