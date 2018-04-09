<?php

namespace Tests\Feature\Idea;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddIdeaTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp()
    {
        parent::setUp();

        $this->user = create(User::class, ['is_admin' => false, 'confirmed' => 1]);
    }

    /** @test */
    public function it_user_can_view_creating_feature_form()
    {
        $this->signIn($this->user)
             ->get(route('idea.create'))
             ->assertStatus(200)
             ->assertSeeText('Add idea to project :)');
    }

    /** @test */
    public function it_user_can_success_add_idea()
    {
        $this->signIn($this->user)
             ->post(route('idea.store'), $data = [
                 'title' => 'Idea title',
                 'description' => 'Idea description'
             ])
             ->assertRedirect(route('idea.create'))
             ->assertSessionHas('status', 'Idea was successfully added');

        $this->assertDatabaseHas('ideas', $data);
    }
}
