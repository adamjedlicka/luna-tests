<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase, CreatesApplication;

    /**
     * @var \App\User
     */
    public $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->be($this->user);
    }

    /**
     * @param mixed $resource
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    public function resourceDetail($resource)
    {
        return $this->get(route('resources.show', [
            'resource' => (new \ReflectionClass($resource))->getShortName(),
            'resourceKey' => $resource->getKey(),
        ]));
    }

    /**
     * @param mixed $resource
     * @param string $relationship
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    public function resourceHasMany($resource, string $relationship)
    {
        return $this->get(route('resources.hasMany', [
            'resource' => (new \ReflectionClass($resource))->getShortName(),
            'resourceKey' => $resource->getKey(),
            'relationship' => $relationship,
        ]));
    }
}
