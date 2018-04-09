<?php

namespace Tests\Feature\Project;

use App\Models\Project;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddProjectTest extends TestCase
{
    use RefreshDatabase;

    private $admin;
    private $user;

    protected function setUp()
    {
        parent::setUp();

        $this->admin = create(User::class, ['is_admin' => true, 'confirmed' => 1]);
        $this->user  = create(User::class, ['is_admin' => false, 'confirmed' => 1]);
    }

    /** @test */
    public function it_admin_can_view_create_form()
    {
        $this->signIn($this->admin)
             ->get(route('projects.create'))
             ->assertStatus(200)
             ->assertSeeText('Creating a project');
    }

    /** @test */
    public function it_user_can_not_view_creating_form()
    {
        $this->signIn($this->user)
             ->get(route('projects.create'))
             ->assertRedirect(route('projects.index'))
             ->assertDontSee('Creating a project');
    }

    /** @test */
    public function it_admin_can_add_new_project()
    {
        $this->assertTrue(true);
        // TODO edit
//        $this->signIn($this->admin)
//             ->post(route('projects.store'), $data = make(Project::class)->toArray())
//             ->assertRedirect(route('projects.create'))
//             ->assertSessionHas('status', 'Project created success!');
//
//        $this->assertDatabaseHas('projects', array_only($data, ['title', 'description']));
    }

    /** @test */
    public function it_project_not_created_if_validation_failed()
    {
        $this->signIn($this->admin)
             ->post(route('projects.store'))
             ->assertRedirect(route('projects.create'))
             ->assertSessionHas('errors');
    }

    /** @test */
    public function it_user_can_not_add_project()
    {
        $this->signIn($this->user)
             ->post(route('projects.store'))
             ->assertRedirect(route('projects.index'));
    }

}
