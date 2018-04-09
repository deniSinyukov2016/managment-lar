<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewProjectTest extends TestCase
{
    use RefreshDatabase;

    private $admin;
    private $user;

    protected function setUp()
    {
        parent::setUp();

        $this->admin = create(User::class, ['is_admin' => true, 'confirmed' => 1]);
        $this->user  = create(User::class, ['is_admin' => false, 'confirmed' => 1]);
    }

    /** @test */
    public function it_user_can_view_project_lists()
    {
        $this->signIn();
        $this->get(route('projects.index'))
             ->assertStatus(200);
    }

    public function it_user_not_authorized()
    {
        $this->get(route('projects.index'))
             ->assertStatus(401);
    }

    /** @test */
    public function it_can_view_one_project()
    {
        $project = create(Project::class);

        $this->signIn()
             ->get(route('projects.show', $project))
             ->assertStatus(200)
             ->assertSee($project->title)
             ->assertSee($project->description);
    }

    /** @test */
    public function it_admin_can_view_one_project()
    {
        $project = create(Project::class);

        $this->signIn($this->admin)
             ->get(route('projects.show', $project))
             ->assertStatus(200)
             ->assertSee($project->title)
             ->assertSee($project->description);
    }

    /** @test */
    public function it_admin_can_show_all_comments()
    {
        $this->signIn($this->admin);

        /** @var Project $project */
        $project = create(Project::class);
        $project->comments()->createMany(make(Comment::class, [], 2)->toArray());

        $this->get(route('projects.show', $project))
             ->assertSeeText($project->comments[1]->body)
             ->assertSeeText($project->comments[0]->body);
    }

    /** @test */
    public function it_user_dont_can_see_all_comments_by_project()
    {
        $this->signIn($this->user);

        $project = create(Project::class);
        $commentSee = $project->comments()->create(make(Comment::class, ['user_id' => auth()->id()])->toArray());
        $commentNotSee = $project->comments()->createMany(make(Comment::class, [], 3)->toArray());

        $this->get(route('projects.show', $project))
             ->assertSeeText($commentSee->body)
             ->assertDontSee($commentNotSee[0]->body)
             ->assertDontSee($commentNotSee[1]->body)
             ->assertDontSee($commentNotSee[2]->body);
    }
}
