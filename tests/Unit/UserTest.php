<?php

namespace Tests\Unit;

use App\Models\Technology;
use App\Models\User;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_has_technologies_relation()
    {
        $user = create(User::class);

        $this->assertInstanceOf(Collection::class, $user->technologies);
    }

    /** @test */
    public function it_can_has_technologies()
    {
        $user = create(User::class);

        $user->technologies()->createMany(make(Technology::class, [], 2)->toArray());

        $this->assertCount(2, $user->fresh()->technologies);
        $this->assertDatabaseHas('technologgables', ['technologgable_type' => 'users']);
    }
}