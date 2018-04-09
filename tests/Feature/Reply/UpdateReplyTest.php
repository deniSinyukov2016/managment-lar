<?php

namespace Tests\Feature;

use App\Models\Idea;
use App\Models\Reply;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateReplyTest extends TestCase
{
    use RefreshDatabase;

    private $admin;
    private $user;

    protected function setUp()
    {
        parent::setUp();

        $this->admin = create(User::class, ['is_admin' => true, 'confirmed' => 1]);
        $this->user = create(User::class, ['is_admin' => false, 'confirmed' => 1]);
    }

    /** @test */
    public function it_admin_can_view_update_form()
    {
        $this->signIn($this->admin)
             ->get(route('reply.edit', create(Reply::class)))
             ->assertSuccessful();
    }

    /** @test */
    public function it_admin_can_update_any_replies()
    {
        $this->signIn($this->admin);
        $user = create(User::class);
        /** @var Idea $idea */
        $idea  = create(Idea::class, ['user_id' => $user->id]);
        $reply = $idea->replies()->create(['user_id' =>  $user->id, 'body' => 'content']);

        $this->put(route('reply.update', ['reply' => $reply,'body' => 'Test']))
             ->assertSessionHas('status', 'Reply was successfully updated!');

        $this->assertDatabaseHas('replies', [
                'body' => 'Test'
            ]
        );
    }

    /** @test */
    public function it_user_can_update_any_replies()
    {
        $this->signIn($this->user);
        $user = create(User::class);
        /** @var Idea $idea */
        $idea  = create(Idea::class, ['user_id' => $user->id]);
        $reply = $idea->replies()->create(['user_id' =>  $user->id, 'body' => 'content']);

        $this->put(route('reply.update', ['replies' => $reply,'body' => 'Test']))
        ->assertSessionMissing('status');
    }
}
