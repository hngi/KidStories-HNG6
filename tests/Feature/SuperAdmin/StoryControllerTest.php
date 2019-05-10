<?php

namespace Tests\Feature\SuperAdmin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StoryControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected function signIn($user = null)
    {
        $admin = $user ?: factory('App\Admin')->create();

        $this->actingAs($admin);

        return $this;
    }

    function test_that_an_authorised_user_can_create_a_story()
    {
        //$user = factory('App\User')->states('unconfirmed')->create();
        $this->withExceptionHandling();

        $this->signIn();

        $story = factory('App\Story')->make();

        $response = $this->post(route('admin.stories.store'), $story->toArray());

        dd($response);
           
    }
}