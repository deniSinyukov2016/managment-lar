<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_has_technologies_relation()
    {
        $project = create(Project::class);

        $this->assertInstanceOf(Collection::class, $project->technologies);
    }

    /** @test */
    public function it_can_has_technologies()
    {
        $project = create(Project::class);

        $project->technologies()->createMany(make(Technology::class, [], 2)->toArray());

        $this->assertCount(2, $project->fresh()->technologies);
        $this->assertDatabaseHas('technologgables', ['technologgable_type' => 'projects']);
    }
}
