<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserProjectsRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserProjectController extends Controller
{
    public function edit(User $user)
    {
        $projects = Project::query()->with('users')->get();

        return view('users.anchor_project', compact('user', 'projects'));
    }

    public function update(User $user)
    {
        \request()->validate([
            'id'   => 'required|array',
            'id.*' => 'required|exists:projects,id'
        ]);

        $user->projects()->sync(\request('id'));

        session()->flash('status', 'Projects successfully synced!');

        return redirect()->route('users.show', $user);
    }
}
