<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function show(User $auth, User $user)
    {
        return $auth->isAdmin() || $auth->id == $user->id;
    }
}
