<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use AdamJedlicka\Luna\Facades\Resources;

class BelongsToTest extends TestCase
{
    public function testBelongsToFieldDisplaysRelevantResource()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $post = factory(Post::class)->create([
            'user_id' => $user1->id,
        ]);

        $response = $this->resourceDetail($post, 'user');

        $response->assertJsonFragment([
            'title' => Resources::forModel($user1)->title(),
        ]);

        $response->assertJsonMissing([
            'title' => Resources::forModel($user2)->title(),
        ]);
    }
}
