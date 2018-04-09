<?php

namespace App\Http\Controllers;

use App\Http\Requests\TechnologySyncRequest;
use App\Models\Technology;
use App\Models\User;

class TechnologyUserController extends Controller
{
    public function edit(User $user)
    {
        $user->load('technologies');

        $technologies = Technology::query()->get();

        return view('technologies.attach-to-user', compact('user', 'technologies'));
    }

    public function update(TechnologySyncRequest $request, User $user)
    {
        $user->technologies()->sync($request->id);

        session()->flash('status', 'Technologies successfully synced!');

        return redirect()->route('users.show', $user);
    }
}
