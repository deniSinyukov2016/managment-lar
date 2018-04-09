<?php

namespace Tests\Feature\Idea;

use App\Models\Idea;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikeIdeaTest extends TestCase
{
    use RefreshDatabase;

    /** @var  Idea */
    private $idea;

    protected function setUp()
    {
        parent::setUp();

        $this->idea = create(Idea::class);
    }

    /** @test */
    public function it_idea_may_be_liked_by_auth_user()
    {
        $this->signIn()->post(url('like/idea/' . $this->idea->id));

        $this->assertTrue($this->idea->likes()->where(['user_id' => auth()->id()])->exists());
    }
}
