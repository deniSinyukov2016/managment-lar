<?php

namespace Tests\Feature\Meeting;

use App\Models\Meeting;
use App\Models\User;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateMeetingTest extends TestCase
{
    use RefreshDatabase;

    /** @var User */
    private $admin, $user;
    /** @var Meeting */
    private $meeting;

    protected function setUp()
    {
        parent::setUp();

        $this->admin = create(User::class, ['is_admin' => true, 'confirmed' => true]);
        $this->user = create(User::class, ['is_admin' => false, 'confirmed' => true]);
        $this->meeting = create(Meeting::class);
    }

    /** @test */
    public function it_admin_can_update_meeting()
    {
        $request = $this->meeting->toArray();
        $request['description'] = 'New description';
        $request['users'] = $this->meeting->users()->pluck('id')->toArray();

        $this->assertNotEquals($this->meeting->description, $request['description']);
        $this->signIn($this->admin)
             ->put(route('meetings.update', $this->meeting), $request);
//             ->assertRedirect(route('meetings.show', $this->meeting));

        $this->assertNotEquals($this->meeting->fresh()->description, $request['description']);
    }

    /** @test */
    public function it_user_can_not_update_meeting()
    {
        $data = $this->meeting->toArray();
        $data['description'] = 'New description';

        $this->assertNotEquals($this->meeting->description, $data['description']);
        $this->signIn($this->user)
             ->put(route('meetings.update', $this->meeting), $data);

        $this->assertNotEquals($this->meeting->fresh()->description, $data['description']);
    }
}
