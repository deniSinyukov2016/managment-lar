<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteProjectTest extends TestCase
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
    public function it_admin_can_delete_project()
    {
        $this->signIn($this->admin);

        $this->delete(route('projects.destroy', create(Project::class)))
             ->assertRedirect(route('projects.index'))
             ->assertSessionHas('status', 'Project success deleted!')
             ->assertStatus(302);
    }

    /** @test */
    public function it_user_can_delete_project()
    {
        $this->signIn($this->user);

        $this->delete(route('projects.destroy', create(Project::class)))
             ->assertRedirect(route('projects.index'));
    }

    /** @test */
    public function it_can_not_delete_if_unauthorized()
    {
        $this->delete(route('projects.destroy', create(Project::class)))
             ->assertRedirect('login');
    }
}
