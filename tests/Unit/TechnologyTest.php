<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Technology;
use App\Models\User;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TechnologyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_projects_relation()
    {
        $technology = create(Technology::class);

        $this->assertInstanceOf(Collection::class, $technology->projects);
    }

    /** @test */
    public function it_can_has_projects()
    {
        $technology = create(Technology::class);
        $technology->projects()->createMany(make(Project::class, [], 3)->toArray());

        $this->assertDatabaseHas('technologgables', ['technologgable_type' => 'projects']);
        $this->assertEquals(3, $technology->projects()->count());
    }

    /** @test */
    public function it_has_users_relation()
    {
        $technology = create(Technology::class);

        $this->assertInstanceOf(Collection::class, $technology->users);
    }

    /** @test */
    public function it_can_has_users()
    {
        $technology = create(Technology::class);
        $technology->users()->createMany(make(User::class, [], 3)->toArray());

        $this->assertDatabaseHas('technologgables', ['technologgable_type' => 'users']);
        $this->assertEquals(3, $technology->users()->count());
    }
}
