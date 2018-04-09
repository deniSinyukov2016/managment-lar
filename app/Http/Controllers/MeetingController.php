<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeetingRequest;
use App\Http\Requests\UpdateMeetingRequest;
use App\Models\Meeting;
use App\Models\Project;
use App\Models\User;

class MeetingController extends Controller
{
    public function create()
    {
        $projects = Project::query()->get();
        $users = User::query()->where('is_admin', false)->get();

        return view('meetings.create', compact('projects', 'users'));
    }

    public function store(StoreMeetingRequest $request)
    {
        $meeting = array_except($request->validated(), 'users');
        /** @var Meeting $meeting */
        $meeting = Meeting::query()->create($meeting);

        $meeting->users()->attach($request->get('users', $meeting->project->users()->pluck('id')->toArray()));

        session()->flash('status', 'Meeting successfully add!');

        return redirect()->route('projects.show', $meeting->project);
    }

    public function show(Meeting $meeting)
    {
        $this->authorize('show', $meeting);

        $meeting->load(['users', 'project.users', 'creator']);

        return view('meetings.show', compact('meeting'));
    }

    public function edit(Meeting $meeting)
    {
        $meeting->load(['users']);
        $users = User::query()->where('is_admin', false)->get();

        return view('meetings.edit', compact('meeting', 'users'));
    }

    public function update(UpdateMeetingRequest $request, Meeting $meeting)
    {
        $data = array_except($request->validated(), 'users');
        $data['is_close'] = $request->get('is_close', 0);
        $meeting->update($data);

        $meeting->users()->sync($request->get('users'));

        session()->flash('status', 'Meeting successfully updated!');

        return redirect()->route('meetings.show', $meeting);
    }

    public function destroy(Meeting $meeting)
    {
        $meeting->delete();

        session()->flash('status', 'Meeting successfully destroy!');

        return redirect()->route('projects.show', $meeting->project);
    }
}
