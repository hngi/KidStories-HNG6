<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CommentControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_that_an_authorised_user_can_comment_a_story()
    {
        $token = $this->authenticate();

        $comment = factory('App\Comment')->make();

        $response = $this->json(
            'POST',
            'api/v1/comments',
            $comment->toArray(),
            ['Authorization' => 'Bearer '. $token]
        );

        $response->assertStatus(201);

    }

    public function test_that_an_authorised_user_can_update_a_story_comment()
    {
        $token = $this->authenticate();

        $comment = factory('App\Comment')->create();

        $makeComment = factory('App\Comment')->make();

        $response = $this->json(
            'PUT',
            'api/v1/comments/'.$comment->id,
            $makeComment->toArray(),
            ['Authorization' => 'Bearer '. $token]
        );

        $response->assertStatus(201);

    }

    public function test_that_an_authorised_user_can_delete_a_story_comment()
    {
        $token = $this->authenticate();

        $comment = factory('App\Comment')->create();

        $response = $this->json(
            'DELETE',
            'api/v1/comments/'.$comment->id,
            [],['Authorization' => 'Bearer '. $token]
        );

        $response->assertStatus(204);

    }
}
