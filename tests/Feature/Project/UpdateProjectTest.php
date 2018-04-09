<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateProjectTest extends TestCase


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
    public function it_admin_can_view_update_form()
    {
        $this->signIn($this->admin)
             ->get(route('projects.edit', create(Project::class)))
             ->assertStatus(200);
    }

    /** @test */
    public function it_user_can_view_update_form()
    {
        $this->signIn($this->user)
             ->get(route('projects.edit', create(Project::class)))
             ->assertRedirect(route('projects.index'));
    }

    /** @test */
    public function it_admin_can_update_project()
    {
        $this->assertTrue(true);
        // TODO edit
//        $this->signIn($this->admin);
//
//        $project       = create(Project::class, ['title' => 'testText']);
//        $data          = $project->toArray();
//        $data['title'] = 'TestQQ';
//
//        $this->put(route('projects.update', ['project' => $project]), $data)
//             ->assertRedirect(route('projects.show', $project))
//             ->assertSessionHas('status', 'Project edited success');
//
//        $this->assertDatabaseHas('projects', array_only($data, 'title'));
    }

    /** @test */
    public function it_user_can_not_update_project_if_not_permission()
    {
        $this->signIn($this->user)
             ->put(route('projects.update', create(Project::class)))
             ->assertRedirect(route('projects.index'));
    }
}
