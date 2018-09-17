<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ShowResourceTest extends TestCase
{
    public function testSingleResourceCanBeShown()
    {
        $user = factory(User::class)->create();

        $response = $this->get(route('resources.show', [
            'resource' => 'User',
            'resourceKey' => $user->getKey(),
        ]));

        $response->assertJsonFragment([
            'value' => $user->getKey(),
        ]);
    }

    public function testOnlyRequestedResourceIsShown()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $response = $this->get(route('resources.show', [
            'resource' => 'User',
            'resourceKey' => $user1->getKey(),
        ]));

        $response->assertJsonFragment([
            'value' => $user1->getKey(),
        ]);

        $response->assertJsonMissing([
            'value' => $user2->getKey()
        ]);
    }
}
