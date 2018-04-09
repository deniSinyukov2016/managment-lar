<?php

namespace App\Http\Controllers;

use App\Models\Reply;

class ReplyController extends Controller
{
    public function store($entityName, $entity)
    {
        request()->validate(['body' => 'required|string']);

        get_model($entityName, $entity)->replies()->create([
            'body'    => request('body'),
            'user_id' => auth()->id()
        ]);

        return back()->with('status', 'Reply was successfully created!');
    }

    public function edit(Reply $reply)
    {
        return view('reply.edit', compact('reply'));
    }

    public function update(Reply $reply)
    {
        request()->validate(['body' => 'required|string']);

        $reply->update(request()->only('body'));

        return redirect()->to(request('back'))->with('status', 'Reply was successfully updated!');
    }

    public function destroy(Reply $reply)
    {
        $reply->delete();

        return back()->with('status', 'Reply was successfully deleted!');;
    }
}
