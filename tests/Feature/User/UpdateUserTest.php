<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateUserTest extends TestCase
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
    public function it_admin_can_view_user_form()
    {
        $this->signIn($this->admin)
             ->get(route('users.edit', create(User::class)))
             ->assertStatus(200);
    }

    /** @test */
    public function it_admin_can_update_user()
    {
        $this->signIn($this->admin);

        $user = create(User::class, ['email' => 'first@doe.com']);

        $this->put(route('users.update', ['user' => $user, 'email' => 'second@mail.ru']))
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
                'email' => 'second@mail.ru'
            ]
        );
    }

    /** @test */
    public function it_user_can_view_update_form()
    {
        $this->signIn($this->user)
             ->get(route('users.edit', create(User::class)))
             ->assertRedirect(route('projects.index'));
    }

    /** @test */
    public function it_user_can_not_update_project_if_not_permission()
    {
        $this->signIn($this->user)
             ->put(route('users.update', create(User::class)))
             ->assertRedirect(route('projects.index'));
    }
}
