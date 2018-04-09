<?php

namespace App\Http\Controllers;

use App\Http\Requests\TechnologySyncRequest;
use App\Models\Project;
use App\Models\Technology;

class ProjectTechnologyController extends Controller
{
    public function edit(Project $project)
    {
        $project->load('technologies');

        $technologies = Technology::query()->get();

        return view('technologies.attach-to-project', compact('project', 'technologies'));
    }

    public function update(TechnologySyncRequest $request, Project $project)
    {
        $project->technologies()->sync($request->id);

        session()->flash('status', 'Technologies successfully synced!');

        return redirect()->route('projects.show', $project);
    }
}
