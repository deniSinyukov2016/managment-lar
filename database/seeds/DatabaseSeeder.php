<?php

use App\Models\Comment;
use App\Models\Idea;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use \Illuminate\Foundation\Testing\WithFaker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->setUpFaker();

         /** @var \Illuminate\Support\Collection $projects */
         $projects = create(Project::class, ['user_id' => 1], 15);

         $projects->each(function (Project $project) {
             create(User::class, ['is_admin' => false], random_int(2, 6));

             $users = User::query()->where('is_admin', false)->get()->take(random_int(2, 10));
             $users->each(function (User $user) use ($project) {
                 $project->users()->attach($user->id);
                 $times = random_int(4, 10);
                 for($i = 0; $i < $times; $i++) {
                     create(Comment::class, [
                         'user_id'    => $user->id,
                         'project_id' => $project->id,
                         'created_at' => $this->faker()->unique()->dateTimeBetween('-2 month')
                     ]);
                 }
             });
         });

         create(Idea::class, [], 15);
    }
}
