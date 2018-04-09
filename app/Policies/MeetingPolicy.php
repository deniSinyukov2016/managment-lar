<?php

namespace App\Policies;

use App\Models\Meeting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeetingPolicy
{
    use HandlesAuthorization;

    public function before()
    {
        if (auth()->user()->isAdmin()) {
            return true;
        }
    }

    public function show(User $user, Meeting $meeting)
    {
        if ($meeting->users()->whereKey($user->id)->exists()) {
            return true;
        }

        abort(403, 'You is not invite to this meeting!');
    }
}
