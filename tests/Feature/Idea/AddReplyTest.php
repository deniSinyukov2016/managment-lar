<?php

namespace Tests\Feature\Idea;

use App\Models\Idea;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddReplyTest extends TestCase
{
    use RefreshDatabase;

    /** @var  Idea */
    private $idea;

    protected function setUp()
    {
        parent::setUp();

        $this->signIn();
        $this->idea = create(Idea::class);
    }

    /** @test */
    public function it_can_add_reply_to_idea()
    {
        $this->assertCount(0, $this->idea->replies);

        $this->post(route('reply.store', ['idea', $this->idea->id]), ['body' => 'Super text!']);

        $this->assertCount(1, $this->idea->fresh()->replies);
    }
}
