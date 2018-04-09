<?php

namespace Tests\Feature\Idea;

use App\Models\Idea;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewIdeaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_user_can_view_idea_lists()
    {
        $this->signIn()
             ->get(route('idea.index'))
             ->assertSuccessful();
    }

    /** @test */
    public function it_can_view_one_idea()
    {
        $idea = create(Idea::class);

        $this->signIn()
             ->get(route('idea.show', $idea))
             ->assertSee($idea->title)
             ->assertSee($idea->description)
             ->assertSee($idea->user->name);
    }

    /** @test */
    public function it_watch_idea_if_admin_open_single_idea_page()
    {
        /** @var Idea $idea */
        $idea = create(Idea::class, ['status' => 'NOT_WATCHED']);
        $this->assertTrue($idea->notWatched());

        $this->signIn(create(User::class, ['is_admin' => true, 'confirmed' => true]))
             ->get(route('idea.show', $idea));

        $this->assertFalse($idea->fresh()->notWatched());
    }


}
