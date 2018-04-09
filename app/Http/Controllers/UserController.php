<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Comment;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->paginate(request('count', 16));

        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        $projects = Project::all();

        $user->load(['technologies', 'comments' => function ($q) {
            $q->orderBy('created_at', 'desc')->limit(10);
        }]);

        $user->comments->map(function (Comment $comment) use ($user) {
            $comment->user = $user;

            return $comment;
        });

        return view('users.show', compact('user', 'projects'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());

        return response()->redirectTo(route('users.index'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->redirectTo(route('users.index'));
    }
}
