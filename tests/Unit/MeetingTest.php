<?php

namespace Tests\Unit;

use App\Models\Meeting;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MeetingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_creator()
    {
        /** @var Meeting $meeting */
        $meeting = create(Meeting::class);

        $this->assertInstanceOf(User::class, $meeting->creator);
        $this->assertTrue($meeting->creator->exists);
    }

    /** @test */
    public function it_has_project()
    {
        /** @var Meeting $meeting */
        $meeting = create(Meeting::class);

        $this->assertInstanceOf(Project::class, $meeting->project);
        $this->assertTrue($meeting->project->exists);
    }

    /** @test */
    public function it_can_add_users_to_meetings()
    {
        /** @var Meeting $meeting */
        $meeting = create(Meeting::class);
        /** @var User $user */
        $user = create(User::class);

        $meeting->users()->attach($user);
        $this->assertEquals(1, $meeting->fresh()->users()->count());

        /** @var User $user */
        $user = create(User::class);
        $meeting->users()->attach($user);
        $this->assertEquals(2, $meeting->fresh()->users()->count());
    }

    /** @test */
    public function it_can_not_attach_one_user_many_points_to_one_meeting()
    {
        $this->expectException(QueryException::class);

        /** @var Meeting $meeting */
        $meeting = create(Meeting::class);
        /** @var User $user */
        $user = create(User::class);

        $meeting->users()->attach($user);
        $meeting->users()->attach($user);
    }
}
