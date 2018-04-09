<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewUserTest extends TestCase
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
    public function it_admin_can_view_users_lists()
    {
        $this->signIn($this->admin)
             ->get(route('users.index'))
             ->assertSuccessful();
    }

    /** @test */
    public function it_user_can_view_users_lists()
    {
        $this->signIn($this->user)
             ->get(route('users.index'))
             ->assertRedirect(route('projects.index'));
    }

    public function it_user_not_authorized()
    {
        $this->get(route('users.index'))
             ->assertStatus(401);
    }
}
