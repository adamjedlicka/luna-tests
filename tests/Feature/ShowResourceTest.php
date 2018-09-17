<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class ShowResourceTest extends TestCase
{
    public function testSingleResourceCanBeShown()
    {
        $user = factory(User::class)->create();

        $response = $this->resourceDetail($user);

        $response->assertJsonFragment([
            'value' => $user->getKey(),
        ]);
    }

    public function testOnlyRequestedResourceIsShown()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $response = $this->resourceDetail($user1);

        $response->assertJsonFragment([
            'value' => $user1->getKey(),
        ]);

        $response->assertJsonMissing([
            'value' => $user2->getKey()
        ]);
    }
}
