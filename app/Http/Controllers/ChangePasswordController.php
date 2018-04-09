<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;

class ChangePasswordController extends Controller
{
    public function show()
    {
        return view('auth.passwords.changePassword');
    }

    public function update(ChangePasswordRequest $request)
    {
        auth()->user()->update(['password' => bcrypt($request->get('new-password'))]);

        return redirect()->back()->with('success', 'Password changed successfully!');
    }
}
