<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvateRequest;
use App\Models\User;
use App\Notifications\InvitationPaid;

class InvateController extends Controller
{
    public function create(){

        return view('users.invite');
    }

    public function store(InvateRequest $request)
    {
        $data = $request->validated();
        $password = $data['password'];
        $data['password'] = bcrypt($password);
        $data['remember_token']  = str_random(60);

        /** @var User $user */
        $user = User::query()->create($data);
        $user->notify(new InvitationPaid($password));

        return back()->with('status', 'Email sended');
    }

    public function confirm(string $remember_token)
    {
        User::query()->where('remember_token', $remember_token)->update(['confirmed' => 1]);

        return redirect()->route('login');
    }
}
