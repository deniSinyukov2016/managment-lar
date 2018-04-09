<?php

namespace Tests\Feature\Meeting;

use App\Http\Middleware\AdminMiddleware;
use App\Models\Meeting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddMeetingTest extends TestCase
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
    public function it_admin_can_view_create_form()
    {
        $this->signIn($this->admin)
             ->get(route('meetings.create'))
             ->assertStatus(200)
             ->assertSee('Create meeting');
    }

    /** @test */
    public function it_user_can_not_view_create_form()
    {
        $this->signIn($this->user)
             ->get(route('meetings.create'))
             ->assertRedirect(route('projects.index'))
             ->assertSessionHas(AdminMiddleware::SESSION_KEY, AdminMiddleware::SESSION_MESSAGE);
    }

    /** @test */
    public function admin_can_store_meeting()
    {
        /** @var Meeting $meeting */
        $meeting = make(Meeting::class, ['date_time' => Carbon::now()->addMonth()->toDateTimeString()]);

        /** @var Collection $users */
        $users = create(User::class, [], 3);
        $request = $meeting->toArray();
        $request['users'] = $users->pluck('id')->toArray();

        $this->signIn($this->admin)
             ->post(route('meetings.store'), $request)
             ->assertSessionHas('status', 'Meeting successfully add!')
             ->assertRedirect(route('projects.show', $meeting->project));

        $this->assertTrue(Meeting::query()->where('name', $meeting->name)->exists());
        $this->assertCount(3, Meeting::query()->where('name', $meeting->name)->first()->users);
    }

    /** @test */
    public function it_user_can_not_store_meeting()
    {
        $this->signIn($this->user)
             ->post(route('meetings.store'))
             ->assertRedirect(route('projects.index'))
             ->assertSessionHas(AdminMiddleware::SESSION_KEY, AdminMiddleware::SESSION_MESSAGE);
    }
}
