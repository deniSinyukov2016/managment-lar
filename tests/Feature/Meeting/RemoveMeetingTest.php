<?php

namespace Tests\Feature\Meeting;

use App\Models\Meeting;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RemoveMeetingTest extends TestCase
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
    public function it_admin_can_remove_meeting()
    {
        $this->signIn($this->admin)
             ->delete(route('meetings.destroy', $this->meeting))
             ->assertSessionHas('status', 'Meeting successfully destroy!');

        $this->assertFalse(Meeting::query()->whereKey($this->meeting->id)->exists());
    }

    /** @test */
    public function it_user_can_not_destroy_meeting()
    {
        $this->signIn($this->user)
             ->delete(route('meetings.destroy', $this->meeting));

        $this->assertTrue(Meeting::query()->whereKey($this->meeting->id)->exists());
    }
}
