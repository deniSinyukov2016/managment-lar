<?php

namespace Tests\Feature;

use App\Models\Idea;
use App\Models\Reply;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteReplyTest extends TestCase
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
    public function it_admin_can_delete_reply()
    {
        $this->signIn($this->admin);

        $this->delete(route('reply.destroy', create(Reply::class)))
             ->assertSessionHas('status', 'Reply was successfully deleted!')
             ->assertStatus(302);
    }

    /** @test */
    public function it_admin_can_delete_any_replies()
    {
        $this->signIn($this->admin);
        $user = create(User::class);
        /** @var Idea $idea */
        $idea  = create(Idea::class, ['user_id' => $user->id]);
        $reply = $idea->replies()->create(['user_id' =>  $user->id, 'body' => 'content']);

        $this->delete(route('reply.destroy', $reply))
             ->assertSessionHas('status','Reply was successfully deleted!');
    }

    /** @test */
    public function it_user_can_delete_any_replies()
    {
        $this->signIn($this->user);
        $user = create(User::class);
        /** @var Idea $idea */
        $idea  = create(Idea::class, ['user_id' => $user->id]);
        $reply = $idea->replies()->create(['user_id' =>  $user->id, 'body' => 'content']);

        $this->delete(route('reply.destroy', $reply))
             ->assertSessionMissing('status');
    }

    /** @test */
    public function it_can_not_delete_if_unauthorized()
    {
        $this->delete(route('reply.destroy', create(Reply::class)))
             ->assertRedirect('login');
    }
}
