<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $this->authorize('show', $user);

        return view('auth.profiles.index', compact('user'));
    }

    public function update()
    {
        request()->validate(['avatar' => 'required|image']);

        Auth::user()->update(['avatar' => $this->getImageHash()]);

        return back()->with('success','You have successfully upload images.');
    }

    private function getImageHash()
    {
        $hash = request()->file('avatar')->storePublicly('public/avatars');

        return str_replace('public/avatars/', '', $hash);
    }
}
