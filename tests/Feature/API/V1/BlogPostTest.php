<?php

namespace Tests\Feature\API\V1;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogPostTest extends TestCase
{
    use RefreshDatabase;

    public function test_status()
    {
        $response = $this->get('/api/post');

        $response->assertOk();
    }

    public function test_single_post_has_data()
    {
        $post = BlogPost::factory()->create([
            'title' => 'Test 228'
        ]);

        $response = $this->get("/api/post/{$post->id}");

        $response->assertOk();

        $response->assertJsonPath('data.title', $post->title);
    }

    public function test_collection_posts_has_data()
    {
        $response = $this->get('/api/post');

        $response->assertOk();
    }
}
