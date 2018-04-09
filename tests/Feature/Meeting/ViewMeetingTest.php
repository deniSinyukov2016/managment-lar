<?php

namespace Tests\Feature\Meeting;

use App\Models\Meeting;
use App\Models\Project;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewMeetingTest extends TestCase
{
    use RefreshDatabase;

    /** @var User */
    private $admin, $user;

    protected function setUp()
    {
        parent::setUp();

        $this->admin = create(User::class, ['is_admin' => true, 'confirmed' => true]);
        $this->user = create(User::class, ['is_admin' => false, 'confirmed' => true]);
    }

    /** @test */
    public function it_user_can_not_view_meeting_which_not_attach_him()
    {
        $meeting = create(Meeting::class, ['date_time' => now()->addHour()]);

        $this->signIn($this->user)
             ->get(route('meetings.show', $meeting))
             ->assertStatus(403);
    }

    /** @test */
    public function admin_can_view_any_meeting()
    {
        $meeting = create(Meeting::class, ['date_time' => now()->addHour()]);

        $this->signIn($this->admin)
             ->get(route('meetings.show', $meeting))
             ->assertStatus(200)
             ->assertSeeText($meeting->name);
    }

    /** @test */
    public function it_user_can_view_meeting_if_will_attach()
    {
        $meeting = create(Meeting::class, ['date_time' => now()->addHour()]);
        $meeting->users()->attach($this->user);

        $this->signIn($this->user)
             ->get(route('meetings.show', $meeting))
             ->assertStatus(200)
             ->assertSeeText($meeting->name);
    }
}
