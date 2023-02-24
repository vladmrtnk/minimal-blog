<?php

namespace Tests\Feature\API\V1;

use App\Models\Blog\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogPostTest extends TestCase
{
    use RefreshDatabase;

    private string $url = '/api/v1/blog/posts/';

    public function test_status()
    {
        $response = $this->get('/');

        $response->assertOk();
    }

    public function test_get_single_entity()
    {
        $entity = Post::factory()->create();

        $response = $this->get($this->url . $entity->id);

        $response->assertOk();

        $response->assertJsonPath('data.title', $entity->title);
    }

    public function test_create_new_entity()
    {
        $user = User::factory()->create();

        $response = $this
            ->post($this->url, [
                'category_id'  => 1,
                'user_id'      => $user->id,
                'title'        => 'Test Post Example',
                'content_raw'  => 'Raw content, example.',
                'content_html' => 'Html content <p>example</p>',
                'is_published' => true,
                'published_at' => Carbon::now()
            ]);

        $response->assertCreated();
    }

    public function test_update_entity()
    {
        $user = User::factory()->create();

        $response = $this
            ->put($this->url . 1, [
                'category_id'  => 1,
                'user_id'      => $user->id,
                'title'        => 'Test String Changed',
                'content_raw'  => 'Raw content, example.',
                'content_html' => 'Html content <p>example</p>',
                'is_published' => true,
                'published_at' => Carbon::now()
            ]);

        $response->assertStatus(202);
    }

    public function test_delete_entity()
    {
        $response = $this->delete($this->url . 1);

        $response->assertOk();
    }
}
