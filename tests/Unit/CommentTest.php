<?php


namespace Tests\Unit;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * A comment can be stored.
     * @test
     * @group comment
     * @return void
     */
    public function a_comment_can_be_stored()
    {
        $this->withoutExceptionHandling();

        $comment = Comment::factory()->make();

        $response = $this->post(route('comment.add'), $comment->toArray());

        $this->assertDatabaseHas('comments', [
            'user_name' => $comment->user_name,
            'reply_id' => $comment->reply_id,
            'level' => $comment->level,
            'text' => $comment->text,
        ]);
    }

    /**
     * Check required fields.
     * @test
     * @group comment
     * @return void
     */
    public function a_comment_requires_required_fields()
    {
        $response = $this->post(route('comment.add'), []);
        $response->assertSessionHasErrors('user_name');
        $response->assertSessionHasErrors('text');
        $response->assertSessionHasErrors('level');
    }
}
