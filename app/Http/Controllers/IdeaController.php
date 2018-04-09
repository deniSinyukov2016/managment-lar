<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdeaRequest;
use App\Models\Idea;
use App\Models\User;

class IdeaController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \InvalidArgumentException
     */
    public function index()
    {
        $statuses = Idea::query()
                        ->select(['status', \DB::raw('COUNT(status) as status_count')])
                        ->groupBy('status')
                        ->get();

        $ideasBuilder = Idea::query()->orderBy('id', 'desc')->withCount('replies');
        $ideasTotal   = $ideasBuilder->count();

        if (request()->exists('status')) {
            $ideasBuilder->where('status', request('status'));
        }

        if (request()->exists('user_id')) {
            $user = User::query()->find(request('user_id'));

            $ideas = $user->ideas()->paginate(6);

            return view('idea.index-user', compact('ideas'));
        }

        $ideas = $ideasBuilder->paginate(6);

        return view('idea.index', compact('ideas', 'statuses', 'ideasTotal'));
    }

    public function create()
    {
        return view('idea.create');
    }

    public function store(IdeaRequest $request)
    {
        Idea::query()->create($request->validated());

        return redirect()->route('idea.create')->with('status', 'Idea was successfully added');
    }

    public function show(Idea $idea)
    {
        if (auth()->user()->isAdmin() && $idea->notWatched()) {
            $idea->watch();
        }

        $idea->load(['user', 'likes']);
        $replies = $idea->replies()->with('user')->orderBy('id', 'desc')->paginate();

        return view('idea.show', compact('idea', 'replies'));
    }

    public function update(Idea $idea)
    {
        $idea->update(['status' => request('status')]);

        return back();
    }
}
