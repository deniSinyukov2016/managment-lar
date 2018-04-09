<?php

namespace Tests\Feature\User;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteUserTest extends TestCase
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
    public function it_admin_can_delete_user()
    {

        $this->signIn($this->admin);

        $this->delete(route('users.destroy', create(User::class)))
             ->assertRedirect(route('users.index'))
             ->assertStatus(302);
    }

    /** @test */
    public function it_user_dont_can_delete_user()
    {
        $this->signIn($this->user);

        $this->delete(route('users.destroy', create(User::class)))
             ->assertRedirect(route('projects.index'));
    }

    /** @test */
    public function it_can_not_delete_if_unauthorized()
    {
        $this->delete(route('users.destroy', create(User::class)))
             ->assertRedirect('login');
    }
}
