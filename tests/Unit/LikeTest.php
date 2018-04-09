<?php

namespace Tests\Unit;

use App\Models\Idea;
use App\Models\User;
use App\Pivot\Like;
use Illuminate\Database\QueryException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_idea_may_be_liked_by_user()
    {
        /** @var User $user */
        $user = create(User::class);
        /** @var Idea $idea */
        $idea = create(Idea::class);

        $idea->like($user);

        $this->assertEquals(1, $idea->likes()->count());
        $this->assertTrue($idea->likes()->where(['user_id' => $user->id])->exists());
    }

    /** @test */
    public function it_entity_can_be_liked_once()
    {
        $this->expectException(\Exception::class);

        /** @var User $user */
        $user = create(User::class);
        /** @var Idea $idea */
        $idea = create(Idea::class);

        $idea->like($user);
        $idea->like($user);
    }

    /** @test */
    public function it_can_remove_like()
    {
        /** @var User $user */
        $user = create(User::class);
        /** @var Idea $idea */
        $idea = create(Idea::class);

        $idea->like($user);
        $this->assertEquals(1, $idea->likes()->count());

        $idea->unlike($user);
        $this->assertEquals(0, $idea->likes()->count());
    }

    /** @test */
    public function it_throw_exception_if_create_like_without_like_function()
    {
        $this->expectException(QueryException::class);

        /** @var User $user */
        $user = create(User::class);
        /** @var Idea $idea */
        $idea = create(Idea::class);

        $idea->like($user);

        Like::query()->create([
            'user_id' => $user->id,
            'likable_id' => $idea->id,
            'likable_type' => 'ideas'
        ]);
    }
}
