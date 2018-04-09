<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class ProjectController extends Controller
{
    public function index()
    {
        if (request()->exists('user_id')) {
            $user = User::query()->find(request('user_id'));

            $projects = $user->projects()->paginate(6);

            return view('projects.index')->with('projects', $projects);
        }

        if (request()->exists('technology')) {
            $technology = Technology::query()->whereKey(request('technology'))->first();
            $projects = $technology->projects()->paginate(6);

            return view('projects.index')->with('projects', $projects);
        }

        $projects = \Auth::user()->attachProjects(8);

        return view('projects.index')->with('projects', $projects);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        $data            = $request->validated();
        $data['user_id'] = auth()->id();
        Project::query()->create($data);

        return redirect()->route('projects.create')->with('status', 'Project created success!');
    }

    // TODO need create policy for all entity!!!
    public function show(Project $project)
    {
        $anchorUsers = $project->getAttachedUsers();

        $comments = $project->comments()->with('user')->orderBy('id', 'desc');
        if (!auth()->user()->isAdmin()) {
            $comments = $comments->where('user_id', auth()->id());
        }
        $comments = $comments->paginate(10);

        $project->load([
            'meetings' => function ($q) {
                /** @var Builder $q */
                $q->where('date_time', '>', now())->orderBy('date_time')->where('is_close', false)->limit(5);
            },
            'technologies'
        ]);

        return view('projects.show', compact('project', 'anchorUsers', 'comments'));
    }

    public function edit(Project $project)
    {
        /** @var User $allusers */
        $allusers = User::get(); // get all users who active invate

        return view('projects.edit', compact('project', 'allusers'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->validated());

        session()->flash('status', 'Project edited success');

        return redirect()->route('projects.show', $project);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        session()->flash('status', 'Project success deleted!');

        return redirect()->route('projects.index');
    }
}
