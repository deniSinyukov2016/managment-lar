<?php

namespace Tests\Feature\Comment;

use App\Models\Comment;
use App\Models\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddCommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_user_can_view_creating_comment_form_on_project_page()
    {
        $project = create(Project::class);

        $this->signIn()
             ->get(route('projects.show', $project))
             ->assertSee('Send days comment');
    }

    /** @test */
    public function it_user_can_add_days_comment()
    {
        $project = create(Project::class);

        $this->signIn()
             ->post(route('comments.store', $project), $comment = [
                 'workTime' => 8,
                 'body'     => 'Days comment who say what I do on this project all day.'
             ])->assertSessionHas('status', 'Comment success created!')
             ->assertRedirect(route('projects.show', $project));

        $comment = Comment::query()
                          ->where($comment)
                          ->where('user_id', auth()->id())
                          ->where('project_id', $project->id)
                          ->first();

        $this->assertTrue($comment->exists);
    }

    /** @test */
    public function it_can_not_add_comment_if_unauthorized()
    {
        $this->get(route('projects.show', create(Project::class)))
             ->assertRedirect('login');
    }
}
