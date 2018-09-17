<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Post;

class HasManyTest extends TestCase
{
    public function testHasManyFieldOnlyDisplaysCorespondingResources()
    {
        $user1 = factory(User::class)->create();
        $post1 = factory(Post::class)->create([
            'user_id' => $user1->id,
        ]);

        $user2 = factory(User::class)->create();
        $post2 = factory(Post::class)->create([
            'user_id' => $user2->id,
        ]);

        $response = $this->resourceHasMany($user1, 'posts');

        $response->assertJsonFragment([
            'value' => $post1->title,
        ]);

        $response->assertJsonMissing([
            'value' => $post2->title,
        ]);
    }
}
