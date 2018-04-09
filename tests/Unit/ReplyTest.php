<?php

namespace Tests\Unit;

use App\Models\Idea;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    /** @var  Idea */
    private $idea;

    /** @var  User */
    private $user;

    protected function setUp()
    {
        parent::setUp();

        $this->idea = create(Idea::class);
        $this->user = create(User::class);
    }

    /** @test */
    public function it_idea_can_be_replied()
    {
        $this->assertCount(0, $this->idea->replies);

        $this->idea->replies()->create($reply = [
            'body'    => 'Idea reply text',
            'user_id' => $this->user->id
        ]);

        $this->assertCount(1, $this->idea->fresh()->replies);
        $this->assertTrue($this->idea->replies()->where($reply)->exists());
    }
}
