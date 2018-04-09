<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index()
    {
         request()->exists('user_id');
         $user = User::query()->find(request('user_id'));

         $comments = $user->comments()->paginate(6);

        return view('projects.show_com')->with('comments',$comments);
    }

    public function store(StoreCommentRequest $request, Project $project)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['project_id'] = $project->id;

        Comment::query()->create($data);
        session()->flash('status', 'Comment success created!');

        return redirect()->route('projects.show', $project);
    }
}
